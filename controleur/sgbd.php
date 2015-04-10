<?php

// Connexion à la base de données
try
{
    //$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $bdd = new SQLite3('/app/www/db/database.db');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
