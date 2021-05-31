<?php

namespace App\Domain\Controlling\Service;

use App\Domain\Controlling\Dao\ControllingDao;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Donation\Service\DonationService;
use App\Domain\Petition\Service\PetitionService;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;

class ControllingService
{
    private $controlling_dao;
    private $profile_service;
    private $event_service;
    private $donation_service;
    private $petition_service;

    public function __construct()
    {
        $this->controlling_dao = new ControllingDao();
        $this->profile_service = new ProfileService();
        $this->donation_service = new DonationService();
        $this->petition_service = new PetitionService();
        $this->event_service = new EventService();
    }

    public function getAdminDashboardData()
    {
        $dashboard_data = [];

        $dashboard_data["user_count"] = $this->controlling_dao->getAllUser()->count();
        $dashboard_data["participant_count"] = $this->controlling_dao->getCountParticipant();
        $dashboard_data["campaigner_count"] = $this->controlling_dao->getCountCampaigner();
        $dashboard_data["waiting_campaigner"] = $this->controlling_dao->getCountWaitingCampaigner();
        $dashboard_data["waiting_donation"] = $this->controlling_dao->getCountWaitingDonation();
        $dashboard_data["waiting_transaction"] = $this->controlling_dao->getCountWaitingTransaction();
        $dashboard_data["waiting_petition"] = $this->controlling_dao->getCountWaitingPetition();
        $dashboard_data["list_donation_limited"] = $this->controlling_dao->getListDonationLimit();
        $dashboard_data["list_petition_limited"] = $this->controlling_dao->getListPetitionLimit();
        $dashboard_data["date"] = date('d F Y', strtotime(Carbon::now('+7:00')->format('d-m-Y')));
        $dashboard_data['admin'] = $this->profile_service->getAProfile();

        return $dashboard_data;
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~~ Users ~~~~~~~~~~~~~~~~
    //? ========================================
    //Mengambil semua user yang ada di DB
    public function getAllUser()
    {
        $users = $this->controlling_dao->getAllUser();
        return $users;
    }

    // Menghitung jumlah partisipasi setiap user
    public function countEventParticipate($users)
    {
        $eventCount = array();

        foreach ($users as $user) {
            $totalCount = array();

            $countPetition = $this->controlling_dao->getCountParticipatePetition($user->id);
            $countDonation = $this->controlling_dao->getCountParticipateDonation($user->id);
            $total = $countDonation + $countPetition;
            $this->controlling_dao->updateUserCountEvent($user->id, $total);
            array_push($totalCount, $user->id, $total);
            array_push($eventCount, $totalCount);
        }

        return $eventCount;
    }

    //Mengubah Format tanggal, ex:2019-10-02 ---> 2019/10/02
    public function changeDateFormatCreatedAt($items)
    {
        $tanggal = array();
        foreach ($items as $item) {
            $tanggalDibuat = explode(" ", $item->created_at);
            $tanggalDibuat = str_replace("-", "/", $tanggalDibuat[0]);
            array_push($tanggal, $tanggalDibuat);
        }
        return $tanggal;
    }

    public function getUsersByRole($request)
    {
        $roleType = $request->roleType;

        if ($roleType == PARTICIPANT or $roleType == CAMPAIGNER) {
            return $this->controlling_dao->getUsersByRole($roleType);
        } elseif ($roleType == PENGAJUAN) {
            return $this->controlling_dao->listUserByPengajuan();
        } elseif ($roleType == SEMUA) {
            return $this->controlling_dao->listUserByAll();
        }
    }

    public function sortlistUser($request)
    {
        if ($request->sortBy == 'None') {
            return $this->getUsersByRole($request->roleUserType);
        }

        if ($request->sortBy == 'Tanggal dibuat') {
            if ($request->roleUserType == 'semua') {
                return $this->controlling_dao->sortByTanggalDibuatAllUser();
            } else {
                return $this->controlling_dao->sortByTanggalDibuat($request->roleUserType);
            }
        }

        if ($request->sortBy == 'Nama') {
            if ($request->roleUserType == 'semua') {
                return $this->controlling_dao->sortByNamaAllUser();
            } else {
                return $this->controlling_dao->sortByNama($request->roleUserType);
            }
        }

        if ($request->sortBy == 'Email') {
            if ($request->roleUserType == 'semua') {
                return $this->controlling_dao->sortByEmailAllUser();
            } else {
                return $this->controlling_dao->sortByEmail($request->roleUserType);
            }
        }

        if ($request->sortBy == 'Jumlah Partisipasi') {
            if ($request->roleUserType == 'semua') {
                return $this->controlling_dao->sortByCountEventAll();
            } else {
                return $this->controlling_dao->sortByCountEvent($request->roleUserType);
            }
        }
    }

    public function searchUser($request)
    {
        if ($request->roleUserType == 'semua') {
            return $this->controlling_dao->searchUserAll($request->keyword);
        }

        if ($request->roleUserType == 'participant') {
            return $this->controlling_dao->searchUserParticipant($request->keyword);
        }

        if ($request->roleUserType == 'campaigner') {
            return $this->controlling_dao->searchUserCampaigner($request->keyword);
        }

        if ($request->roleUserType == 'pengajuan') {
            return $this->controlling_dao->searchUserPengajuan($request->keyword);
        }
    }

    public function getUserInfo($id)
    {
        return $this->controlling_dao->getUserInfo($id);
    }

    public function getEventsUser($id)
    {
        $donations = $this->controlling_dao->getUserParticipateDonation($id);
        $petitions = $this->controlling_dao->getUserParticipatePetition($id);
        $events = collect();
        $events->push($donations);
        $events->push($petitions);
        return $events;
    }

    public function countEventMade($id)
    {
        $donationCount = $this->controlling_dao->countDonationMade($id);
        $petitionCount = $this->controlling_dao->countPetitionMade($id);

        return $donationCount + $petitionCount;
    }

    public function getEventsMade($id)
    {
        $donations = $this->controlling_dao->getUserMadeDonation($id);
        $petitions = $this->controlling_dao->getUserMadePetition($id);
        $events = collect();
        $events->push($donations);
        $events->push($petitions);
        //dd($events);

        return $events;
    }


    public function acceptUserToCampaigner($id)
    {
        $this->controlling_dao->acceptUserToCampaigner($id, ACTIVE, CAMPAIGNER);

        // kirim email
        $user = $this->controlling_dao->getUserById($id);

        $template = '
        Selamat! Pengajuan Anda untuk menjadi campaigner berhasil. 
        Kini Anda bisa membuat event Anda sendiri. 
        Terimakasih telah bergabung menjadi agen perubahan dari Yuk Bisa Yuk.';

        $params = [
            'email' => $user->email,
            'subject' => 'Penerimaan Campaigner Baru',
            'subheader' => "Pengajuan Campaigner Diterima",
            'message' => $template,
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function rejectUserToCampaigner($id, $reason)
    {
        $this->controlling_dao->rejectUserToCampaigner($id, ACTIVE, PARTICIPANT);

        // kirim email
        $user = $this->controlling_dao->getUserById($id);

        $template = '
        Maaf! Pengajuan Anda untuk menjadi campaigner tidak berhasil dikarenakan $reason.
        Silahkan untuk melakukan pengajuan ulang';

        $data = ['$reason' => $reason];

        $params = [
            'email' => $user->email,
            'subject' => 'Penerimaan Campaigner Baru',
            'subheader' => "Pengajuan Campaigner Ditolak",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }
    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Donasi ~~~~~~~~~~~~~~~~
    //? ========================================
    //! {{-- lewat ajax --}}
    public function donationType($typeDonation)
    {
        if ($typeDonation == SEMUA) {
            return $this->donation_service->getAllDonation();
        }

        if ($typeDonation == BERLANGSUNG) {
            return $this->controlling_dao->selectDonation(ACTIVE);
        }

        if ($typeDonation == SELESAI) {
            return $this->controlling_dao->selectDonation(FINISHED);
        }

        if ($typeDonation == DIBATALKAN) {
            return $this->controlling_dao->selectDonation(CANCELED);
        }

        return $this->controlling_dao->selectDonation(NOT_CONFIRMED);
    }

    //! {{-- lewat ajax --}}
    public function adminSortDonation($request)
    {
        $category = $this->event_service->categorySelect($request);

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->donationType($request->typeDonation);
        }

        if ($request->typeDonation == BERLANGSUNG) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, ACTIVE, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(ACTIVE, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, ACTIVE, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(ACTIVE, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->controlling_dao->donationByCategory($category, ACTIVE);
            }
        }
        if ($request->typeDonation == SELESAI) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, FINISHED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(FINISHED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, FINISHED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(FINISHED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->controlling_dao->donationByCategory($category, FINISHED);
            }
        }
        if ($request->typeDonation == DIBATALKAN) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, CANCELED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(CANCELED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, CANCELED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(CANCELED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->controlling_dao->donationByCategory($category, CANCELED);
            }
        }
        if ($request->typeDonation == BELUM_VALID) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, NOT_CONFIRMED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(NOT_CONFIRMED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->sortDonationCategory($category, NOT_CONFIRMED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->sortDonation(NOT_CONFIRMED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->controlling_dao->donationByCategory($category, NOT_CONFIRMED);
            }
        }
        if ($request->typeDonation == SEMUA) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->allStatusSortDonationCategory($category, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->allStatusSortDonation(DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->controlling_dao->allStatusSortDonationCategory($category, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->controlling_dao->allStatusSortDonation(COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->controlling_dao->allStatusDonationByCategory($category);
            }
        }
    }

    public function adminSearchDonation($request)
    {
        $category = $this->event_service->categorySelect($request);
        $sortBy = $request->sortBy;

        if ($request->typeDonation == SEMUA) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->controlling_dao->searchAllStatusDonation($request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchAllDonationCategorySort($request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchAllDonationCategorySort($request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->controlling_dao->searchAllDonationCategory($request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->controlling_dao->searchAllDonationSortBy($request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->controlling_dao->searchAllDonationSortBy($request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == BERLANGSUNG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->controlling_dao->searchDonation(ACTIVE, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchDonationCategorySort(ACTIVE, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationCategorySort(ACTIVE, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->controlling_dao->searchDonationCategory(ACTIVE, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchDonationSortBy(ACTIVE, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationSortBy(ACTIVE, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == SELESAI) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->controlling_dao->searchDonation(FINISHED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchDonationCategorySort(FINISHED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationCategorySort(FINISHED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->controlling_dao->searchDonationCategory(FINISHED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchDonationSortBy(FINISHED, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationSortBy(FINISHED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == DIBATALKAN) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->controlling_dao->searchDonation(CANCELED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->controlling_dao->searchDonationCategorySort(CANCELED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationCategorySort(CANCELED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->controlling_dao->searchDonationCategory(CANCELED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->controlling_dao->searchDonationSortBy(CANCELED, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationSortBy(CANCELED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == BELUM_VALID) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->controlling_dao->searchDonation(NOT_CONFIRMED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->controlling_dao->searchDonationCategorySort(NOT_CONFIRMED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationCategorySort(NOT_CONFIRMED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->controlling_dao->searchDonationCategory(NOT_CONFIRMED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->controlling_dao->searchDonationSortBy(NOT_CONFIRMED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->controlling_dao->searchDonationSortBy(NOT_CONFIRMED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }
    }

    public function acceptDonation($id)
    {
        $donation = $this->donation_service->getADonation($id);

        // kirim email
        $data["updated_at"] = Carbon::now("+7:00");
        $data["deadline"] = Carbon::now("+7:00")->addWeeks($donation->duration_event);

        $this->controlling_dao->changeEventStatus($id, ACTIVE, DONATION);
        $this->controlling_dao->acceptDonation($id, $data);

        // kirim email
        $donation = $this->donation_service->getADonation($id);
        $campaigner = $this->profile_service->findUser($donation->idCampaigner);

        $template = 'Selamat! Event $title telah disetujui
        oleh admin YukBisaYuk. Klik $link
        link untuk melihat Eventmu.';

        $data = [
            '$title' => $donation->title,
            '$link' => url('/donation/' . $id)
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penerimaan Pengajuan Event',
            'subheader' => "Penerimaan Pengajuan Event",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function proceedDonation($id)
    {
        $this->controlling_dao->changeEventStatus($id, PROCEEDED, DONATION);

        // kirim email
        $donation = $this->donation_service->getADonation($id);
        $campaigner = $this->profile_service->findUser($donation->idCampaigner);

        $template = 'Selamat! Admin telah memproses transfer donasi yang terkumpul sebesar Rp. $nominal kepada nomor rekening $account dari event dengan judul $title.';
        $data = [
            '$nominal' => number_format($donation->donationCollected, 2, ',', '.'),
            '$title' => $donation->title,
            '$account' => $campaigner->accountNumber
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Tindak Lanjut Event',
            'subheader' => "Transfer Donasi Terkumpul",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];
        $this->controlling_dao->sendEmail($params);
    }

    public function rejectDonation($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, REJECTED, DONATION);

        // kirim email
        $donation = $this->donation_service->getADonation($id);
        $campaigner = $this->profile_service->findUser($donation->idCampaigner);

        $template = 'Maaf! Event <b><i> $title </b></i> tidak dapat
        dipublikasikan oleh pihak YukBisaYuk dikarenakan
        <u>$reason</u>.
        Klik <a href="$link">
        disini</a> untuk melihat eventmu';

        $data = [
            '$title' => $donation->title,
            '$link' => url('/donation/' . $id),
            '$reason' => $reason
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penolakan Pengajuan Event',
            'subheader' => "Penolakan Pengajuan Event",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function closeDonation($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, CLOSED, DONATION);

        // kirim email
        $donation = $this->donation_service->getADonation($id);
        $campaigner = $this->profile_service->findUser($donation->idCampaigner);

        $template = 'Maaf! Event dengan judul <b><i> $title </b></i> ditutup oleh pihak YukBisaYuk dikarenakan
        <u>$reason</u>.
        Klik <a href="$link">
        disini</a> untuk melihat eventmu';

        $data = [
            '$title' => $donation->title,
            '$link' => url('/donation/' . $id),
            '$reason' => $reason
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penolakan Pengajuan Event',
            'subheader' => "Penolakan Pengajuan Event",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~ Transaction ~~~~~~~~~~~~~~
    //? ========================================
    public function updateCalculationDonation($transaction)
    {
        /// ubah jumlah donatur
        $totalDonatur = $this->controlling_dao->countDonatur($transaction->idDonation);
        $this->controlling_dao->updateTotalDonatur($transaction->idDonation, $totalDonatur);

        // ubah jumlah donasi yang terkumpul
        $total = $this->controlling_dao->getTotalDonation($transaction->idDonation);
        $this->controlling_dao->updateDonationCollected($transaction->idDonation, $total);
    }

    public function updateCalculationAfterConfirmDonate($transaction)
    {
        // ubah jumlah event yang diikuti untuk user tertentu
        $this->profile_service->updateCountEventParticipatedByUser($transaction->idParticipant);
        // ubah total donatur dan jumlah donasi yang terkumpul untuk event yang diikuti
        $this->updateCalculationDonation($transaction);
    }

    public function confirmTransaction($transaction)
    {
        $this->controlling_dao->updateStatusTransaction($transaction->id, CONFIRMED_TRANSACTION);

        // kirim email
        $donation = $this->donation_service->getADonation($transaction->idDonation);
        $participant = $this->profile_service->findUser($transaction->idParticipant);

        $template = 'Transaksi donasi dengan nomor invoice $invoice terhadap event $title berhasil dilakukan. Terimakasih turut berpartisipasi menciptakan dunia yang lebih baik.';
        $data = [
            '$invoice' => $transaction->id,
            '$title' => $donation->title
        ];

        $params = [
            'email' => $participant->email,
            'subject' => 'Konfirmasi Transaksi',
            'subheader' => "<strong>Konfirmasi Transaksi</strong>",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function rejectTransaction($id, $reason)
    {
        $transaction = $this->getAUserTransaction($id);

        $this->controlling_dao->updateStatusTransaction($id, REJECTED_TRANSACTION);

        // kirim email
        $donation = $this->donation_service->getADonation($transaction->idDonation);
        $participant = $this->profile_service->findUser($transaction->idParticipant);

        $template = 'Transaksi donasi dengan nomor invoice $invoice terhadap event $title tidak berhasil dikarenakan $reason. Silahkan lakukan pengajuan ulang.';
        $data = [
            '$invoice' => $transaction->id,
            '$title' => $donation->title,
            '$reason' => $reason
        ];

        $params = [
            'email' => $participant->email,
            'subject' => 'Kegagalan Transaksi',
            'subheader' => "<strong>Kegagalan Transaksi</strong>",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function getAllTransaction()
    {
        return $this->controlling_dao->getAllTransaction();
    }

    public function getAUserTransaction($id)
    {
        return $this->controlling_dao->getAUserTransaction($id);
    }

    //! {{-- lewat ajax --}}
    public function transactionType($typeTransaction)
    {
        if ($typeTransaction == SEMUA) {
            return $this->controlling_dao->getAllTransaction();
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->controlling_dao->selectTransaction(NOT_CONFIRMED_TRANSACTION);
        }

        if ($typeTransaction == BELUM_UPLOAD) {
            return $this->controlling_dao->selectTransaction(NOT_UPLOADED);
        }
        return $this->controlling_dao->selectTransaction(REJECTED_TRANSACTION);
    }

    public function searchTransaction($typeTransaction, $keyword)
    {

        if ($typeTransaction == SEMUA) {
            return $this->controlling_dao->searchTransactionByDonationTitle($keyword);
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->controlling_dao->searchTransactionWithStatusByDonationTitle(NOT_CONFIRMED_TRANSACTION, $keyword);
        }

        if ($typeTransaction == BELUM_UPLOAD) {
            return $this->controlling_dao->searchTransactionWithStatusByDonationTitle(NOT_UPLOADED, $keyword);
        }

        return $this->controlling_dao->searchTransactionWithStatusByDonationTitle(REJECTED_TRANSACTION, $keyword);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Petisi ~~~~~~~~~~~~~~~~
    //? ========================================

    public function acceptPetition($id)
    {
        $petition = $this->petition_service->getDetailPetition($id);
        $campaigner = $this->profile_service->findUser($petition->idCampaigner);

        $this->controlling_dao->changeEventStatus($id, ACTIVE, PETITION);
        $data = [
            'updated_at' => Carbon::now('+7:00'),
            'deadline' => Carbon::now('+7:00')->addMonth(),
            'signedTarget' => SIGNED_TARGET_STACK_1,
            'stack' => 1
        ];

        $this->controlling_dao->acceptPetition($id, $data);

        // kirim email
        $template =
            'Selamat! Event <b><i> $title </i></b> telah disetujui
            oleh admin YukBisaYuk. Klik <a href="$link">
            disini </a> untuk melihat Eventmu.';

        $data = [
            '$title' => $petition->title,
            '$link' => url('/petition/' . $petition->id)
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penerimaan Pengajuan Event',
            'subheader' => "Penerimaan Pengajuan Event",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function rejectPetition($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, REJECTED, PETITION);

        // kirim email
        $petition = $this->petition_service->getDetailPetition($id);
        $campaigner = $this->profile_service->findUser($petition->idCampaigner);

        $template = 'Maaf! Event <b><i> $title </b></i> tidak dapat
        dipublikasikan oleh pihak YukBisaYuk dikarenakan
        <u>$reason</u>.
        Klik <a href="$link">
        disini</a> untuk melihat eventmu';

        $data = [
            '$title' => $petition->title,
            '$link' => url('/petition/' . $id),
            '$reason' => $reason
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penolakan Pengajuan Event',
            'subheader' => "Penolakan Pengajuan Event",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function closePetition($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, CLOSED, PETITION);

        // kirim email
        $petition = $this->petition_service->getDetailPetition($id);
        $campaigner = $this->profile_service->findUser($petition->idCampaigner);

        $template = 'Maaf! Event dengan judul <b><i> $title </b></i> ditutup oleh pihak YukBisaYuk dikarenakan
        <u>$reason</u>.
        Klik <a href="$link">
        disini</a> untuk melihat eventmu';

        $data = [
            '$title' => $petition->title,
            '$link' => url('/petition/' . $id),
            '$reason' => $reason
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Penutupan Event Aktif',
            'subheader' => "Penutupan Event Aktif",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }

    public function proceedPetition($id)
    {
        $this->controlling_dao->changeEventStatus($id, PROCEEDED, PETITION);

        // kirim email
        $petition = $this->petition_service->getDetailPetition($id);
        $campaigner = $this->profile_service->findUser($petition->idCampaigner);

        $template = '
        Selamat! petisi Anda dengan judul $title telah berhasil meraih kemenangan
        dengan total tanda tangan terkumpul sebanyak $signedCollected. 
        Terimakasih telah berpartisipas dalam perubahan dunia yang lebih baik';

        $data = [
            '$title' => $petition->title,
            '$signedCollected' => $petition->signedCollected
        ];

        $params = [
            'email' => $campaigner->email,
            'subject' => 'Tindak Lanjut Event',
            'subheader' => "Petisi Meraih Kemenangan",
            'message' => strtr($template, $data),
            'view' => EMAIL_VIEW,
        ];

        $this->controlling_dao->sendEmail($params);
    }
}
