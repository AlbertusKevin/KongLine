<?php

namespace App\Domain\Event\Service;

use App\Domain\Profile\Entity\User;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Event\Dao\EventDao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EventService
{
    private $profile_service;
    private $event_dao;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
        $this->event_dao = new EventDao();
    }

    //! Mengecek verifikasi data diri yang diberikan sebelum membuat event
    public function verifyProfileCreateEvent($email, $phone)
    {
        $campaigner = $this->event_dao->verifyProfileCreateEvent($email, $phone);

        if (empty($campaigner)) {
            return false;
        }

        return true;
    }

    public function getAllCategoriesEvent()
    {
        return $this->event_dao->getAllCategoriesEvent();
    }

    public function getACategory($id)
    {
        return $this->event_dao->getACategory($id);
    }

    //! Mengembalikan kategori event petisi atau donasi yang dipilih
    public function categorySelect($request)
    {
        $listCategory = $this->event_dao->getAllCategoriesEvent();

        foreach ($listCategory as $cat) {
            if ($request->category == $cat->description) {
                return $cat->id;
            }
        }
        return 0;
    }

    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        $participated = $this->event_dao->checkParticipated($idEvent, $idParticipant, $typeEvent);

        if (empty($participated)) {
            return false;
        }

        return true;
    }

    // Memberi pesan terkait status event tertentu
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
        } else if ($status == REJECTED) {
            return [
                'header' => 'Ditolak',
                'content' => 'Pengajuan untuk menyelenggarakan event ini ditolak. Silahkan cek email untuk pesan.'
            ];
        }

        return [
            'header' => 'Dibatalkan',
            'content' => 'Event ini dibatalkan oleh penyelenggara.'
        ];
    }

    public function checkAnnonym($checked)
    {
        if ($checked == 'on') {
            return 1;
        }

        return 0;
    }
}
