<?php

namespace App\Domain\Admin\Dao;

use App\Domain\Event\Entity\Donation;
use App\Domain\Event\Entity\User;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;
use App\Domain\Event\Entity\Petition;

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

    public function acceptPetition($id)
    {
        Petition::where('id', $id)->update(['status' => ACTIVE]);
    }

    public function rejectPetition($id)
    {
        Petition::where('id', $id)->update(['status' => REJECTED]);
    }

    public function closePetition($id)
    {
        Petition::where('id', $id)->update(['status' => CLOSED]);
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
}
