<?php

namespace App\Domain\Controlling\Service;

use App\Domain\Controlling\Dao\ControllingDao;
use App\Domain\Petition\Service\PetitionService;
use App\Domain\Profile\Service\ProfileService;
use Illuminate\Support\Carbon;

class ControllingService
{
    private $controlling_dao;
    private $profile_service;
    private $petition_service;

    public function __construct()
    {
        $this->controlling_dao = new ControllingDao();
        $this->profile_service = new ProfileService();
        $this->petition_service = new PetitionService();
    }

    public function getAdminDashboardData()
    {
        $dashboard_data = [];

        $dashboard_data["user_count"] = $this->controlling_dao->getAllUser()->count();
        $dashboard_data["participant_count"] = $this->controlling_dao->getCountParticipant();
        $dashboard_data["campaigner_count"] = $this->controlling_dao->getCountCampaigner();
        $dashboard_data["waiting_campaigner"] = $this->controlling_dao->getCountWaitingCampaigner();
        $dashboard_data["waiting_donation"] = $this->controlling_dao->getCountWaitingDonation();
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
        $eventCount = $this->countEventParticipate($users);
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
    public function changeDateFormat()
    {
        $users = $this->controlling_dao->getAllUser();
        $tanggal = array();
        foreach ($users as $user) {
            $tanggalDibuat = $user->created_at;
            $tanggalDibuat = explode(" ", $tanggalDibuat);
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

        if ($request->sortBy == 'Role') {
            if ($request->roleUserType == 'semua') {
                return $this->controlling_dao->sortByRoleAll();
            } else {
                return $this->controlling_dao->sortByRoleSpecific($request->roleUserType);
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


    public function acceptUserToCampaigner($id, $view, $subject)
    {

        $user = $this->controlling_dao->getUserById($id);
        $emailUser = $this->controlling_dao->sendEmailUser($user, $view, $subject);

        return $this->controlling_dao->acceptUserToCampaigner($id, ACTIVE, CAMPAIGNER);
    }

    public function rejectUserToCampaigner($id, $view, $subject)
    {

        $user = $this->controlling_dao->getUserById($id);
        $emailUser = $this->controlling_dao->sendEmailUser($user, $view, $subject);

        return $this->controlling_dao->rejectUserToCampaigner($id, ACTIVE, PARTICIPANT);
    }
    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Donasi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function allDonation()
    {
        return $this->controlling_dao->allDonation();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar donasi berdasarkan tipe (berlangsung, telah menang, dll)
    public function donationType($typeDonation)
    {
        if ($typeDonation == SEMUA) {
            return $this->controlling_dao->allDonation();
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

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function adminSortDonation($request)
    {
        $category = $this->eventService->categorySelect($request);
        // dd($category . " " . $request->sortBy . " " . $request->typeDonation);

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

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function adminSearchDonation($request)
    {
        $category = $this->eventService->categorySelect($request);
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
        $this->controlling_dao->changeEventStatus($id, ACTIVE, DONATION);
    }

    public function rejectDonation($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, REJECTED, DONATION);
        $this->controlling_dao->changeReason($id, DONATION, $reason);
    }

    public function closeDonation($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, CLOSED, DONATION);
        $this->controlling_dao->changeReason($id, DONATION, $reason);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~ Transaction ~~~~~~~~~~~~~~
    //? ========================================

    public function updateCalculationAfterConfirmDonate($transaction)
    {
        // ubah jumlah event yang diikuti untuk user tertentu
        $petitionParticipated = $this->eventDao->countPetitionParticipatedByUser($transaction->idParticipant);
        $donationParticipated = $this->eventDao->countDonationParticipatedByUser($transaction->idParticipant);
        $totalEventParticipated = (int)$petitionParticipated + (int)$donationParticipated;
        $this->eventDao->updateCountEventParticipatedByUser($transaction->idParticipant, $totalEventParticipated);

        // ubah total donatur untuk event yang diikuti
        $totalDonatur = $this->controlling_dao->countDonatur($transaction->idDonation);
        $this->controlling_dao->updateTotalDonatur($transaction->idDonation, $totalDonatur);

        // ubah jumlah yang terkumpul
        // ambil jumlah donasi saat ini
        $oldNominal = $this->controlling_dao->getDonationCollected($transaction->idDonation)->donationCollected;
        // jumlahkan
        $total = (int)$oldNominal + (int)$transaction->nominal;
        // update db
        $this->controlling_dao->updateDonationCollected($transaction->idDonation, $total);
    }

    public function confirmTransaction($id)
    {
        $this->controlling_dao->updateStatusTransaction($id, CONFIRMED_TRANSACTION);
    }

    public function rejectTransaction($id, $reason)
    {
        $this->controlling_dao->updateStatusTransaction($id, REJECTED_TRANSACTION);
        $this->controlling_dao->changeReason($id, 'TRANSACTION', $reason);
    }

    public function getAllTransaction()
    {
        return $this->controlling_dao->getAllTransaction();
    }

    public function getAUserTransaction($id)
    {
        return $this->controlling_dao->getAUserTransaction($id);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar transaksi berdasarkan status
    public function transactionType($typeTransaction)
    {

        if ($typeTransaction == SEMUA) {
            return $this->controlling_dao->getAllTransaction();
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->controlling_dao->selectTransaction(NOT_CONFIRMED);
        }
        return $this->controlling_dao->selectTransaction(REJECTED_TRANSACTION);
    }

    //! {{-- lewat ajax --}} Menampilkan pencarian transaksi berdasarkan judul donasi
    public function searchTransaction($typeTransaction, $keyword)
    {

        if ($typeTransaction == SEMUA) {
            return $this->controlling_dao->searchTransactionByDonationTitle($keyword);
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->controlling_dao->searchTransactionWithStatusByDonationTitle(NOT_CONFIRMED, $keyword);
        }
        return $this->controlling_dao->searchTransactionWithStatusByDonationTitle(REJECTED_TRANSACTION, $keyword);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Petisi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function allPetition()
    {
        return $this->petition_service->getAllPetition();
    }

    public function acceptPetition($id)
    {
        $this->controlling_dao->changeEventStatus($id, ACTIVE, PETITION);
    }

    public function rejectPetition($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, REJECTED, PETITION);
        $this->controlling_dao->changeReason($id, PETITION, $reason);
    }

    public function closePetition($id, $reason)
    {
        $this->controlling_dao->changeEventStatus($id, CLOSED, PETITION);
        $this->controlling_dao->changeReason($id, PETITION, $reason);
    }



    //todo: refactor
    public function sendEmailPetition($id, $view, $subject)
    {
        $petition = $this->controlling_dao->getPetitionById($id);
        $event = "petisi";
        $this->controlling_dao->sendEmail($petition, $view, $subject, $event);
    }

    public function sendEmailDonation($id, $view, $subject)
    {
        $donation = $this->controlling_dao->getDonationById($id);
        $event = "donasi";
        $this->controlling_dao->sendEmail($donation, $view, $subject, $event);
    }

    public function sendEmailTransaction($id, $view, $subject)
    {
        $trx = $this->controlling_dao->getTransactionById($id);
        $emailCampaigner = $this->controlling_dao->sendEmailTrx($trx, $view, $subject);
    }
}
