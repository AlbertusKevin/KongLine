<?php

namespace App\Domain\Controlling\Dao;

use App\Domain\Donation\Entity\Donation;
use App\Domain\Petition\Entity\Petition;
use App\Domain\Profile\Entity\User;

use App\Domain\Donation\Entity\ParticipateDonation;
use App\Domain\Petition\Entity\ParticipatePetition;
use App\Domain\Donation\Entity\Transaction;
use Illuminate\Support\Facades\Mail;

class ControllingDao
{
    public function getAllUser()
    {
        return User::where("id", "!=", GUEST_ID)->where("role", "!=", ADMIN)->get();
    }

    public function getUserById($id)
    {
        return User::find($id);
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

    public function getCountWaitingTransaction()
    {
        return Transaction::where('status', NOT_CONFIRMED_TRANSACTION)->count();
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

    public function getUsersByRole($role)
    {
        return User::where('role', $role)->where('role', '!=', GUEST)->get();
    }

    public function listUserByAll()
    {
        return User::where('role', '!=', ADMIN)
            ->where('role', "!=", GUEST)
            ->orWhereNull('role')
            ->get();
    }

    public function listUserByPengajuan()
    {
        return User::where('status', 3)->get();
    }

    public function sortByTanggalDibuat($role)
    {
        return User::where('role', $role)
            ->where('role', '!=', GUEST)
            ->orderBy('created_at', 'asc')->get();
    }

    public function sortByNama($role)
    {
        return User::where('role', $role)
            ->where('role', '!=', GUEST)
            ->orderBy('name', 'asc')->get();
    }

    public function sortByEmail($role)
    {
        return User::where('role', $role)
            ->where('role', '!=', GUEST)
            ->orderBy('email', 'asc')->get();
    }

    public function sortByTanggalDibuatAllUser()
    {
        return User::where('role', '!=', GUEST)->orderBy('created_at', 'asc')->get();
    }

    public function sortByNamaAllUser()
    {
        return User::where('role', '!=', GUEST)->orderBy('name', 'asc')->get();
    }

    public function sortByEmailAllUser()
    {
        return User::where('role', '!=', GUEST)
            ->orderBy('email', 'asc')->get();
    }

    public function getListDonationLimit()
    {
        return Donation::all()->sortByDesc("created_at")->take(3);
    }

    public function getListPetitionLimit()
    {
        return Petition::all()->sortByDesc("created_at")->take(3);
    }

    //
    //
    //


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

    public function acceptDonation($id, $data)
    {
        Donation::where('id', $id)->update([
            'updated_at' => $data['updated_at'],
            'deadline' => $data['deadline']
        ]);
    }

    public function changeReason($id, $event, $reason)
    {
        if ($event == DONATION) {
            Donation::where('id', $id)->update(['reason' => $reason]);
        } elseif ($event == PETITION) {
            Petition::where('id', $id)->update(['reason' => $reason]);
        } else {
            Transaction::where('id', $id)->update(['reason' => $reason]);
        }
    }



    public function getAllTransaction()
    {
        return Transaction::selectRaw('transaction.id, transaction.idParticipant, transaction.created_at, donation.title, users.name, transaction.nominal, transaction.status')
            ->join('participate_donation', function ($join) {
                $join->on('participate_donation.idParticipant', '=', 'transaction.idParticipant')
                    ->on('transaction.idDonation', '=', 'participate_donation.idDonation');
            })
            ->join('donation', 'donation.id', 'participate_donation.idDonation')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->get();
        // SELECT * FROM `transaction`
        // JOIN `participate_donation` on transaction.idParticipant = participate_donation.idParticipant
        // JOIN `donation` on donation.id = participate_donation.idDonation
        // JOIN `users` on participate_donation.idParticipant = users.id
        // WHERE transaction.idParticipant = participate_donation.idParticipant AND transaction.idDonation = participate_donation.idDonation
    }

    public function selectTransaction($status)
    {
        return Transaction::selectRaw('transaction.id, transaction.idParticipant, transaction.created_at, donation.title, users.name, transaction.nominal, transaction.status')
            ->where('transaction.status', $status)
            ->join('participate_donation', function ($join) {
                $join->on('participate_donation.idParticipant', '=', 'transaction.idParticipant')
                    ->on('transaction.idDonation', '=', 'participate_donation.idDonation');
            })
            ->join('donation', 'donation.id', 'participate_donation.idDonation')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->get();
    }

    public function searchTransactionByDonationTitle($keyword)
    {
        return Transaction::selectRaw('transaction.id, transaction.idParticipant, transaction.created_at, donation.title, users.name, transaction.nominal, transaction.status')
            ->where('donation.title', 'LIKE', "%" . $keyword . '%')
            ->join('participate_donation', function ($join) {
                $join->on('participate_donation.idParticipant', '=', 'transaction.idParticipant')
                    ->on('transaction.idDonation', '=', 'participate_donation.idDonation');
            })
            ->join('donation', 'donation.id', 'participate_donation.idDonation')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->get();
    }

    public function searchTransactionWithStatusByDonationTitle($status, $keyword)
    {
        return Transaction::selectRaw('transaction.id, transaction.idParticipant, transaction.created_at, donation.title, users.name, transaction.nominal, transaction.status')
            ->where('transaction.status', $status)
            ->where('donation.title', 'LIKE', "%" . $keyword . '%')
            ->join('participate_donation', function ($join) {
                $join->on('participate_donation.idParticipant', '=', 'transaction.idParticipant')
                    ->on('transaction.idDonation', '=', 'participate_donation.idDonation');
            })
            ->join('donation', 'donation.id', 'participate_donation.idDonation')
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->get();
    }

    public function getAUserTransaction($id)
    {
        return Transaction::selectRaw('transaction.*, users.name')
            ->where('transaction.id', $id)
            ->join('participate_donation', function ($join) {
                $join->on('participate_donation.idParticipant', 'transaction.idParticipant')
                    ->on('participate_donation.idDonation', 'transaction.idDonation');
            })
            ->join('users', 'participate_donation.idParticipant', 'users.id')
            ->first();
    }
    public function countDonatur($idDonation)
    {
        return Transaction::where('idDonation', $idDonation)
            ->where("status", CONFIRMED_TRANSACTION)
            ->count();
    }

    public function updateTotalDonatur($idDonation, $totalDonatur)
    {
        Donation::where('id', $idDonation)->update([
            'totalDonatur' => $totalDonatur
        ]);
    }
    public function getDonationCollected($idDonation)
    {
        return Donation::find($idDonation);
    }

    public function  updateDonationCollected($idDonation, $total)
    {
        Donation::where('id', $idDonation)->update([
            'donationCollected' => $total
        ]);
    }

    public function updateStatusTransaction($id, $status)
    {
        Transaction::where('id', $id)->update([
            'status' => $status
        ]);
    }

    //Mencari User sesuai keyword untuk tab SEMUA
    public function searchUserAll($keyword)
    {
        return User::where('name', 'LIKE', '%' . $keyword . '%')->where('role', '!=', GUEST)->get();
    }

    //Mencari User sesuai keyword untuk tab PARTICIPANT
    public function searchUserParticipant($keyword)
    {
        return User::where('role', '=', 'participant')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //Mencari User sesuai keyword untuk tab CAMPAIGNER
    public function searchUserCampaigner($keyword)
    {
        return User::where('role', '=', 'campaigner')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //Mencari User sesuai keyword untuk tab PENGAJUAN
    public function searchUserPengajuan($keyword)
    {
        return User::where('status', '=', 3)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    /*fungsi yang akan mengupdate kolom countEvent pada tabel users 
    dengan jumlah partisipasi user di table participate_donation 
    dan participate_petition*/
    public function updateUserCountEvent($userId, $total)
    {
        $user = User::where('id', '=', $userId)->first();
        $user->countEvent = $total;
        $user->save();
    }

    //Akan mengambil user berdasarkan id, untuk user profile
    public function getUserInfo($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    //akan mengambil data event donasi yang user ikut serta sebagai perticipant
    public function getUserParticipateDonation($id)
    {
        $donations = Donation::join('participate_donation', 'donation.id', 'participate_donation.idDonation')
            ->join('users', 'users.id', 'donation.idCampaigner')
            ->join('category', 'category.id', 'donation.category')
            ->where('participate_donation.idParticipant', $id)
            ->select('donation.id', 'category.description', 'donation.photo', 'donation.title', 'users.name')
            ->get();

        return $donations;
    }

    public function getUserParticipatePetition($id)
    {
        $petitions = Petition::join('participate_petition', 'petition.id', 'participate_petition.idPetition')
            ->join('users', 'users.id', 'petition.idCampaigner')
            ->join('category', 'category.id', 'petition.category')
            ->where('participate_petition.idParticipant', $id)
            ->select('petition.id', 'category.description', 'petition.photo', 'petition.title', 'users.name')
            ->get();

        return $petitions;
    }

    public function sendEmail($event, $view, $subject, $event_chosen)
    {
        Mail::send($view, ['event' => $event, 'event_chosen' => $event_chosen], function ($message) use ($event, $subject) {
            $message->to($event->users->email);
            $message->subject($subject);
        });
    }


    public function sendEmailUser($user, $view, $subject)
    {
        Mail::send($view, ['user' => $user], function ($message) use ($user, $subject) {
            $message->to($user->email);
            $message->subject($subject);
        });
    }

    public function getPetitionById($id)
    {
        return Petition::find($id);
    }

    public function countDonationMade($id)
    {
        return Donation::where('idCampaigner', $id)->count();
    }

    public function countPetitionMade($id)
    {
        return Petition::where('idCampaigner', $id)->count();
    }

    public function getUserMadeDonation($id)
    {
        $donations = Donation::join('users', 'users.id', 'donation.idCampaigner')
            ->join('category', 'category.id', 'donation.category')
            ->where('donation.idCampaigner', $id)
            ->select('donation.id', 'category.description', 'donation.photo', 'donation.title', 'users.name')
            ->get();
        return $donations;
    }

    public function getUserMadePetition($id)
    {
        $petitions = Petition::join('users', 'users.id', 'petition.idCampaigner')
            ->join('category', 'category.id', 'petition.category')
            ->where('petition.idCampaigner', $id)
            ->select('petition.id', 'category.description', 'petition.photo', 'petition.title', 'users.name')
            ->get();

        return $petitions;
    }

    public function acceptUserToCampaigner($id, $status, $role)
    {
        $user = User::where('id', $id)->first();

        $user->status = $status;
        $user->role = $role;

        $user->save();
    }

    public function rejectUserToCampaigner($id, $status, $role)
    {
        $user = User::find($id);

        $user->status = $status;
        $user->role = $role;

        $user->save();
    }

    public function getDonationById($id)
    {
        return Donation::find($id);
    }

    public function sortByCountEventAll()
    {
        return User::where('id', '!=', GUEST_ID)->orderBy('countEvent', 'desc')->get();
    }

    public function sortByCountEvent($role)
    {
        return User::where('role', $role)
            ->orderBy('countEvent', 'desc')->get();
    }

    public function getTransactionById($id)
    {
        return Transaction::find($id);
    }

    public function sendEmailTrx($trx, $view, $subject)
    {
        Mail::send($view, ['transaction' => $trx], function ($message) use ($trx, $subject) {
            $message->to($trx->donations->users->email);
            $message->subject($subject);
        });
    }
}
