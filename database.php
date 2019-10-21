<?php
$pdo = new PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'removed', 'removed',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);