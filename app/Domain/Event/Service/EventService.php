<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Dao\EventDao;
use Illuminate\Support\Facades\Auth;
use App\Domain\Event\Entity\ParticipatePetition;
use Carbon\Carbon;

class EventService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new EventDao();
    }

    //* =========================================================================================
    //* ------------------------------------- Service Umum --------------------------------------
    //* =========================================================================================
    //! Mengambil user tertentu yang sedang mengakses aplikasi (NullObject Pattern)
    public function showProfile()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return $this->dao->showProfile(ACTIVE);
    }

    //! Mengupload gambar dan mengembalikan path dari gambar yang diupload
    private function uploadImage($img, $folder)
    {
        $pictName = $img->getClientOriginalName();
        //ambil ekstensi file
        $pictName = explode('.', $pictName);
        //buat nama baru yang unique
        $pictName = uniqid() . '.' . end($pictName); //7dsf83hd.jpg
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images/" . $folder . "/";

        $img->move($targetUploadDesc, $pictName);

        return $targetUploadDesc . "" . $pictName;   //membuat file path yang akan digunakan sebagai src html
    }

    //! Mengembalikan kategori event petisi atau donasi yang dipilih
    public function categorySelect($request)
    {
        $listCategory = $this->dao->listCategory();

        foreach ($listCategory as $cat) {
            if ($request->category == $cat->description) {
                return $cat->id;
            }
        }
        return 0;
    }

    //! Mengambil data seluruh kategori event petisi atau donasi yang ada
    public function listCategory()
    {
        return $this->dao->listCategory();
    }

    public function messageOfEvent($status)
    {
        if ($status == NOT_CONFIRMED) {
            return [
                'header' => 'Menunggu Konfirmasi',
                'content' => 'Event ini sudah didaftarkan. Tunggu konfirmasi dari pihak admin.'
            ];
        } else if ($status == FINISHED) {
            return [
                'header' => 'Telah Selesai',
                'content' => 'Event ini sudah selesai. Tidak menerima tandatangan lagi.'
            ];
        } else if ($status == CLOSED) {
            return [
                'header' => 'Sudah Ditutup',
                'content' => 'Event ini telah ditutup oleh penyelenggara / admin.'
            ];
        }

        return [
            'header' => 'Dibatalkan',
            'content' => 'Event ini dibatalkan oleh penyelenggara.'
        ];
    }
    //* =========================================================================================
    //* ----------------------------------- Service Profile -------------------------------------
    //* =========================================================================================
    //! Menampilkan halaman detail + form untuk update profile user tertentu
    public function editProfile($id)
    {
        return $this->dao->showProfile($id);
    }

    //! Memproses update profile
    public function updateProfile($request, $id)
    {
        $pathProfile = $this->uploadImage($request->file('profile/profile_picture'), 'photo');
        $pathBackground = $this->uploadImage($request->file('profile/zoom_picture'), 'background');
        $this->dao->updateProfile($request, $id, $pathProfile, $pathBackground);
    }

    //* =========================================================================================
    //* ------------------------------------ Service Petisi -------------------------------------
    //* =========================================================================================
    //! Menampilkan seluruh petisi yang sedang berlangsung 
    public function indexPetition()
    {
        return $this->dao->indexPetition();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi berdasarkan tipe (berlangsung, telah menang, dll)
    public function listPetitionType($request)
    {
        $user = $this->showProfile();

        if ($request->typePetition == BERLANGSUNG) {
            return $this->dao->listPetitionType(ACTIVE);
        }

        if ($request->typePetition == MENANG) {
            return $this->dao->listPetitionType(FINISHED);
        }

        if ($request->typePetition == PARTISIPASI) {
            return $this->dao->listPetitionParticipated($user->id);
        }

        return $this->dao->listPetitionByMe($user->id);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function searchPetition($request)
    {
        $userId = $this->showProfile()->id;
        $category = $this->categorySelect($request);
        $sortBy = $request->sortBy;

        if ($request->typePetition == BERLANGSUNG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchPetition(ACTIVE, $request->keyword);
            }

            // jika berdasarkan sort dan category
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionCategorySort(ACTIVE, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionCategorySort(ACTIVE, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            // Jika hanya berdasarkan category
            if ($category != 0) {
                return $this->dao->searchPetitionCategory(ACTIVE, $request->keyword, $category);
            }

            // Jika hanya berdasarkan sort
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionSortBy(ACTIVE, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionSortBy(ACTIVE, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == MENANG) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchPetition(FINISHED, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionCategorySort(FINISHED, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionCategorySort(FINISHED, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->dao->searchPetitionCategory(FINISHED, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionSortBy(FINISHED, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionSortBy(FINISHED, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == PARTISIPASI) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchPetitionParticipated($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionParticipatedCategorySort($userId, $request->keyword, $category, CREATED_COLUMN);
                }
            }
            if ($category != 0) {
                return $this->dao->searchPetitionParticipatedCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionParticipatedSortBy($userId, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionParticipatedSortBy($userId, $request->keyword, CREATED_COLUMN);
                }
            }
        }

        if ($request->typePetition == PETISI_SAYA) {
            if ($category == 0 && $sortBy == NONE) {
                return $this->dao->searchPetitionByMe($userId, $request->keyword);
            }
            if ($category != 0 && $sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionByMeCategorySort($userId, $request->keyword, $category, CREATED_COLUMN);
                }
            }

            if ($category != 0) {
                return $this->dao->searchPetitionByMeCategory($userId, $request->keyword, $category);
            }
            if ($sortBy != NONE) {
                if ($sortBy == TANDA_TANGAN) {
                    return $this->dao->searchPetitionByMeSort($userId, $request->keyword, SIGNED_COLUMN);
                }
                if ($sortBy == EVENT_TERBARU) {
                    return $this->dao->searchPetitionByMeSort($userId, $request->keyword, CREATED_COLUMN);
                }
            }
        }
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortPetition($request)
    {
        $category = $this->categorySelect($request);
        $userId = $this->showProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->listPetitionType($request);
        }

        if ($request->typePetition == BERLANGSUNG) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, ACTIVE, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetition(ACTIVE, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, ACTIVE, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetition(ACTIVE, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->petitionByCategory($category, ACTIVE);
            }
        }
        if ($request->typePetition == MENANG) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, FINISHED, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetition(FINISHED, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategory($category, FINISHED, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetition(FINISHED, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->petitionByCategory($category, FINISHED);
            }
        }
        if ($request->typePetition == PARTISIPASI) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryParticipated($category, $userId, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetitionParticipated($userId, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryParticipated($category, $userId, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortPetitionParticipated($userId, CREATED_COLUMN);
            }

            // Jika hanya pilih berdasarkan category
            if ($request->sortBy == NONE) {
                return $this->dao->participatedPetitionByCategory($category, $userId);
            }
        }
        if ($request->typePetition == PETISI_SAYA) {
            // Jika sort dipilih
            if ($request->sortBy == TANDA_TANGAN) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryByMe($category, $userId, SIGNED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortMyPetition($userId, SIGNED_COLUMN);
            }

            // Jika sort dipilih
            if ($request->sortBy == EVENT_TERBARU) {
                //jika category juga dipilih
                if ($category != 0) {
                    return $this->dao->sortPetitionCategoryByMe($category, $userId, CREATED_COLUMN);
                }
                // jika hanya sort
                return $this->dao->sortMyPetition($userId, CREATED_COLUMN);
            }
        }

        // Jika hanya pilih berdasarkan category
        return $this->dao->myPetitionByCategory($category, $userId);
    }

    //! Menampilkan detail petisi sesuai ID Petisi
    public function showPetition($id)
    {
        return $this->dao->showPetition($id);
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function commentsPetition($id)
    {
        return $this->dao->commentsPetition($id);
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function newsPetition($id)
    {
        return $this->dao->newsPetition($id);
    }

    //! Menyimpan perkembangan berita terbaru yang diinput oleh pengguna pada petisi tertentu
    public function storeProgressPetition($updateNews)
    {
        $pathImage = $this->uploadImage($updateNews->getImage(), "petition/update_news");
        $updateNews->setImage($pathImage);
        $this->dao->storeProgressPetition($updateNews);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signPetition($request, $idEvent, $user)
    {
        $petition = new ParticipatePetition();
        $petition->idPetition = $idEvent;
        $petition->idParticipant = $user->id;
        $petition->comment = $request->petitionComment;
        $petition->created_CCREATED_COLUMN_at = Carbon::now()->format('Y-m-d');

        $this->dao->signPetition($petition, $idEvent, $user);
        $count = $this->dao->calculatedSign($idEvent);
        $this->dao->updateCalculatedSign($idEvent, $count);
    }

    //! Menyimpan data petisi ke database
    public function storePetition($petition)
    {
        $pathImage = $this->uploadImage(
            $petition->getPhoto(),
            "petition"
        );

        $petition->setPhoto($pathImage);
        $this->dao->storePetition($petition);
    }

    //! Memeriksa apakah participant sudah pernah berpartisipasi pada event petisi tertentu
    public function checkParticipated($idEvent, $user, $typeEvent)
    {
        if ($user->role != GUEST || $user->role != ADMIN) {
            $isInList = $this->dao->checkParticipated($idEvent, $user->id, $typeEvent);
            // Cek apakah list hasil query kosong atau tidak. 
            // Jika kosong, artinya user belum pernah berpartisipasi di event itu
            return empty($isInList);
        }

        return false;
    }

    //* =========================================================================================
    //* ------------------------------------ Service Donasi -------------------------------------
    //* =========================================================================================
    public function getListDonation()
    {
        return $this->dao->getListDonation();
    }

    //! {{-- lewat ajax --}} Mencari donasi sesuai urutan dan kategori yang dipilih
    public function searchDonation($request)
    {
        $userId = $this->showProfile()->id;
        $category = $this->categorySelect($request);
        $sortBy = $request->sortBy;

        // search biasa tanpa kategori dan sorting tertentu
        if ($category == 0 && $sortBy == NONE) {
            return $this->dao->searchDonationByKeyword(ACTIVE, $request->keyword);
        }

        // search jika berdasarkan sort dan category
        if ($category != 0 && $sortBy != NONE) {
            if ($sortBy == DEADLINE) {
                return $this->dao->searchDonationCategorySortAsc(ACTIVE, $request->keyword, $category, DEADLINE_COLUMN);
            }
            if ($sortBy == SMALL_COLLECTED) {
                return $this->dao->searchDonationCategorySortAsc(ACTIVE, $request->keyword, $category, COLLECTED_COLUMN);
            }
            //todo: sorting berdasarkan sisa target donasi yang paling sedikit
            // if ($sortBy == "Sisa Target") {
            //     return $this->dao->searchPetitionCategorySortTargetLeft(ACTIVE, $request->keyword, $category, CREATED);
            // }
            //todo: end of todo
        }

        // Search jika hanya berdasarkan category
        if ($category != 0) {
            return $this->dao->searchDonationCategory(ACTIVE, $request->keyword, $category);
        }

        // Jika hanya berdasarkan sort
        if ($sortBy != NONE) {
            if ($sortBy == DEADLINE) {
                return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, $category, DEADLINE_COLUMN);
            }
            if ($sortBy == SMALL_COLLECTED) {
                return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, $category, COLLECTED_COLUMN);
            }
        }
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortDonation($request)
    {
        $category = $this->categorySelect($request);
        $userId = $this->showProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == NONE && $category == 0) {
            return $this->getListDonation();
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

        if ($request->sortBy == DEADLINE) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->dao->sortDonationCategory($category, ACTIVE, DEADLINE_COLUMN);
            }
            // jika hanya sort
            return $this->dao->sortDonation(ACTIVE, DEADLINE_COLUMN);
        }

        if ($request->sortBy == MY_DONATION) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->dao->sortDonationCategoryByCampaigner($category, $userId);
            }
            // jika hanya sort
            return $this->dao->sortDonationByCampaigner($userId);
        }

        if ($request->sortBy == PARTICIPATED_DONATION) {
            //jika category juga dipilih
            if ($category != 0) {
                return $this->dao->sortDonationCategoryParticipated($category, $userId);
            }
            // jika hanya sort
            return $this->dao->sortDonationParticipated($userId);
        }

        // Jika hanya pilih berdasarkan category
        if ($request->sortBy == NONE) {
            return $this->dao->donationByCategory($category, ACTIVE);
        }
    }
}
