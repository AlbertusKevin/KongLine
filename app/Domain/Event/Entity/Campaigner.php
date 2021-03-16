<?php

namespace App\Domain\Event\Entity;

class Campaigner extends User
{
    private $ktpPicture, $nik, $accountNumber;
    protected $fillable = [
        'ktpPicture',
        'nik',
        'accountNumber',
    ];
    public $timestamps = false;
    protected $table = 'users';
}
