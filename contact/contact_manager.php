<?php

class ContactManager
{

    private $_db;

    function __construct($db)
    { // initialise la BDD
        $this->setDb($db);
    }

    function setDb(PDO $db)
    { // Initialise dans la class
        $this->_db = $db;
    }


    // 
    public function getAllContact()
    {
        $query = $this->_db->prepare('SELECT * FROM contact');
        $query->execute(); // la requete est executee
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($data === false) {
            return false;
        }
        return $data;
    }

    // fonction contact by email
    public function getContactByEmail($email)
    {
        $query = $this->_db->prepare('SELECT * FROM contact WHERE email = :email'); // Get les mails de tous les utilisateurs 
        $query->bindValue(':email', $email); // on remplace :email par le contenu de $email
        $query->execute(); // la requete est executee
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        // print_r($data[0]);
        if ($data === false) {
            return false;
        }
        $contact = new Contact(); // Creer une nouvelle instance de la Class Account
        $contact->hydrate($data[0]); // Injecte les infos dans la nouvelle instance
        return $contact;
    }

    // fonction add
    public function add($contactToAdd)
    {
        $query = $this->_db->prepare('INSERT INTO contact (firstName, lastName, email, adress, phoneNumber, age) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([
            $contactToAdd->firstName,
            $contactToAdd->lastName,
            $contactToAdd->email,
            $contactToAdd->adress,
            $contactToAdd->phoneNumber,
            $contactToAdd->age
        ]); // la requete est executee

    }

    // fonction delete
    public function delete($id)
    {
        $query = $this->_db->prepare('DELETE FROM contact WHERE id = :id');
        $query->bindValue(':id', $id); // on remplace :id par l'id de l'utilisateur
        $query->execute(); // la requete est executee
    }

    // fonction update
    public function updateContact($contact)
    {
        $query = $this->_db->prepare('UPDATE contact SET firstName = :firstName, lastName = :lastName, email = :email, adress = :adress, phoneNumber = :phoneNumber, age = :age WHERE id = :id');
        $query->bindValue(':id', $contact->id);
        $query->bindValue(':firstName', $contact->firstName);
        $query->bindValue(':lastName', $contact->lastName);
        $query->bindValue(':email', $contact->email);
        $query->bindValue(':adress', $contact->adress);
        $query->bindValue(':phoneNumber', $contact->phoneNumber);
        $query->bindValue(':age', $contact->age);
        $query->execute(); // la requete est executee
    }
}
