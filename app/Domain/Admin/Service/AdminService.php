<?php

namespace App\Domain\Admin\Service;

use App\Domain\Admin\Dao\AdminDao;
use Illuminate\Support\Carbon;
use App\Domain\Event\Service\EventService;
use App\Domain\Event\Dao\EventDao;

class AdminService
{
    private $dao;
    private $eventService;
    private $eventDao;

    public function __construct()
    {
        $this->dao = new AdminDao();
        $this->eventService = new EventService();
        $this->eventDao = new EventDao();
    }

    public function sendEmail($id)
    {
        $petition = $this->eventService->showPetition($id);
        $campaigner = $this->eventService->getCampaigner($petition->idCampaigner);
        $emailCampaigner = $campaigner->email;
    }

    //Mengambil semua user yang ada di DB
    public function getAllUser()
    {
        $users = $this->dao->getAllUser();
        $eventCount = $this->countEventParticipate($users);
        return $users;
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
            $this->dao->updateUserCountEvent($user->id, $total);
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
        $this->dao->changeEventStatus($id, ACTIVE, PETITION);
    }

    public function rejectPetition($id)
    {
        $this->dao->changeEventStatus($id, REJECTED, PETITION);
    }

    public function closePetition($id)
    {
        $this->dao->changeEventStatus($id, CLOSED, PETITION);
    }

    public function allDonation()
    {
        return $this->dao->allDonation();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar donasi berdasarkan tipe (berlangsung, telah menang, dll)
    public function donationType($typeDonation)
    {
        if ($typeDonation == SEMUA) {
            return $this->dao->allDonation();
        }

        if ($typeDonation == BERLANGSUNG) {
            return $this->dao->selectDonation(ACTIVE);
        }

        if ($typeDonation == SELESAI) {
            return $this->dao->selectDonation(FINISHED);
        }

        if ($typeDonation == DIBATALKAN) {
            return $this->dao->selectDonation(CANCELED);
        }

        return $this->dao->selectDonation(NOT_CONFIRMED);
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
  
  public function sortlistUser($request)
    {
        if ($request->sortBy == 'None'){
            return $this->listUserByRole($request->roleUserType);
        }

        if($request->sortBy == 'Tanggal dibuat'){
            if($request->roleUserType == 'semua'){
                return $this->dao->sortByTanggalDibuatAllUser();
            }else{
                return $this->dao->sortByTanggalDibuat($request->roleUserType);
            }
        }

        if($request->sortBy == 'Nama'){
            if($request->roleUserType == 'semua'){
                return $this->dao->sortByNamaAllUser();
            }else{
                return $this->dao->sortByNama($request->roleUserType);
            }
        }

        if($request->sortBy == 'Email'){
            if($request->roleUserType == 'semua'){
                return $this->dao->sortByEmailAllUser();
            }else{
                return $this->dao->sortByEmail($request->roleUserType);
            }
        }

        if($request->sortBy == 'Jumlah Partisipasi'){
            if($request->roleUserType == 'semua'){
                return $this->dao->listUserByAll();
            }else{
                return $this->dao->listUserByRole($request->roleUserType);
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
                return $this->dao->searchAllStatusDonation($request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchAllDonationCategorySort($request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchAllDonationCategorySort($request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchAllDonationCategory($request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchAllDonationSortBy($request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchAllDonationSortBy($request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == BERLANGSUNG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchDonation(ACTIVE, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchDonationCategorySort(ACTIVE, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationCategorySort(ACTIVE, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchDonationCategory(ACTIVE, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == SELESAI) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchDonation(FINISHED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchDonationCategorySort(FINISHED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationCategorySort(FINISHED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->dao->searchDonationCategory(FINISHED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchDonationSortBy(FINISHED, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationSortBy(FINISHED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == DIBATALKAN) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchDonation(CANCELED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == DEADLINE) {
                    return $this->dao->searchDonationCategorySort(CANCELED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationCategorySort(CANCELED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchDonationCategory(CANCELED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchDonationSortBy(CANCELED, $request->keyword, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationSortBy(CANCELED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }

        if ($request->typeDonation == BELUM_VALID) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchDonation(NOT_CONFIRMED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchDonationCategorySort(NOT_CONFIRMED, $request->keyword, $category, DEADLINE_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationCategorySort(NOT_CONFIRMED, $request->keyword, $category, COLLECTED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchDonationCategory(NOT_CONFIRMED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchDonationSortBy(NOT_CONFIRMED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == SMALL_COLLECTED) {
                    return $this->dao->searchDonationSortBy(NOT_CONFIRMED, $request->keyword, COLLECTED_COLUMN);
                }
            }
        }
    }

    public function acceptDonation($id)
    {
        $this->dao->changeEventStatus($id, ACTIVE, DONATION);
    }

    public function rejectDonation($id)
    {
        $this->dao->changeEventStatus($id, REJECTED, DONATION);
    }

    public function closeDonation($id)
    {
        $this->dao->changeEventStatus($id, CLOSED, DONATION);
    }

    public function updateCalculationAfterConfirmDonate($transaction)
    {
        // ubah jumlah event yang diikuti untuk user tertentu
        $petitionParticipated = $this->eventDao->countPetitionParticipatedByUser($transaction->idParticipant);
        $donationParticipated = $this->eventDao->countDonationParticipatedByUser($transaction->idParticipant);
        $totalEventParticipated = (int)$petitionParticipated + (int)$donationParticipated;
        $this->eventDao->updateCountEventParticipatedByUser($transaction->idParticipant, $totalEventParticipated);

        // ubah total donatur untuk event yang diikuti
        $totalDonatur = $this->dao->countDonatur($transaction->idDonation);
        $this->dao->updateTotalDonatur($transaction->idDonation, $totalDonatur);

        // ubah jumlah yang terkumpul
        // ambil jumlah donasi saat ini
        $oldNominal = $this->dao->getDonationCollected($transaction->idDonation)->donationCollected;
        // jumlahkan
        $total = (int)$oldNominal + (int)$transaction->nominal;
        // update db
        $this->dao->updateDonationCollected($transaction->idDonation, $total);
    }

    public function confirmTransaction($id)
    {
        $this->dao->updateStatusTransaction($id, CONFIRMED_TRANSACTION);
    }

    public function rejectTransaction($id)
    {
        $this->dao->updateStatusTransaction($id, REJECTED_TRANSACTION);
    }

    public function getAllTransaction()
    {
        return $this->dao->getAllTransaction();
    }

    public function getAUserTransaction($id)
    {
        return $this->dao->getAUserTransaction($id);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar transaksi berdasarkan status
    public function transactionType($typeTransaction)
    {

        if ($typeTransaction == SEMUA) {
            return $this->dao->getAllTransaction();
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->dao->selectTransaction(NOT_CONFIRMED);
        }
        return $this->dao->selectTransaction(REJECTED_TRANSACTION);
    }

    //! {{-- lewat ajax --}} Menampilkan pencarian transaksi berdasarkan judul donasi
    public function searchTransaction($typeTransaction, $keyword)
    {

        if ($typeTransaction == SEMUA) {
            return $this->dao->searchTransactionByDonationTitle($keyword);
        }

        if ($typeTransaction == KONFIRMASI) {
            return $this->dao->searchTransactionWithStatusByDonationTitle(NOT_CONFIRMED, $keyword);
        }
        return $this->dao->searchTransactionWithStatusByDonationTitle(REJECTED_TRANSACTION, $keyword);
    }
  
    public function searchUser($request)
    {
        if ($request->roleUserType == 'semua'){
            return $this->dao->searchUserAll($request->keyword);
        }

        if ($request->roleUserType == 'participant'){
            return $this->dao->searchUserParticipant($request->keyword);
        }

        if ($request->roleUserType == 'campaigner'){
            return $this->dao->searchUserCampaigner($request->keyword);
        }

        if ($request->roleUserType == 'pengajuan'){
            return $this->dao->searchUserPengajuan($request->keyword);
        }
    }

    public function getUserInfo($id){
        return $this->dao->getUserInfo($id);
    }

    public function getEventsUser($id){
        $donations = $this->dao->getUserParticipateDonation($id);
        $petitions = $this->dao->getUserParticipatePetition($id);
        $events = collect();
        $events->push($donations);
        $events->push($petitions);
        //dd($events);

        return $events;
    }

    public function countEventMade($id){
        $donationCount = $this->dao->countDonationMade($id);
        $petitionCount = $this->dao->countPetitionMade($id);

        return $donationCount + $petitionCount;
    }

    public function getEventsMade($id){
        $donations = $this->dao->getUserMadeDonation($id);
        $petitions = $this->dao->getUserMadePetition($id);
        $events = collect();
        $events->push($donations);
        $events->push($petitions);
        //dd($events);

        return $events;
    }

    public function acceptUserToCampaigner($id){
        return $this->dao->acceptUserToCampaigner($id, ACTIVE, CAMPAIGNER);
    }
    
    public function rejectUserToCampaigner($id){
        return $this->dao->rejectUserToCampaigner($id, ACTIVE, PARTICIPANT);
    }

}
