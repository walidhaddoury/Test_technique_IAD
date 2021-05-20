<?php

class Contact
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $adress;
    public $phoneNumber;
    public $age;
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            if (property_exists('Contact', $key)) {
                $this->$key = $value;
            }
        }
    }
}
