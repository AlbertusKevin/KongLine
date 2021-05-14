<?php

namespace App\Domain\Donation\Service;

use App\Domain\Donation\Dao\DonationDao;
use App\Domain\Helper\HelperService;
use App\Domain\Profile\Service\ProfileService;
use Carbon\Carbon;

class DonationService
{
    private $donation_dao;
    private $profile_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
        $this->donation_dao = new DonationDao();
    }

    //! Mengambil nama bank yang bisa digunakan untuk transfer
    public function listBank()
    {
        return $this->donation_dao->listBank();
    }

    public function getThreeActiveDonation()
    {
        $listDonation = $this->donation_dao->getListDonation();
        $listValidDate = [];
        $listThreeDonationActive = [];

        foreach ($listDonation as $donation) {
            $listValidDate[] = $this->checkValidDate($donation);
        }

        for ($i = 0; $i < 3; $i++) {
            $listThreeDonationActive[$i] = $listValidDate[$i];
        }

        return $listThreeDonationActive;
    }

    public function checkValidDate($donation)
    {
        $time = Carbon::now('+7:00')->format("Y-m-d");

        if (strtotime($donation->deadline) - strtotime($time) <= 0) {
            return $this->donation_dao->updateStatusEvent($donation->id, FINISHED);
        }

        return $donation;
    }

    public function getListDonation()
    {
        $listDonation = $this->donation_dao->getListDonation();
        $list = [];

        foreach ($listDonation as $donation) {
            $list[] = $this->checkValidDate($donation);
        }

        return $list;
    }

    public function getADonation($id)
    {
        return $this->donation_dao->getADonation($id);
    }

    public function getDetailAllocation($id)
    {
        return $this->donation_dao->getDetailAllocation($id);
    }

    public function getParticipatedDonation($id)
    {
        return $this->donation_dao->getParticipatedDonation($id);
    }

    public function getABudgetingDonation($id)
    {
        return $this->donation_dao->getABudgetingDonation($id);
    }

    public function postDonate($participateDonation)
    {
        $this->donation_dao->postDonate($participateDonation);
    }

    public function postTransaction($transaction)
    {
        $this->donation_dao->postTransaction($transaction);
    }

    public function getAUserTransaction($idUser, $idEvent)
    {
        return $this->donation_dao->getAUserTransaction($idUser, $idEvent);
    }

    public function checkUserTransactionStatus($participatedDonation, $id)
    {
        foreach ($participatedDonation as $participate) {
            if ($participate->idParticipant == $id) {
                if ($participate->status == 1) {
                    return CONFIRMED_TRANSACTION;
                }
                if ($participate->status == 2) {
                    return NOT_CONFIRMED_TRANSACTION;
                }
                if (!empty($participate->repaymentPicture) && $participate->status == 0) {
                    return NOT_UPLOADED;
                }
            }
        }

        return REJECTED_TRANSACTION;
    }

    public function checkStatusIsZero($participatedDonation)
    {
        foreach ($participatedDonation as $comment) {
            if ($comment->status == 1) {
                return false;
            }
        }
        return true;
    }

    public function confirmationPictureDonation($picture, $id)
    {
        $pathRepaymentPicture = HelperService::uploadImage($picture, 'donation/bukti_transfer');
        $this->donation_dao->confirmationPictureDonation($pathRepaymentPicture, $id);
    }

    public function updateTransactionDonation($id)
    {
        $this->donation_dao->changeStatusTransactionDonation($id);
    }

    public function countProgressDonation($donation)
    {
        return ($donation->donationCollected / $donation->donationTarget) * 100;
    }

    //! {{-- lewat ajax --}} Mencari donasi sesuai urutan dan kategori yang dipilih
    public function searchDonation($request)
    {
        $this->getListDonation();

        $userId = $this->profile_service->getAProfile()->id;
        $category = HelperService::categorySelect($request);
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
        $this->getListDonation();

        $category = HelperService::categorySelect($request);
        $userId = $this->profile_service->getAProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->getListDonation();
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

    public function storeDonationCreated($donation)
    {
        $pathPhoto = HelperService::uploadImage($donation->getPhoto(), 'images/donation');
        $donation->setPhoto($pathPhoto);
        $this->donation_dao->storeDonationCreated($donation);
    }

    public function updateEventDonation($donation, $id, $empty)
    {
        if (!$empty) {
            $pathPhoto = HelperService::uploadImage($donation->getPhoto(), 'images/donation');
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
