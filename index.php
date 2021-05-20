<?php
// import du fichier qui appel la BDD MySQL
require_once('db.php');

require_once('contact/data_contact.php');

// import de contactManager qui gere toutes les actions lié au contact
require_once('contact/contact_manager.php');

// Import d'une nouvelle instant de contact
$ContactManager = new ContactManager($db);


$body = file_get_contents('php://input');
$object = json_decode($body);

// createContact
// $ContactManager->add($object);

// get all contact
// $result = $ContactManager->getAllContact();
// print_r($result);

// get contact by email
$result = $ContactManager->getContactByEmail($body);
print_r($result);

// delete contact by id
// $ContactManager->delete($body);

//update contact
// $result = $ContactManager->updateContact($object);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST IAD</title>
</head>

<body>
    <h1>TEST DE LA PAGE HTML</h1>
</body>

</html>