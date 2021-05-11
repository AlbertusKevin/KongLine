<?php

namespace App\Domain\Helper;

use Illuminate\Support\Facades\Auth;
use App\Domain\Event\Entity\Category;
use App\Domain\Event\Entity\ParticipatePetition;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Domain\Event\Entity\User;
use App\Domain\Profile\Dao\ProfileDao;
use Illuminate\Support\Str;

class HelperService
{
    // upload gambar
    public static function uploadImage($img, $folder)
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

    // Untuk navbar, perbedaan untuk Admin dan Pengguna (guest, campaigner, participant)
    public static function getNavbar()
    {
        if (Auth::check()) {
            if (Auth::user()->role != ADMIN) {
                return 'layout.app';
            }
        } else {
            return 'layout.app';
        }

        return 'layout.adminNavbar';
    }

    // Memberi pesan terkait status event tertentu
    public static function messageOfEvent($status)
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

    public static function getACategory($id)
    {
        return Category::where('id', $id)->first();
    }

    //! Mengambil data seluruh kategori event petisi atau donasi yang ada
    public static function getAllCategoriesEvent()
    {
        return Category::all();
    }

    //! Mengembalikan kategori event petisi atau donasi yang dipilih
    public static function categorySelect($request)
    {
        $listCategory = Category::all();

        foreach ($listCategory as $cat) {
            if ($request->category == $cat->description) {
                return $cat->id;
            }
        }
        return 0;
    }
}
