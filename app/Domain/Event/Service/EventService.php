<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Dao\EventDao;
use App\Domain\Petition\Dao\PetitionDao;
use App\Domain\Donation\Dao\DonationDao;
use Carbon\Carbon;

class EventService
{
    private $event_dao;
    private $donation_dao;
    private $petition_dao;

    public function __construct()
    {
        $this->event_dao = new EventDao();
        $this->donation_dao = new DonationDao();
        $this->petition_dao = new PetitionDao();
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

    public function checkAnnonym($checked)
    {
        if ($checked == 'on') {
            return 1;
        }

        return 0;
    }

    public function checkValidDate($event, $typeEvent)
    {
        $time = Carbon::now('+7:00')->format("Y-m-d");

        if (strtotime($event->deadline) - strtotime($time) <= 0) {
            $this->event_dao->updateStatusEvent($event->id, FINISHED, $typeEvent);
        }
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
}
