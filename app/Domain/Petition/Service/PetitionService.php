<?php

namespace App\Domain\Petition\Service;

use App\Domain\Petition\Model;
use Carbon\Carbon;
use App\Domain\Helper\HelperService;
use App\Domain\Petition\Dao\PetitionDao;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Event\Service\EventService;

class PetitionService
{
    private $petition_dao;
    private $profile_service;
    private $event_service;

    public function __construct()
    {
        $this->petition_dao = new PetitionDao();
        $this->profile_service = new ProfileService();
        $this->event_service = new EventService();
    }

    public function getAllPetition()
    {
        return $this->petition_dao->getAllPetition();
    }

    //! Menampilkan seluruh petisi yang sedang berlangsung
    public function getActivePetition()
    {
        return $this->petition_dao->getActivePetition();
    }

    //! {{-- lewat ajax --}} 
    public function getListPetitionByStatus($request)
    {
        $user = $this->profile_service->getAProfile();

        if ($request->typePetition == BERLANGSUNG) {
            return $this->petition_dao->getListPetitionByStatus(ACTIVE);
        }

        if ($request->typePetition == MENANG) {
            return $this->petition_dao->getListPetitionByStatus(FINISHED);
        }

        if ($request->typePetition == PARTISIPASI) {
            return $this->petition_dao->listPetitionParticipated($user->id);
        }

        if ($request->typePetition == DIBATALKAN) {
            return $this->petition_dao->getListPetitionByStatus(CANCELED);
        }

        if ($request->typePetition == BELUM_VALID) {
            return $this->petition_dao->getListPetitionByStatus(NOT_CONFIRMED);
        }

        if ($request->typePetition == SEMUA) {
            return $this->petition_dao->getAllPetition();
        }

        return $this->petition_dao->listPetitionByMe($user->id);
    }

    public function searchPetition($request)
    {
        $userId = $this->profile_service->getAProfile()->id;
        $category = $this->event_service->categorySelect($request);
        $sortBy = $request->sortBy;

        if ($request->typePetition == BERLANGSUNG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetition(ACTIVE, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(ACTIVE, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(ACTIVE, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(ACTIVE, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(ACTIVE, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(ACTIVE, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == MENANG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetition(FINISHED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(FINISHED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(FINISHED, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(FINISHED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(FINISHED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(FINISHED, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == PARTISIPASI) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetitionParticipated($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->petition_dao->searchPetitionParticipatedCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionParticipatedSortBy($userId, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionParticipatedSortBy($userId, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == PETISI_SAYA) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetitionByMe($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            if ($category != 0) {
                return $this->petition_dao->searchPetitionByMeCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionByMeSort($userId, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionByMeSort($userId, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == DIBATALKAN) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetition(CANCELED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(CANCELED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(CANCELED, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(CANCELED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(CANCELED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(CANCELED, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == BELUM_VALID) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetition(NOT_CONFIRMED, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(NOT_CONFIRMED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(NOT_CONFIRMED, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(NOT_CONFIRMED, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(NOT_CONFIRMED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(NOT_CONFIRMED, $request->keyword, CREATED_COLUMN);
                }
            }
        }
    }

    public function sortPetition($request)
    {
        $category = $this->event_service->categorySelect($request);
        $userId = $this->profile_service->getAProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->getListPetitionByStatus($request);
        }

        if ($request->typePetition == BERLANGSUNG) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, ACTIVE, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(ACTIVE, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, ACTIVE, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(ACTIVE, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, ACTIVE);
            }
        }
        if ($request->typePetition == MENANG) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, FINISHED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(FINISHED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, FINISHED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(FINISHED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, FINISHED);
            }
        }
        if ($request->typePetition == PARTISIPASI) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategoryParticipated($category, $userId, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetitionParticipated($userId, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategoryParticipated($category, $userId, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetitionParticipated($userId, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->participatedPetitionByCategory($category, $userId);
            }
        }
        if ($request->typePetition == PETISI_SAYA) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategoryByMe($category, $userId, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortMyPetition($userId, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategoryByMe($category, $userId, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortMyPetition($userId, CREATED_COLUMN);
            }
        }
        if ($request->typePetition == DIBATALKAN) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, CANCELED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(CANCELED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, CANCELED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(CANCELED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, CANCELED);
            }
        }
        if ($request->typePetition == BELUM_VALID) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, NOT_CONFIRMED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(NOT_CONFIRMED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, NOT_CONFIRMED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(NOT_CONFIRMED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, NOT_CONFIRMED);
            }
        }
        if ($request->typePetition == SEMUA) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->allStatusSortPetitionCategory($category, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->allStatusSortPetition(SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->allStatusSortPetitionCategory($category, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->allStatusSortPetition(CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->allStatusPetitionByCategory($category);
            }
        }

        // Jika hanya pilih berdasarkan category
        return $this->petition_dao->myPetitionByCategory($category, $userId);
    }

    //! Menampilkan detail petisi sesuai ID Petisi
    public function getDetailPetition($id)
    {
        return $this->petition_dao->getDetailPetition($id);
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function getCommentsCertainPetition($id)
    {
        return $this->petition_dao->getCommentsCertainPetition($id);
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function getProgressCertainPetition($id)
    {
        return $this->petition_dao->getProgressCertainPetition($id);
    }

    //! Menyimpan perkembangan berita terbaru yang diinput oleh pengguna pada petisi tertentu
    public function saveProgressPetition($updateNews)
    {
        $pathImage = HelperService::uploadImage($updateNews->getImage(), "petition/update_news");
        $updateNews->setImage($pathImage);
        $this->petition_dao->saveProgressPetition($updateNews);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signedThePetition($request, $idEvent, $user)
    {
        $petition = new Model\ParticipatePetition($idEvent, $user->id, $request->petitionComment, Carbon::now('+7:00'));

        // input data participant yang tanda tangan
        $this->petition_dao->signedThePetition($petition, $idEvent, $user);

        // update jumlah tandatangan petisi
        $count = $this->petition_dao->getCalculatedSignedPetition($idEvent);
        $this->petition_dao->updateCalculatedSign($idEvent, $count);

        // update jumlah partisipasi event yang diikuti user
        $this->profile_service->updateCountEventParticipatedByUser($user->id);
    }

    //! Menyimpan data petisi ke database
    public function saveDataEventPetition($petition)
    {
        $pathImage = HelperService::uploadImage(
            $petition->getPhoto(),
            "petition"
        );

        $petition->setPhoto($pathImage);
        $this->petition_dao->saveDataEventPetition($petition);
    }

    //! Mengubah data petisi
    public function updatePetition($petition, $id, $empty)
    {
        if (!$empty) {
            $pathImage = HelperService::uploadImage(
                $petition->getPhoto(),
                "petition"
            );

            $petition->setPhoto($pathImage);
        }

        $this->petition_dao->updatePetition($petition, $id);
    }
}
