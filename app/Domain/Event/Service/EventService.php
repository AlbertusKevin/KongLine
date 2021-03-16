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

        return $this->dao->showProfile(1);
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

    public function deleteAccount($id) 
    {
        return $this->dao->deleteAccount($id);
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

        if ($request->typePetition == "berlangsung") {
            return $this->dao->listPetitionType(1);
        }

        if ($request->typePetition == "menang") {
            return $this->dao->listPetitionType(2);
        }

        if ($request->typePetition == "partisipasi") {
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

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortPetition($request)
    {
        $category = $this->categorySelect($request);
        $userId = $this->showProfile()->id;

        //jika tidak sort dan tidak pilih category
        if ($request->sortBy == "None" && $category == 0) {
            return $this->listPetitionType($request);
        }

        if ($request->typePetition == 'berlangsung') {
            // Category = none, sort = ttd
            // Jika sort dipilih
            if ($request->sortBy == "Jumlah Tanda Tangan") {
                //jika category juga dipilih
                if ($category != 0) {
                    // dd($this->dao->sortPetitionCategory($category, 1, 'signedCollected'));
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
        $petition->created_at = Carbon::now()->format('Y-m-d');

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
    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        $isInList = $this->dao->checkParticipated($idEvent, $idParticipant, $typeEvent);
        return empty($isInList);
    }

    //* =========================================================================================
    //* ------------------------------------ Service Donasi -------------------------------------
    //* =========================================================================================
}
