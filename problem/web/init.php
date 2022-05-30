<?php

try {
    $pdo = new PDO('mysql:host=dbtest;charset=utf8;dbname=blogger', 'root', 'root');
} catch (PDOException $e) {
    echo "Une erreur c'est produite";
    http_response_code(500);
    exit(1);
}
