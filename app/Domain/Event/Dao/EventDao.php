<?php

namespace App\Domain\Event\Dao;

use App\Domain\Event\Entity\Bank;
use App\Domain\Event\Entity\Category;
use App\Domain\Event\Entity\DetailAllocation;
use App\Domain\Event\Entity\Donation;
use App\Domain\Event\Entity\EventStatus;
use App\Domain\Event\Entity\Forum;
use App\Domain\Event\Entity\ForumLike;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;
use App\Domain\Event\Entity\Petition;
use App\Domain\Event\Entity\Service;
use App\Domain\Event\Entity\Transaction;
use App\Domain\Event\Entity\UpdateNews;
use App\Domain\Event\Entity\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class EventDao
{
    //! Mengambil data kategori event yang ada
    public function listCategory()
    {
        return Category::all();
    }

    //! Mengambil nama bank yang bisa digunakan untuk transfer
    public function listBank()
    {
        return Bank::all();
    }

    public function getACategory($id)
    {
        return Category::where('id', $id)->first();
    }

    //! Memeriksa apakah participant pernah berpartisipasi pada event tertentu
    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        if ($typeEvent == PETITION) {
            return ParticipatePetition::where('idParticipant', $idParticipant)->where('idPetition', $idEvent)->first();
        }

        return ParticipateDonation::where('idParticipant', $idParticipant)->where('idDonation', $idEvent)->first();
    }

    //! Memeriksa apakah participant pernah berpartisipasi pada event tertentu
    public function verifyProfile($email, $phone)
    {
        return User::where('email', $email)->where('phoneNumber', $phone)->first();
    }

    //! Menghitung total event yang sudah pernah diikuti user tertentu
    public function countDonationParticipatedByUser($idUser)
    {
        return ParticipateDonation::where('idParticipant', $idUser)->count();
    }

    //! Menghitung total event yang sudah pernah diikuti user tertentu
    public function countPetitionParticipatedByUser($idUser)
    {
        return ParticipatePetition::where('idParticipant', $idUser)->count();
    }

    public function updateCountEventParticipatedByUser($idUser, $count)
    {
        User::where('id', $idUser)->update([
            'countEvent' => $count
        ]);
    }

    //* =========================================================================================
    //* ------------------------------------- DAO Profile ---------------------------------------
    //* =========================================================================================
    //! Mengambil data user berdasarkan id
    public function showProfile($id)
    {
        return User::where('id', $id)->first();
    }

    //! Memproses update data profile
    public function updateProfile($request, $id, $pathProfile, $pathBackground)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'aboutMe' => $request->aboutMe,
            'city' => $request->city,
            'linkProfile' => $request->linkProfile,
            'address' => $request->address,
            'zipCode' => $request->zipCode,
            'phoneNumber' => $request->phoneNumber,
            'photoProfile' => $pathProfile,
            'backgroundPicture' => $pathBackground
        ]);
    }

    public function deleteAccount($id)
    {
        User::where('id', $id)->update([
            'status' => DELETED
        ]);
    }

    public function updateToCampaigner($request, $id, $pathKTP)
    {
        User::where('id', $id)->update([
            'accountNumber' => $request->rekening,
            'nik' => $request->nik,
            'ktpPicture' => $pathKTP,
            'status' => 3
        ]);
    }

    public function updateAccountNumber($request, $id)
    {
        User::where('id', $id)->update([
            'accountNumber' => $request->rekening
        ]);
    }

    public function changePassword($user, $password)
    {
        User::where('id', $user->id)->update([
            'password' => $password
        ]);
    }

    //* =========================================================================================
    //* -------------------------------------- DAO Petisi ---------------------------------------
    //* =========================================================================================
    //! Mencari petisi sesuai dengan
    //! status (berdasarkan tipe petisi) dan keyword tertentu

    public function searchPetition($status, $keyword)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan
    //! keyword tertentu
    public function searchPetitionByMe($idCampaigner, $keyword)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionByMeCategorySort($idCampaigner, $keyword, $category, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionByMeCategory($idCampaigner, $keyword, $category)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner
    //! sesuai dengan keyword dan sorting desc tertentu
    public function searchPetitionByMeSort($idCampaigner, $keyword, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword tertentu
    public function searchPetitionParticipated($idParticipant, $keyword)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionParticipatedCategorySort($idParticipant, $keyword, $category, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchPetitionParticipatedSortBy($idParticipant, $keyword, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionParticipatedCategory($idParticipant, $keyword, $category)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionCategorySort($status, $keyword, $category, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionCategory($status, $keyword, $category)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->get();;
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchPetitionSortBy($status, $keyword, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();;
    }

    //! Mengurutkan petisi sesuai dengan
    //! sorting desc dan kategori tertentu
    public function sortPetitionCategory($category, $status, $table)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mengurutkan petisi dengan status tertentu
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetition($status, $table)
    {
        return Petition::where('status', $status)
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi dengan status tertentu sesuai kategori tertentu
    public function petitionByCategory($category, $status)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->get();
    }

    //! Mengurutkan petisi yang dibuat oleh campaigner dan sesuai kategori tertentu
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionCategoryByMe($category, $idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mengurutkan petisi yang dibuat oleh campaigner
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortMyPetition($idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi yang dibuat oleh campaigner sesuai kategori tertentu
    public function myPetitionByCategory($category, $idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->get();
    }

    //! Mengurutkan petisi yang pernah diikuti participant sesuai kategori tertentu
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionCategoryParticipated($category, $idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mengurutkan petisi yang pernah diikuti participant
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionParticipated($idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Menampilkan petisi pernah diikuti participant sesuai kategori tertentu
    public function participatedPetitionByCategory($category, $idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->get();
    }

    //! Menampilkan daftar petisi berdasarkan tipe event (berlangsung, menang, dll)
    public function listPetitionType($status)
    {
        return Petition::where('status', $status)->get();
    }

    //! Menampilkan daftar petisi yang pernah diikuti participant
    public function listPetitionParticipated($idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->get();
    }

    //! Menampilkan daftar petisi yang dibuat oleh campaigner
    public function listPetitionByMe($idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)->get();
    }

    //! Menampilkan seluruh daftar petisi yang sedang aktif
    public function indexPetition()
    {
        return Petition::where('status', ACTIVE)->get();
    }

    //! Menampilkan detail petisi tertentu berdasarkan ID
    public function showPetition($id)
    {
        return Petition::where('id', $id)->first();
    }

    //! Menampilkan komentar yang ada pada petisi tertentu berdasarkan ID
    public function commentsPetition($id)
    {
        return ParticipatePetition::where('idPetition', $id)
            ->join('users', 'participate_petition.idParticipant', '=', 'users.id')
            ->get();
    }

    //! Menampilkan berita perkembangan yang ada pada petisi tertentu berdasarkan ID
    public function newsPetition($id)
    {
        return UpdateNews::where('idPetition', $id)->get();
    }

    //! Menyimpan data berita perkembangan yang dibuat oleh campaigner
    public function storeProgressPetition($updateNews)
    {
        UpdateNews::create([
            'idPetition' => $updateNews->getIdPetition(),
            'image' => $updateNews->getImage(),
            'title' => $updateNews->getTitle(),
            'content' => $updateNews->getContent(),
            'link' => $updateNews->getLink(),
            'created_at' => $updateNews->getCreatedAt()
        ]);
    }

    //! Menyimpan data event petisi yang dibuat oleh campaigner
    public function storePetition($petition)
    {
        Petition::create([
            'idCampaigner' => $petition->getIdCampaigner(),
            'title' => $petition->getTitle(),
            'photo' => $petition->getPhoto(),
            'category' => $petition->getCategory(),
            'purpose' => $petition->getPurpose(),
            'deadline' => $petition->getDeadline(),
            'status' => $petition->getStatus(),
            'created_at' => $petition->getCreatedAt(),
            'signedCollected' => $petition->getSignedCollected(),
            'signedTarget' => $petition->getSignedTarget(),
            'targetPerson' => $petition->getTargetPerson()
        ]);
    }

    //! Menyimpan data participant yang berpartisipasi pada petisi tertentu
    public function signPetition($petition)
    {
        return ParticipatePetition::create([
            'idPetition' => $petition->idPetition,
            'idParticipant' => $petition->idParticipant,
            'comment' => $petition->comment,
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
    }

    //! Mengambil jumlah total tandatangan petisi tertentu saat itu
    public function calculatedSignDonation($idEvent, $typeEvent)
    {
        if ($typeEvent == PETITION) {
            return ParticipatePetition::where('idPetition', $idEvent)->count();
        }

        // return ParticipatePetition::where('idPetition', $idEvent)->count();
    }

    //! Update jumlah tandatangan petisi tertentu
    public function updateCalculatedSign($idEvent, $count)
    {
        return Petition::where('id', $idEvent)->update([
            'signedCollected' => $count
        ]);
    }

    //* =========================================================================================
    //* --------------------------------------- DAO Auth ----------------------------------------
    //* =========================================================================================
    public function login($request)
    {
        return Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ]);
    }

    public function register($data)
    {
        return $data->save();
    }

    public function reset($token, $request)
    {
        return DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
    }

    public function mail($token, $request, $view, $subject)
    {
        Mail::send($view, ['token' => $token, 'email' => $request->email], function ($message) use ($request, $subject) {
            $message->to($request->email);
            $message->subject($subject);
        });
    }

    public function getPasswordReset($request)
    {
        return DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();
    }

    public function updateUser($request)
    {
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    }

    public function deleteToken($request)
    {
        DB::table('password_resets')->where(['email' => $request->email])->delete();
    }

    //* =========================================================================================
    //* ------------------------------------ DAO Donation ---------------------------------------
    //* =========================================================================================
    //! Mengambil seluruh donasi dengan status aktif / sedang berlangsung
    public function getListDonation()
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', ACTIVE)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengambil seluruh donasi dengan status aktif / sedang berlangsung
    public function getADonation($id)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.id', $id)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->first();
    }

    public function getParticipatedDonation($idEvent)
    {
        return ParticipateDonation::selectRaw('participate_donation.*,transaction.*, users.name as name, users.photoProfile as photoProfile')
            ->where('participate_donation.idDonation', $idEvent)
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->join('transaction', 'participate_donation.idDonation', 'transaction.idDonation')
            // ->where('transaction.status', 1)
            ->get();
    }

    public function getABudgetingDonation($idEvent)
    {
        return DetailAllocation::where('idDonation', $idEvent)->get();
    }

    public function postDonate($participateDonation)
    {
        ParticipateDonation::where('idDonation', $participateDonation->getIdDonation())->create([
            'idDonation' => $participateDonation->getIdDonation(),
            'idParticipant' => $participateDonation->getIdParticipant(),
            'comment' => $participateDonation->getComment(),
            'created_at' => $participateDonation->getCreatedAt(),
            'annonymous_comment' => $participateDonation->getAnnonymous()
        ]);
    }

    public function postTransaction($transaction)
    {
        Transaction::where('idDonation', $transaction->getIdDonation())->create([
            'idDonation' => $transaction->getIdDonation(),
            'idParticipant' => $transaction->getIdParticipant(),
            'accountNumber' => $transaction->getAccountNumber(),
            'nominal' => $transaction->getNominal(),
            'annonymous_donate' => $transaction->getAnnonymous(),
            'status' => $transaction->getStatus(),
            'created_at' => $transaction->getCreatedAt()
        ]);
    }

    public function confirmationPictureDonation($file, $id)
    {
        Transaction::where('idDonation', $id)->update([
            'repaymentPicture' => $file
        ]);
    }

    public function getAUserTransaction($idUser, $idEvent)
    {
        return Transaction::where('idParticipant', $idUser)->where('idDonation', $idEvent)->first();
    }

    //! Mencari Donasi sesuai dengan 
    //! status event aktif dan keyword tertentu
    public function searchDonationByKeyword($status, $keyword)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mencari donasi sesuai dengan
    //! keyword dan kategori tertentu
    public function searchDonationCategory($status, $keyword, $category)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->where('category', $category)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mencari Donasi sesuai dengan
    //! keyword, sorting ascending, dan kategori tertentu
    public function searchDonationCategorySortAsc($status, $keyword, $category, $table)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->where('category', $category)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->orderBy($table)
            ->get();
    }

    //! Mencari Donasi sesuai dengan
    //! keyword, sorting sisa target donasi, dan kategori tertentu
    // public function searchDonationCategorySortTargetLeft($status, $keyword, $category, $table)
    // {
    //     return Donation::selectRaw('donation.*, users.name as name')
    //         ->where('donation.status', $status)
    //         ->where('donation.title', 'LIKE', '%' . $keyword . "%")
    //         ->where('category', $category)
    //         ->join('users', 'donation.idCampaigner', 'users.id')
    //         ->orderByAsc($table)
    //         ->get();
    // }

    //! Mencari donasi sesuai dengan
    //! keyword dan sorting asc tertentu
    public function searchDonationSortBy($status, $keyword, $table)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->orderBy($table)
            ->get();
    }

    //! Mencari donasi sesuai dengan
    //! keyword, kategori tertentu, dan donasi yang pernah dibuat campaigner
    public function searchDonationCategoryByMe($keyword, $category, $idCampaigner)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.category', $category)
            ->where('donation.idCampaigner', $idCampaigner)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mencari donasi sesuai dengan
    //! keyword, kategori tertentu, dan donasi yang pernah diikuti participant
    public function searchDonationCategoryParticipated($keyword, $category, $idParticipant)
    {
        return ParticipateDonation::selectRaw('donation.*, users.name as name, participate_donation.*')
            ->where('participate_donation.idParticipant', $idParticipant)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->where('donation.category', $category)
            ->join('donation', 'participate_donation.idDonation', '=', 'donation.id')
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mencari donasi sesuai dengan
    //! keyword, kategori tertentu, dan donasi yang pernah dibuat campaigner
    public function searchDonationByMe($keyword, $idCampaigner)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.idCampaigner', $idCampaigner)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mencari donasi sesuai dengan
    //! keyword, kategori tertentu, dan donasi yang pernah diikuti participant
    public function searchDonationParticipated($keyword, $idParticipant)
    {
        return ParticipateDonation::selectRaw('donation.*, users.name as name, participate_donation.*')
            ->where('participate_donation.idParticipant', $idParticipant)
            ->where('donation.title', 'LIKE', '%' . $keyword . "%")
            ->join('donation', 'participate_donation.idDonation', '=', 'donation.id')
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengurutkan donasi sesuai dengan
    //! sorting ascending dan kategori tertentu
    public function sortDonationCategory($category, $status, $table)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('donation.category', $category)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->orderBy($table)
            ->get();
    }

    //! Mengurutkan petisi dengan status tertentu 
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortDonation($status, $table)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->orderBy($table)
            ->get();
    }

    //! Menampilkan petisi dengan status tertentu sesuai kategori tertentu
    public function donationByCategory($category, $status)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.status', $status)
            ->where('category', $category)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengurutkan donasi yang pernah diikuti participant sesuai kategori tertentu
    public function sortDonationCategoryParticipated($category, $idParticipant)
    {
        return ParticipateDonation::selectRaw('donation.*, users.name as name, participate_donation.*')
            ->where('participate_donation.idParticipant', $idParticipant)
            ->where('donation.category', $category)
            ->join('donation', 'participate_donation.idDonation', '=', 'donation.id')
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengurutkan donasi yang pernah diikuti participant
    public function sortDonationParticipated($idParticipant)
    {
        return ParticipateDonation::selectRaw('donation.*, users.name as name, participate_donation.*')
            ->where('participate_donation.idParticipant', $idParticipant)
            ->join('donation', 'participate_donation.idDonation', '=', 'donation.id')
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengurutkan donasi yang pernah dibuat campaigner sesuai kategori tertentu
    public function sortDonationCategoryByCampaigner($category, $idCampaigner)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.category', $category)
            ->where('donation.idCampaigner', $idCampaigner)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    //! Mengurutkan donasi yang pernah dibuat oleh campaigner
    public function sortDonationByCampaigner($idCampaigner)
    {
        return Donation::selectRaw('donation.*, users.name as name')
            ->where('donation.idCampaigner', $idCampaigner)
            ->join('users', 'donation.idCampaigner', 'users.id')
            ->get();
    }

    public function storeDonationCreated($donation)
    {
        Donation::create([
            'category' => $donation->getCategory(),
            'deadline' => $donation->getDeadline(),
            'idCampaigner' => $donation->getIdCampaigner(),
            'photo' => $donation->getPhoto(),
            'purpose' => $donation->getPurpose(),
            'status' => $donation->getStatus(),
            'title' => $donation->getTitle(),
            'totalDonatur' => $donation->getTotalDonatur(),
            'assistedSubject' => $donation->getAssistedSubject(),
            'donationCollected' => $donation->getDonationCollected(),
            'donationTarget' => $donation->getDonationTarget(),
            'accountNumber' => $donation->getAccountNumber(),
            'bank' => $donation->getBank(),
            'created_at' => $donation->getCreatedAt()
        ]);
    }

    public function storeDetailAllocation($allocationDetail)
    {
        DetailAllocation::create([
            'idDonation' => $allocationDetail->getIdDonation(),
            'nominal' => $allocationDetail->getNominal(),
            'description' => $allocationDetail->getDescription()
        ]);
    }

    public function getLastIdDonation()
    {
        return Donation::orderBy('id', 'desc')->take(1)->first();
    }

    public function updateStatusEvent($id, $status)
    {
        Donation::where('id', $id)->update([
            'status' => $status
        ]);
    }
}
