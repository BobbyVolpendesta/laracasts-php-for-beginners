<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 3;

$heading = 'Note';

$id = $_GET['id'];

$note = $db->query('select * from notes where id = :id', [
    'id' =>  $_GET['id']
])->findOrFail();

authorize((string)$note['user_id'] === (string)$currentUserId);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);