<?php

namespace App\Domain\Admin\Dao;

use App\Domain\Event\Entity\Donation;
use App\Domain\Event\Entity\User;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;
use App\Domain\Event\Entity\Petition;
use App\Domain\Event\Entity\Transaction;

class AdminDao
{
    public function getAllUser()
    {
        return User::all();
    }

    public function getCountParticipant()
    {
        return User::where('role', 'participant')->count();
    }

    public function getCountCampaigner()
    {
        return User::where('role', 'campaigner')->count();
    }

    public function getCountWaitingCampaigner()
    {
        return User::where('status', 3)->count();
    }

    public function getCountWaitingDonation()
    {
        return Donation::where('status', 0)->count();
    }

    public function getCountWaitingPetition()
    {
        return Petition::where('status', 0)->count();
    }

    public function getCountParticipatePetition($id)
    {
        return ParticipatePetition::where('idParticipant', $id)->count();
    }

    public function getCountParticipateDonation($id)
    {
        return ParticipateDonation::where('idParticipant', $id)->count();
    }

    public function listUserByRole($role)
    {
        return User::where('role', $role)->get();
    }

    public function listUserByAll()
    {
        return User::where('role', '!=', 'admin')
            ->orWhereNull('role')
            ->get();
    }

    public function listUserByPengajuan()
    {
        return User::where('status', '==', 3)->get();
    }

    public function getListDonationLimit()
    {
        return Donation::all()->sortByDesc("created_at")->take(3);
    }

    public function getListPetitionLimit()
    {
        return Petition::all()->sortByDesc("created_at")->take(3);
    }

    public function allPetition()
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->get();
    }

    //
    //
    //
    public function allDonation()
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    public function selectDonation($status)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    //! Mengurutkan petisi sesuai dengan
    //! sorting desc dan kategori tertentu
    public function sortDonationCategory($category, $status, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('category', $category)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    //! Mengurutkan petisi dengan status tertentu
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortDonation($status, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi dengan status tertentu sesuai kategori tertentu
    public function donationByCategory($category, $status)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('category', $category)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    public function allStatusSortDonationCategory($category, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function allStatusSortDonation($table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function allStatusDonationByCategory($category)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    public function searchAllStatusDonation($keyword)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    public function searchAllDonationSortBy($keyword, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function searchAllDonationCategory($keyword, $category)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    public function searchAllDonationCategorySort($keyword, $category, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function searchDonation($status, $keyword)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchDonationCategorySort($status, $keyword, $category, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan kategori tertentu
    public function searchDonationCategory($status, $keyword, $category)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchDonationSortBy($status, $keyword, $table)
    {
        return Donation::selectRaw('donation.*, category.description as category, event_status.description as status')
            ->where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->join('category', 'donation.category', 'category.id')
            ->join('event_status', 'donation.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function changeEventStatus($id, $status, $event)
    {
        if ($event == DONATION) {
            Donation::where('id', $id)->update(['status' => $status]);
        }

        Petition::where('id', $id)->update(['status' => $status]);
    }

    public function getAllNotConfirmedTransaction()
    {
        return Transaction::selectRaw('transaction.created_at, donation.title, users.name, transaction.nominal')
            ->join('participate_donation', 'participate_donation.idDonation', 'transaction.idDonation')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->join('donation', 'donation.id', 'participate_donation.idDonation')
            ->get();

        // return Transaction::all();
    }
}
