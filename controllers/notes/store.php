<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';        
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'create note',
        'errors' => $errors
    ]);}

$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 3
]);

// Redirect after successful submission to reset the form
header("Location: /notes");
die();

// validation issue