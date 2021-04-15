<?php

namespace App\Domain\Event\Model;

class Admin extends User
{
    private $accountNumber;

    public function __construct($name, $email, $password, $accountNumber)
    {
        parent::__construct($name, $email, $password);
        $this->accountNumber = $accountNumber;
    }

    public function getId()
    {
        return parent::getId();
    }

    public function getName()
    {
        return parent::getName();
    }

    public function getEmail()
    {
        return parent::getEmail();
    }

    public function getPassword()
    {
        return parent::getPassword();
    }

    public function getDob()
    {
        return parent::getDob();
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
}
