<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Dao\EventDao;
use Illuminate\Support\Facades\Auth;

class EventService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new EventDao();
    }

    private function upload_image($img, $folder)
    {
        $pictName = $img->getClientOriginalName();
        //ambil ekstensi file
        $pictName = explode('.', $pictName);
        //buat nama baru yang unique
        $pictName = uniqid() . '.' . end($pictName); //7dsf83hd.jpg
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images\\profile\\" . $folder . "\\";
        $img->move($targetUploadDesc, $pictName);

        return $targetUploadDesc . "\\" . $pictName;   //membuat file path yang akan digunakan sebagai src html
    }

    //? ===================================================================
    //! Profile Service
    //? ===================================================================

    public function editProfile($id)
    {
        return $this->dao->showProfile($id);
    }

    public function updateProfile($request, $id)
    {
        // $pathProfile = $this->upload_image($request->file('profile_picture'), 'photo');
        // $pathBackground = $this->upload_image($request->file('zoom_picture'), 'background');
        $this->dao->updateProfile($request, $id);
    }

    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Petition Service ~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================

    public function indexPetition()
    {
        return $this->dao->indexPetition();
    }

    public function listPetitionType($request)
    {
        $userId = Auth::user()->id;

        if ($request->typePetition == "berlangsung") {
            return $this->dao->listPetitionType(1);
        }

        if ($request->typePetition == "menang") {
            return $this->dao->listPetitionType(2);
        }

        if ($request->typePetition == "partisipasi") {
            return $this->dao->listPetitionParticipated($userId);
        }

        return $this->dao->listPetitionByMe($userId);
    }

    public function searchPetition($request)
    {
        $userId = Auth::user();
        $userId = $userId->id;
        $category = $this->categorySelect($request);
        $sortBy = $request->sortBy;

        if ($request->typePetition == "berlangsung") {
            if ($category == 0 && $sortBy == "None") {
                return $this->dao->searchPetition(1, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionCategorySort(1, $request->keyword, $category, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionCategorySort(1, $request->keyword, $category, 'created_at');
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchPetitionCategory(1, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionSortBy(1, $request->keyword, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionSortBy(1, $request->keyword, 'created_at');
                }
            }
        }

        if ($request->typePetition == "menang") {
            if ($category == 0 && $sortBy == "None") {
                return $this->dao->searchPetition(2, $request->keyword);
            }
            if ($category != 0 && $sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionCategorySort(2, $request->keyword, $category, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionCategorySort(2, $request->keyword, $category, 'created_at');
                }
            }
            if ($category != 0) {
                return $this->dao->searchPetitionCategory(2, $request->keyword, $category);
            }
            if ($sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionSortBy(2, $request->keyword, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionSortBy(2, $request->keyword, 'created_at');
                }
            }
        }

        //todo: Integrasi search dengan sort-category dan type
        if ($request->typePetition == "partisipasi") {
            if ($category == 0 && $sortBy == "None") {
                return $this->dao->searchPetitionParticipated($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, 'created_at');
                }
            }
            if ($category != 0) {
                return $this->dao->searchPetitionParticipatedCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionParticipatedSortBy($userId, $request->keyword, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionParticipatedSortBy($userId, $request->keyword, 'created_at');
                }
            }
        }

        if ($request->typePetition == "petisi_saya") {
            if ($category == 0 && $sortBy == "None") {
                return $this->dao->searchPetitionByMe($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, 'created_at');
                }
            }

            if ($category != 0) {
                return $this->dao->searchPetitionByMeCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != "None") {
                if ($sortBy == "Jumlah Tanda Tangan") {
                    return $this->dao->searchPetitionByMeSort($userId, $request->keyword, 'signedCollected');
                }
                if ($sortBy == "Event Terbaru") {
                    return $this->dao->searchPetitionByMeSort($userId, $request->keyword, 'created_at');
                }
            }
        }
    }

    public function categorySelect($request)
    {
        if ($request->category == "Pendidikan") {
            return 1;
        } else if ($request->category == "Bencana Alam") {
            return 2;
        } else if ($request->category == "Difabel") {
            return 3;
        } else if ($request->category == "Infrastruktur Umum") {
            return 4;
        } else if ($request->category == "Teknologi") {
            return 5;
        } else if ($request->category == "Budaya") {
            return 6;
        } else if ($request->category == "Karya Kreatif & Modal") {
            return 7;
        } else if ($request->category == "Kegiatan Sosial") {
            return 8;
        } else if ($request->category == "Kemanusiaan") {
            return 9;
        } else if ($request->category == "Lingkungan") {
            return 10;
        } else if ($request->category == "Hewan") {
            return 11;
        } else if ($request->category == "Panti Asuhan") {
            return 12;
        } else if ($request->category == "Rumah Ibadah") {
            return 13;
        } else if ($request->category == "Ekonomi") {
            return 14;
        } else if ($request->category == "Politik") {
            return 15;
        } else if ($request->category == "Keadilan") {
            return 16;
        }

        return 0;
    }

    public function sortPetition($request)
    {
        $category = $this->categorySelect($request);
        $userId = Auth::id();

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == "None" && $request->category == 0) {
            return $this->listPetitionType($request);
        }

        if ($request->typePetition == 'berlangsung') {
            // Jika sort dipilih
            if ($request->sortBy == "Jumlah Tanda Tangan") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, 1, 'signedCollected');
                }
                // jika hanya sort
                return $this->dao->sortPetition(1, 'signedCollected');
            }

            // Jika sort dipilih
            if ($request->sortBy == "Event Terbaru") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, 1, 'created_at');
                }
                // jika hanya sort
                return $this->dao->sortPetition(1, 'created_at');
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == "None") {
                return $this->dao->petitionByCategory($category, 1);
            }
        }
        if ($request->typePetition == 'menang') {
            // Jika sort dipilih
            if ($request->sortBy == "Jumlah Tanda Tangan") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, 2, 'signedCollected');
                }
                // jika hanya sort
                return $this->dao->sortPetition(2, 'signedCollected');
            }

            // Jika sort dipilih
            if ($request->sortBy == "Event Terbaru") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, 2, 'created_at');
                }
                // jika hanya sort
                return $this->dao->sortPetition(2, 'created_at');
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == "None") {
                return $this->dao->petitionByCategory($category, 2);
            }
        }
        if ($request->typePetition == 'partisipasi') {
            // Jika sort dipilih
            if ($request->sortBy == "Jumlah Tanda Tangan") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryParticipated($category, $userId, 'signedCollected');
                }
                // jika hanya sort
                return $this->dao->sortPetitionParticipated($userId, 'signedCollected');
            }

            // Jika sort dipilih
            if ($request->sortBy == "Event Terbaru") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryParticipated($category, $userId, 'created_at');
                }
                // jika hanya sort
                return $this->dao->sortPetitionParticipated($userId, 'created_at');
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == "None") {
                return $this->dao->participatedPetitionByCategory($category, $userId);
            }
        }
        if ($request->typePetition == 'petisi_saya') {
            // Jika sort dipilih
            if ($request->sortBy == "Jumlah Tanda Tangan") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryByMe($category, $userId, 'signedCollected');
                }
                // jika hanya sort
                return $this->dao->sortMyPetition($userId, 'signedCollected');
            }

            // Jika sort dipilih
            if ($request->sortBy == "Event Terbaru") {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryByMe($category, $userId, 'created_at');
                }
                // jika hanya sort
                return $this->dao->sortMyPetition($userId, 'created_at');
            }
        }

        // Jika hanya pilih berdasarkan category
        return $this->dao->myPetitionByCategory($category, $userId);
    }

    public function showPetition($id)
    {
        return $this->dao->showPetition($id);
    }

    public function signPetition($request, $idEvent, $user)
    {
        return $this->dao->signPetition($request, $idEvent, $user);
    }

    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        $isInList = $this->dao->checkParticipated($idEvent, $idParticipant, $typeEvent);
        return empty($isInList);
    }
}
