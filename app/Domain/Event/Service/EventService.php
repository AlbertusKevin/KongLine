<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Dao\EventDao;
use Illuminate\Support\Facades\Auth;
use App\Domain\Event\Entity\ParticipatePetition;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Domain\Event\Entity\User;
use Illuminate\Support\Str;

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
    //! Mengambil data user tertentu yang sedang mengakses aplikasi. 
    //! Jika tidak ada, maka dikembalikan akun guest (NULLOBJECT PATTERN)
    public function showProfile()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return $this->dao->showProfile(GUEST_ID);
    }

    private function updateCalculatedCount($idEvent, $idUser, $typeEvent)
    {
        // Update Count dari jumlah ttd petisi
        if ($typeEvent == PETITION) {
            $count = $this->dao->calculatedSignDonation($idEvent, PETITION);
            $this->dao->updateCalculatedSign($idEvent, $count);
        }

        // Update jumlah event yang diikuti user
        $countParticipatedDonation = $this->dao->countDonationParticipatedByUser($idUser);
        $countParticipatedPetition = $this->dao->countPetitionParticipatedByUser($idUser);
        $totalEvent = $countParticipatedDonation + $countParticipatedPetition;

        $this->dao->updateCountEventParticipatedByUser($idUser, $totalEvent);
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

    public function getACategory($id)
    {
        return $this->dao->getACategory($id);
    }

    //! Mengembalikan kategori event petisi atau donasi yang dipilih
    private function categorySelect($request)
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

    //! Mengambil nama bank yang bisa digunakan untuk transfer
    public function listBank()
    {
        return $this->dao->listBank();
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
                'content' => 'Event ini sudah selesai. Tidak menerima tanggapan lagi.'
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
    public function editProfile()
    {
        return $this->showProfile();
    }

    //! Memproses update profile
    public function updateProfile($request, $id)
    {
        $pathProfile = $this->uploadImage($request->file('profile_picture'), 'profile/photo');
        $pathBackground = $this->uploadImage($request->file('zoom_picture'), 'profile/background');
        $this->dao->updateProfile($request, $id, $pathProfile, $pathBackground);
    }

    public function deleteAccount($id)
    {
        return $this->dao->deleteAccount($id);
    }

    public function updateCampaigner($request, $user)
    {
        if ($user->role == CAMPAIGNER) {
            return $this->dao->updateAccountNumber($request, $user->id);
        }

        $pathKTP = $this->uploadImage($request->file('KTP_picture'), 'profile/KTP');
        return $this->dao->updateToCampaigner($request, $user->id, $pathKTP);
    }

    public function changePassword($request)
    {

        $user = $this->showProfile();

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->verification) {
                $password = Hash::make($request->new_password);
                $this->dao->changePassword($user, $password);
                return 'true';
            }
            return 'failed_verification';
        }

        return 'failed_password';
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
        $petition->created_at = Carbon::now()->format('Y-m-d');

        $this->dao->signPetition($petition, $idEvent, $user);
        $this->updateCalculatedCount($idEvent, $user->id, PETITION);
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
            // Jika true, artinya user belum pernah berpartisipasi di event itu
            return empty($isInList);
        }

        return false;
    }

    //! Memeriksa donasi dalam mode anonim atau tidak
    public function checkAnnonym($checked)
    {
        if ($checked == 'on') {
            return 1;
        }

        return 0;
    }

    //! Mengecek verifikasi data diri yang diberikan sebelum membuat event
    public function verifyProfile($email, $phone)
    {
        $campaigner = $this->dao->verifyProfile($email, $phone);

        if (empty($campaigner)) {
            return false;
        }

        return true;
    }

    //* =========================================================================================
    //* ------------------------------------- Service Auth --------------------------------------
    //* =========================================================================================

    public function authLogin($request)
    {
        return $this->dao->login($request);
    }

    public function authRegis($request)
    {
        $data = new User();
        $data->name = $request->firstname . ' ' . $request->lastname;
        $data->email = $request->email;
        $data->status = ACTIVE;
        $data->role = PARTICIPANT;
        $data->photoProfile = "images/profile/photo/default.svg";

        if ($request->password) {
            $data->password = Hash::make($request->password);
        }

        return $this->dao->register($data);
    }

    public function authForgot($request, $view, $subject)
    {
        $token = Str::random(64);

        $resultReset = $this->dao->reset($token, $request);
        $resultMail = $this->dao->mail($token, $request, $view, $subject);

        if ($resultReset && $resultMail) {
            return true;
        }

        return false;
    }

    public function authReset($request)
    {

        $resultGetPassword = $this->dao->getPasswordReset($request);

        if ($resultGetPassword) {
            $this->dao->updateUser($request);
            $this->dao->deleteToken($request);

            return true;
        }

        return false;
    }

    //* =========================================================================================
    //* ------------------------------------ Service Donasi -------------------------------------
    //* =========================================================================================
    public function checkValidDate($donation)
    {
        $time = Carbon::now()->format("Y-m-d");

        // dd("Deadline: " . strtotime($donation->deadline) . " | Today: " . strtotime($time) . " | Selisih: " . (strtotime($donation->deadline) - strtotime($time)));
        if (strtotime($donation->deadline) - strtotime($time) <= 0) {
            $this->dao->updateStatusEvent($donation->id, FINISHED);
        } else {
            return $donation;
        }

        return;
    }

    public function getListDonation()
    {
        $listDonation = $this->dao->getListDonation();
        $list = [];

        foreach ($listDonation as $donation) {
            $list[] = $this->checkValidDate($donation);
        }

        return $list;
    }

    public function getADonation($id)
    {
        return $this->dao->getADonation($id);
    }

    public function getParticipatedDonation($id)
    {
        return $this->dao->getParticipatedDonation($id);
    }

    public function getABudgetingDonation($id)
    {
        return $this->dao->getABudgetingDonation($id);
    }

    public function postDonate($participateDonation)
    {
        $this->dao->postDonate($participateDonation);
    }

    public function postTransaction($transaction)
    {
        $this->dao->postTransaction($transaction);
    }

    public function getAUserTransaction($idUser, $idEvent)
    {
        return $this->dao->getAUserTransaction($idUser, $idEvent);
    }

    public function checkUserTransactionStatus($participatedDonation, $id)
    {
        foreach ($participatedDonation as $participate) {
            // dd($participate);
            // if ($participate->status == 1 && $participate->idParticipant == $id) {
            //     return true;
            // }

            if ($participate->idParticipant == $id) {
                if ($participate->status == 1) {
                    return FINISHED;
                }
                if (!empty($participate->repaymentPicture) && $participate->status == 0) {
                    return WAITING;
                }
            }
        }

        return NOT_CONFIRMED;
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
        $pathRepaymentPicture = $this->uploadImage($picture, 'donation/bukti_transfer');
        $this->dao->confirmationPictureDonation($pathRepaymentPicture, $id);
    }

    public function countProgressDonation($donation)
    {
        return ($donation->donationCollected / $donation->donationTarget) * 100;
    }

    //! {{-- lewat ajax --}} Mencari donasi sesuai urutan dan kategori yang dipilih
    public function searchDonation($request)
    {
        $this->getListDonation();

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

            if ($sortBy == MY_DONATION) {
                return $this->dao->searchDonationCategoryByMe($request->keyword, $category, $userId);
            }

            if ($request->sortBy == PARTICIPATED_DONATION) {
                return $this->dao->searchDonationCategoryParticipated($request->keyword, $category, $userId);
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
                return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, DEADLINE_COLUMN);
            }

            if ($sortBy == SMALL_COLLECTED) {
                return $this->dao->searchDonationSortBy(ACTIVE, $request->keyword, COLLECTED_COLUMN);
            }

            if ($sortBy == MY_DONATION) {
                return $this->dao->searchDonationByMe($request->keyword, $userId);
            }

            if ($request->sortBy == PARTICIPATED_DONATION) {
                return $this->dao->searchDonationParticipated($request->keyword, $userId);
            }
        }
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortDonation($request)
    {
        $this->getListDonation();

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

    public function storeDonationCreated($donation)
    {
        $pathPhoto = $this->uploadImage($donation->getPhoto(), 'images/donation');
        $donation->setPhoto($pathPhoto);
        $this->dao->storeDonationCreated($donation);
    }

    public function storeDetailAllocation($allocationDetail)
    {
        $this->dao->storeDetailAllocation($allocationDetail);
    }

    public function getLastIdDonation()
    {
        return $this->dao->getLastIdDonation();
    }
}
