<?php

namespace App\Domain\Donation\Service;

use App\Domain\Donation\Dao\DonationDao;
use App\Domain\Helper\HelperService;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;

class DonationService
{
    private $donation_dao;
    private $profile_service;
    private $event_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
        $this->event_service = new EventService();
        $this->donation_dao = new DonationDao();
    }

    public function preprocessNominalDonation($request)
    {
        $nominal = HelperService::makeNumber($request->nominal);

        if (gettype($nominal) != "integer") {
            return "not_number";
            if ($nominal < MIN_DONATION) {
                return "below_min";
            }
        }

        return $nominal;
    }

    //! Mengambil nama bank yang bisa digunakan untuk transfer
    public function getListOfBank()
    {
        return $this->donation_dao->getListOfBank();
    }

    public function updateDeadlineStatusDonation()
    {
        // ambil donasi yang aktif
        $activeDonation = $this->donation_dao->getListActiveDonation();

        // update jika donasi ada yang sudah deadline
        foreach ($activeDonation as $donation) {
            $this->event_service->checkValidDate($donation, DONATION);
        }
    }

    public function getAllDonation()
    {
        $this->updateDeadlineStatusDonation();
        // ambil semua status donasi
        $listDonation = $this->donation_dao->getAllDonation();
        return $listDonation;
    }

    public function getListActiveDonation()
    {
        // ambil list donasi hasil update status dari tanggal deadline
        $listActiveDonation = $this->donation_dao->getListActiveDonation();
        return $listActiveDonation;
    }

    public function getCompleteInformationADonation($id)
    {
        $this->updateDeadlineStatusDonation();
        $info_donation = [];

        // detail donasi mencakup pembuat event tersebut
        $info_donation['detail'] = $this->getADonation($id);
        // progres pengumpulan dana
        $info_donation['progress'] = ($info_donation['detail']->donationCollected / $info_donation['detail']->donationTarget) * 100;; // untuk progress bar
        // siapa saja yang sudah ikut berdonasi dan sudah konfirmasi pembayaran
        $info_donation['participated'] =  $this->donation_dao->getParticipatedDonation($id); // untuk tab donatur dan comment
        // rincian alokasi dana dari hasil donasi
        $info_donation['budgetAlloc'] = $this->donation_dao->getABudgetingDonation($id);
        // cek apakah semua yang ada di tabel partisipasi belum mengkonfirmasi pembayaran
        $info_donation['isAllTransactionNotConfirmed'] = $this->isAllTransactionNotConfirmed($info_donation['participated']);

        return $info_donation;
    }

    public function getADonation($id)
    {
        return $this->donation_dao->getADonation($id);
    }

    // Mengambil detail sebuah donasi, termasuk list donatur, comment, dan detail alokasi dana
    public function getDetailAllocation($id)
    {
        return $this->donation_dao->getDetailAllocation($id);
    }

    // Menyimpan data partisipasi donasi user tertentu
    public function postDonate($participateDonation)
    {
        $this->donation_dao->postDonate($participateDonation);
    }

    // mengkonfirmasi pembayaran donasi
    public function postTransaction($transaction)
    {
        $this->donation_dao->postTransaction($transaction);
    }

    // mengambil detail transaksi user tertentu
    public function getAUserTransaction($idUser, $idEvent)
    {
        return $this->donation_dao->getAUserTransaction($idUser, $idEvent);
    }

    public function checkAnUserTransactionStatus($idUser, $idEvent)
    {

        $statusTransaction = $this->donation_dao->getAUserTransaction($idUser, $idEvent);

        if (!empty($statusTransaction)) {
            if ($statusTransaction->status == CONFIRMED_TRANSACTION) {
                return CONFIRMED_TRANSACTION;
            }
            if ($statusTransaction->status == NOT_CONFIRMED_TRANSACTION) {
                return NOT_CONFIRMED_TRANSACTION;
            }
            if ($statusTransaction->status == REJECTED_TRANSACTION) {
                return REJECTED_TRANSACTION;
            }
            if ($statusTransaction->status == NOT_UPLOADED) {
                return NOT_UPLOADED;
            }
        }

        return false;
    }

    public function isAllTransactionNotConfirmed($participatedDonation)
    {
        foreach ($participatedDonation as $donate) {
            if ($donate->status == 1) {
                return false;
            }
        }
        return true;
    }

    public function confirmationPictureDonation($picture, $id)
    {
        $folder = $this->getADonation($id)->title;
        $folder = HelperService::makeSlugify($folder);
        $folder = FOLDER_IMAGE_TRANSACTION . $folder;

        $pathRepaymentPicture = HelperService::uploadImage($picture, $folder);
        $this->donation_dao->confirmationPictureDonation($pathRepaymentPicture, $id);
    }

    public function updateTransactionDonation($id)
    {
        $this->donation_dao->changeStatusTransactionDonation($id);
    }

    //! {{-- lewat ajax --}} Mencari donasi sesuai urutan dan kategori yang dipilih
    public function searchDonation($request)
    {
        $userId = $this->profile_service->getAProfile()->id;
        $category = $this->event_service->categorySelect($request);
        $sortBy = $request->sortBy;

        // search biasa tanpa kategori dan sorting tertentu
        if ($category == 0 && $sortBy == NONE) {
            return $this->donation_dao->searchDonationByKeyword(ACTIVE, $request->keyword);
        }

        // search jika berdasarkan sort dan category
        if ($category != 0 && $sortBy != NONE) {
            if ($sortBy == DEADLINE) {
                return $this->donation_dao->searchDonationCategorySortAsc(ACTIVE, $request->keyword, $category, DEADLINE_COLUMN);
            }
            if ($sortBy == SMALL_COLLECTED) {
                return $this->donation_dao->searchDonationCategorySortAsc(ACTIVE, $request->keyword, $category, COLLECTED_COLUMN);
            }

            if ($sortBy == MY_DONATION) {
                return $this->donation_dao->searchDonationCategoryByMe($request->keyword, $category, $userId);
            }

            if ($request->sortBy == PARTICIPATED_DONATION) {
                return $this->donation_dao->searchDonationCategoryParticipated($request->keyword, $category, $userId);
            }

            //todo: sorting berdasarkan sisa target donasi yang paling sedikit
            // if ($sortBy == "Sisa Target") {
            //     return $this->donation_dao->searchPetitionCategorySortTargetLeft(ACTIVE, $request->keyword, $category, CREATED);
            // }
            //todo: end of todo
        }

        // Search jika hanya berdasarkan category
        if ($category != 0) {
            return $this->donation_dao->searchDonationCategory(ACTIVE, $request->keyword, $category);
        }

        // Jika hanya berdasarkan sort
        if ($sortBy != NONE) {
            if ($sortBy == DEADLINE) {
                return $this->donation_dao->searchDonationSortBy(ACTIVE, $request->keyword, DEADLINE_COLUMN);
            }

            if ($sortBy == SMALL_COLLECTED) {
                return $this->donation_dao->searchDonationSortBy(ACTIVE, $request->keyword, COLLECTED_COLUMN);
            }

            if ($sortBy == MY_DONATION) {
                return $this->donation_dao->searchDonationByMe($request->keyword, $userId);
            }

            if ($request->sortBy == PARTICIPATED_DONATION) {
                return $this->donation_dao->searchDonationParticipated($request->keyword, $userId);
            }
        }
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortDonation($request)
    {
        $category = $this->event_service->categorySelect($request);
        $userId = $this->profile_service->getAProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->getListActiveDonation();
        }

        // Jika sort dipilih
        if ($request->sortBy == SMALL_COLLECTED) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->donation_dao->sortDonationCategory($category, ACTIVE, COLLECTED_COLUMN);
            }
            // jika hanya sort
            return $this->donation_dao->sortDonation(ACTIVE, COLLECTED_COLUMN);
        }

        if ($request->sortBy == DEADLINE) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->donation_dao->sortDonationCategory($category, ACTIVE, DEADLINE_COLUMN);
            }
            // jika hanya sort
            return $this->donation_dao->sortDonation(ACTIVE, DEADLINE_COLUMN);
        }

        if ($request->sortBy == MY_DONATION) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->donation_dao->sortDonationCategoryByCampaigner($category, $userId);
            }
            // jika hanya sort
            return $this->donation_dao->sortDonationByCampaigner($userId);
        }

        if ($request->sortBy == PARTICIPATED_DONATION) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->donation_dao->sortDonationCategoryParticipated($category, $userId);
            }
            // jika hanya sort
            return $this->donation_dao->sortDonationParticipated($userId);
        }

        // Jika hanya pilih berdasarkan category
        if ($request->sortBy == NONE) {
            return $this->donation_dao->donationByCategory($category, ACTIVE);
        }
    }

    public function validateTotalAllocation($totalNominal, $targetDonation)
    {
        $total = 0;
        $list = [];

        foreach ($totalNominal as $nominal) {
            $allocation = HelperService::makeNumber($nominal);
            $list[] = $allocation;
            $total += $allocation;
        }

        if ($total != $targetDonation) {
            return [];
        }

        return $list;
    }

    public function storeDonationCreated($donation)
    {
        $pathPhoto = HelperService::uploadImage($donation->getPhoto(), FOLDER_IMAGE_DONATION);
        $donation->setPhoto($pathPhoto);

        $this->donation_dao->storeDonationCreated($donation);
    }

    public function updateEventDonation($donation, $id, $empty)
    {
        if (!$empty) {
            $pathPhoto = HelperService::uploadImage($donation->getPhoto(), FOLDER_IMAGE_DONATION);
            $donation->setPhoto($pathPhoto);
        }
        $this->donation_dao->updateEventDonation($donation, $id);
    }

    public function deleteAllocationDetail($id)
    {
        $this->donation_dao->deleteAllocationDetail($id);
    }

    public function storeDetailAllocation($allocationDetail)
    {
        $this->donation_dao->storeDetailAllocation($allocationDetail);
    }

    public function getLastIdDonation()
    {
        return $this->donation_dao->getLastIdDonation();
    }
}
