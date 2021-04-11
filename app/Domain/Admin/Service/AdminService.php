<?php

namespace App\Domain\Admin\Service;

use App\Domain\Admin\Dao\AdminDao;
use Illuminate\Support\Carbon;
use App\Domain\Event\Service\EventService;

class AdminService
{
    private $dao;
    private $eventService;

    public function __construct()
    {
        $this->dao = new AdminDao();
        $this->eventService = new EventService();
    }

    //Mengambil semua user yang ada di DB
    public function getAllUser()
    {
        return $this->dao->getAllUser();
    }

    // Menghitung jumlah partisipasi setiap user
    public function countEventParticipate($users)
    {
        $eventCount = array();

        foreach ($users as $user) {
            $totalCount = array();

            $countPetition = $this->dao->getCountParticipatePetition($user->id);
            $countDonation = $this->dao->getCountParticipateDonation($user->id);

            $total = $countDonation + $countPetition;
            array_push($totalCount, $user->id, $total);
            array_push($eventCount, $totalCount);
        }

        return $eventCount;
    }

    //Mengubah Format tanggal, ex:2019-10-02 ---> 2019/10/02
    public function changeDateFormat()
    {
        $users = $this->dao->getAllUser();
        $tanggal = array();
        foreach ($users as $user) {
            $tanggalDibuat = $user->created_at;
            $tanggalDibuat = explode(" ", $tanggalDibuat);
            $tanggalDibuat = str_replace("-", "/", $tanggalDibuat[0]);
            array_push($tanggal, $tanggalDibuat);
        }
        return $tanggal;
    }

    public function listUserByRole($request)
    {
        $roleType = $request->roleType;

        if ($roleType == PARTICIPANT or $roleType == CAMPAIGNER) {
            return $this->dao->listUserByRole($roleType);
        } elseif ($roleType == PENGAJUAN) {
            return $this->dao->listUserByPengajuan();
        } elseif ($roleType == SEMUA) {
            return $this->dao->listUserByAll();
        }
    }

    public function countUser()
    {
        $user = $this->dao->getAllUser();
        return $user->count();
    }

    public function countParticipant()
    {
        return $this->dao->getCountParticipant();
    }

    public function countCampaigner()
    {
        return $this->dao->getCountCampaigner();
    }

    public function countWaitingCampaigner()
    {
        return $this->dao->getCountWaitingCampaigner();
    }

    public function countWaitingPetition()
    {
        return $this->dao->getCountWaitingPetition();
    }

    public function countWaitingDonation()
    {
        return $this->dao->getCountWaitingDonation();
    }

    public function getDonationLimit()
    {
        return $this->dao->getListDonationLimit();
    }

    public function getPetitionLimit()
    {
        return $this->dao->getListPetitionLimit();
    }

    public function getDate()
    {
        return Carbon::now()->format('d-m-Y');
    }

    public function allPetition()
    {
        return $this->dao->allPetition();
    }

    public function acceptPetition($id)
    {
        $this->dao->acceptPetition($id);
    }

    public function rejectPetition($id)
    {
        $this->dao->rejectPetition($id);
    }

    public function closePetition($id)
    {
        $this->dao->closePetition($id);
    }

    public function sendEmail($id)
    {
        $petition = $this->eventService->showPetition($id);
        $campaigner = $this->eventService->getCampaigner($petition->idCampaigner);
        $emailCampaigner = $campaigner->email;
    }

    public function allDonation()
    {
        return $this->dao->allDonation();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function adminSortDonation($request)
    {
        $category = $this->eventService->categorySelect($request);
        // dd($category . " " . $request->sortBy . " " . $request->typeDonation);

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->eventService->donationType($request->typeDonation);
        }

        if ($request->typeDonation == BERLANGSUNG) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, ACTIVE, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(ACTIVE, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, ACTIVE, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(ACTIVE, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->donationByCategory($category, ACTIVE);
            }
        }
        if ($request->typeDonation == SELESAI) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, FINISHED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(FINISHED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, FINISHED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(FINISHED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->donationByCategory($category, FINISHED);
            }
        }
        if ($request->typeDonation == DIBATALKAN) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, CANCELED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(CANCELED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, CANCELED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(CANCELED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->donationByCategory($category, CANCELED);
            }
        }
        if ($request->typeDonation == BELUM_VALID) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, NOT_CONFIRMED, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(NOT_CONFIRMED, DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortDonationCategory($category, NOT_CONFIRMED, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortDonation(NOT_CONFIRMED, COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->donationByCategory($category, NOT_CONFIRMED);
            }
        }
        if ($request->typeDonation == SEMUA) {
            // Jika sort dipilih
            if ($request->sortBy == DEADLINE) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->allStatusSortDonationCategory($category, DEADLINE_COLUMN);
                }
                // jika hanya sort
                return $this->dao->allStatusSortDonation(DEADLINE_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == SMALL_COLLECTED) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->allStatusSortDonationCategory($category, COLLECTED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->allStatusSortDonation(COLLECTED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->allStatusDonationByCategory($category);
            }
        }
    }
}
