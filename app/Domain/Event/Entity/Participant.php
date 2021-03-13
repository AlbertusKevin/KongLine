<?php

namespace App\Domain\Event\Entity;

class Participant extends User
{
    // Attribute
    private $status,
        $role,
        $phoneNumber,
        $photoProfile,
        $backgroundPicture,
        $linkProfile,
        $aboutMe,
        $address,
        $city,
        $country,
        $zipCode,
        $job,
        $gender,
        $is_online;

    //relasi
    public function message()
    {
        return $this->hasMany("\App\Domain\Communication\Entity\Service");
    }

    //konfigurasi ORM
    protected $fillable = [
        'status',
        'role',
        'photoProfile',
    ];

    public $timestamps = false;
    protected $table = 'users';
}
