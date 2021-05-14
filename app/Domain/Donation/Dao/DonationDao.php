<?php

namespace App\Domain\Donation\Dao;

use App\Domain\Donation\Entity\Bank;
use App\Domain\Donation\Entity\DetailAllocation;
use App\Domain\Donation\Entity\Donation;
use App\Domain\Donation\Entity\ParticipateDonation;
use App\Domain\Donation\Entity\Transaction;

class DonationDao
{

    //! Mengambil nama bank yang bisa digunakan untuk transfer
    public function listBank()
    {
        return Bank::all();
    }

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

    public function getDetailAllocation($id)
    {
        return DetailAllocation::where('idDonation', $id)->get();
    }

    public function getParticipatedDonation($idEvent)
    {
        return ParticipateDonation::selectRaw('participate_donation.*,transaction.*, users.name as name, users.photoProfile as photoProfile')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->join('transaction', function ($join) {
                $join->on('transaction.idParticipant', 'participate_donation.idParticipant')
                    ->on('transaction.idDonation', 'participate_donation.idDonation');
            })
            ->where('participate_donation.idDonation', $idEvent)
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
            'status' => NOT_CONFIRMED_TRANSACTION,
            'repaymentPicture' => $file
        ]);
    }

    public function changeStatusTransactionDonation($id)
    {
        Transaction::where('idDonation', $id)->update([
            'status' => NOT_CONFIRMED_TRANSACTION
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

    public function updateEventDonation($donation, $id)
    {
        Donation::where('id', $id)->update([
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

    public function deleteAllocationDetail($id)
    {
        DetailAllocation::where('idDonation', $id)->delete();
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
