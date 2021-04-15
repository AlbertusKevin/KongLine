<?php

namespace App\Domain\Event\Model;

class Participant extends User
{
    //attribute
    private $aboutMe, $address, $backgroundPicture, $city, $countEvent, $country, $gender, $is_online, $job, $linkProfile, $phoneNumber, $photoProfile, $status, $zipCode;

    public function __construct($name, $email, $password)
    {
        parent::__construct($name, $email, $password);
    }
}
