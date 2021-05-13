<?php

namespace App\Domain\Petition\Service;

use App\Domain\Petition\Model;
use Carbon\Carbon;
use App\Domain\Helper\HelperService;
use App\Domain\Petition\Dao\PetitionDao;
use App\Domain\Profile\Service\ProfileService;

class PetitionService
{
    private $petition_dao;
    private $profile_service;

    public function __construct()
    {
        $this->petition_dao = new PetitionDao();
        $this->profile_service = new ProfileService();
    }

    private function updateCalculatedSignPetition($idEvent, $idUser)
    {
        $count = $this->petition_dao->calculatedSignDonation($idEvent, PETITION);
        $this->petition_dao->updateCalculatedSign($idEvent, $count);

        // Update jumlah event yang diikuti user\
        $totalEvent = HelperService::countTotalEventParticipatedByUser($idUser);
        $this->profile_service->updateCountEventParticipatedByUser($idUser, $totalEvent);
    }

    public function getPetitionLimit()
    {
        return $this->petition_dao->getAllActivePetition()->take(3);
    }

    //! Menampilkan seluruh petisi yang sedang berlangsung
    public function getAllActivePetition()
    {
        return $this->petition_dao->getAllActivePetition();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi berdasarkan tipe (berlangsung, telah menang, dll)
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
            return $this->petition_dao->allPetition();
        }

        return $this->petition_dao->listPetitionByMe($user->id);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function searchPetition($request)
    {
        $userId = $this->profile_service->getAProfile()->id;
        $category = HelperService::categorySelect($request);
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

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortPetition($request)
    {
        $category = HelperService::categorySelect($request);
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
    public function showPetition($id)
    {
        return $this->petition_dao->showPetition($id);
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function commentsPetition($id)
    {
        return $this->petition_dao->commentsPetition($id);
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function newsPetition($id)
    {
        return $this->petition_dao->newsPetition($id);
    }

    //! Menyimpan perkembangan berita terbaru yang diinput oleh pengguna pada petisi tertentu
    public function storeProgressPetition($updateNews)
    {
        $pathImage = HelperService::uploadImage($updateNews->getImage(), "petition/update_news");
        $updateNews->setImage($pathImage);
        $this->petition_dao->storeProgressPetition($updateNews);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signPetition($request, $idEvent, $user)
    {
        $petition = new Model\ParticipatePetition($idEvent, $user->id, $request->petitionComment, Carbon::now()->format('Y-m-d'));

        $this->petition_dao->signPetition($petition, $idEvent, $user);
        $this->updateCalculatedSignPetition($idEvent, $user->id);
    }

    //! Menyimpan data petisi ke database
    public function storePetition($petition)
    {
        $pathImage = HelperService::uploadImage(
            $petition->getPhoto(),
            "petition"
        );

        $petition->setPhoto($pathImage);
        $this->petition_dao->storePetition($petition);
    }

    //! Menyimpan data petisi ke database
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

    //! Memeriksa apakah participant sudah pernah berpartisipasi pada event petisi tertentu
    public function checkParticipated($idEvent, $user, $typeEvent)
    {
        if ($user->role != GUEST || $user->role != ADMIN) {
            $isInList = HelperService::checkParticipated($idEvent, $user->id, $typeEvent);
            // Cek apakah list hasil query kosong atau tidak. 
            // Jika true, artinya user belum pernah berpartisipasi di event itu
            return empty($isInList);
        }

        return false;
    }
}
