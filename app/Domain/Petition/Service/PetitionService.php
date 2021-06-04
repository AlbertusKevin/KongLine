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

    public function deadlinePetition()
    {
        $petitions = $this->getActivePetition();
        foreach ($petitions as $petition) {
            if (strtotime($petition->deadline) - strtotime(Carbon::now('+7:00')) <= 0) {
                if ($petition->signedTarget - $petition->signedCollected > 0) {
                    $stack = $petition->stack;
                    $data['updated_at'] = Carbon::now('+7:00');
                    $data['stack'] = $stack + 1;

                    if ($stack == 1) {
                        $data['deadline'] = Carbon::now('+7:00')->addMonth();
                        $data['signedTarget'] = SIGNED_TARGET_STACK_2;
                        $this->petition_dao->deadlinePetition($petition->id, $data);
                    } else if ($stack == 2) {
                        $data['deadline'] = Carbon::now('+7:00')->addMonth();
                        $data['signedTarget'] = SIGNED_TARGET_STACK_3;
                        $this->petition_dao->deadlinePetition($petition->id, $data);
                    } else if ($stack == 3) {
                        $data['deadline'] = Carbon::now('+7:00')->addMonths(3);
                        $data['signedTarget'] = SIGNED_TARGET_STACK_4;
                        $this->petition_dao->deadlinePetition($petition->id, $data);
                    } else if ($stack == 4) {
                        $data['deadline'] = Carbon::now('+7:00')->addMonths(6);
                        $data['signedTarget'] = SIGNED_TARGET_STACK_5;
                        $this->petition_dao->deadlinePetition($petition->id, $data);
                    } else if ($stack == 5) {
                        $data['deadline'] = Carbon::now('+7:00')->addMonths(12);
                        $data['signedTarget'] = SIGNED_TARGET_STACK_6;
                        $this->petition_dao->deadlinePetition($petition->id, $data);
                    } else {
                        $this->event_service->updateStatusEvent($petition->id, FINISHED, PETITION);
                    }
                } else {
                    $this->event_service->updateStatusEvent($petition->id, TARGET_REACHED, PETITION);
                }
            }
        }
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
            return $this->petition_dao->getListPetitionByStatus(PROCEEDED);
        }

        if ($request->typePetition == MENCAPAI_TARGET) {
            return $this->petition_dao->getListPetitionByStatus(TARGET_REACHED);
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
        // dd($request);
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
                return $this->petition_dao->searchPetition(PROCEEDED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(PROCEEDED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(PROCEEDED, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(PROCEEDED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(PROCEEDED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(PROCEEDED, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == SEMUA) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchAllPetition($request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchAllPetitionCategorySort(PROCEEDED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchAllPetitionCategorySort(PROCEEDED, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->petition_dao->searchAllPetitionCategory(PROCEEDED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchAllPetitionSortBy(PROCEEDED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchAllPetitionSortBy(PROCEEDED, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == MENCAPAI_TARGET) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->petition_dao->searchPetition(TARGET_REACHED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionCategorySort(TARGET_REACHED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionCategorySort(TARGET_REACHED, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->petition_dao->searchPetitionCategory(TARGET_REACHED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->petition_dao->searchPetitionSortBy(TARGET_REACHED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->petition_dao->searchPetitionSortBy(TARGET_REACHED, $request->keyword, CREATED_COLUMN);
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
                    return $this->petition_dao->sortPetitionCategory($category, PROCEEDED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(PROCEEDED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, PROCEEDED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(PROCEEDED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, PROCEEDED);
            }
        }
        if ($request->typePetition == MENCAPAI_TARGET) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, TARGET_REACHED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(TARGET_REACHED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->petition_dao->sortPetitionCategory($category, TARGET_REACHED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->petition_dao->sortPetition(TARGET_REACHED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->petition_dao->petitionByCategory($category, TARGET_REACHED);
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
        $folder = $this->getDetailPetition($updateNews->getIdPetition())->title;
        $folder = HelperService::makeSlugify($folder);
        $folder = FOLDER_IMAGE_PETITION_PROGRESS . $folder;

        $pathImage = HelperService::uploadImage($updateNews->getImage(), $folder);
        $updateNews->setImage($pathImage);
        $this->petition_dao->saveProgressPetition($updateNews);
    }

    public function updateProgressPetition($request, $idEvent, $idNews, $isFileNull)
    {
        $oldNews = $this->petition_dao->getDetailNewsProgress($idNews);

        if (!$isFileNull) {
            HelperService::deleteImage($oldNews->image);
            $folder = $this->getDetailPetition($idEvent)->title;
            $folder = HelperService::makeSlugify($folder);
            $pathImage = HelperService::uploadImage(
                $request->file('image'),
                FOLDER_IMAGE_PETITION_PROGRESS . $folder
            );
        } else {
            $pathImage = $oldNews->image;
        }

        $data = [
            'idNews' => $idNews,
            'title' => $request->title,
            'idPetition' => $idEvent,
            'image' => $pathImage,
            'content' => $request->content,
            'link' => (is_null($request->link) ? null : $request->protocol . $request->link),
            'updated_at' => Carbon::now('+7:00')
        ];
        $this->petition_dao->updateProgressPetition($data);
    }

    public function deleteProgressPetition($idNews)
    {
        $this->petition_dao->deleteProgressPetition($idNews, Carbon::now("+7:00"));
    }

    public function getDetailNewsProgress($idNews)
    {
        return $this->petition_dao->getDetailNewsProgress($idNews);
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
            FOLDER_IMAGE_PETITION
        );

        $petition->setPhoto($pathImage);
        $this->petition_dao->saveDataEventPetition($petition);
    }

    //! Mengubah data petisi
    public function updatePetition($oldPetition, $petition, $id, $empty)
    {
        if (!$empty) {
            HelperService::deleteImage($oldPetition->photo);
            $pathImage = HelperService::uploadImage(
                $petition->getPhoto(),
                FOLDER_IMAGE_PETITION
            );

            $petition->setPhoto($pathImage);
        }

        $this->petition_dao->updatePetition($petition, $id);
    }
}
