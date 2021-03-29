<?php

namespace App\Domain\Event\Model;

class User
{
    // Attribute
    protected $id,
        $name,
        $email,
        $password,
        $dob;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    protected function getId()
    {
        return $this->id;
    }

    protected function getName()
    {
        return $this->name;
    }

    protected function getEmail()
    {
        return $this->email;
    }

    protected function getPassword()
    {
        return $this->password;
    }

    protected function getDob()
    {
        return $this->dob;
    }
}
