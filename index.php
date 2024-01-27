<?php

require_once 'db.php';

$db = new Database;

$conn = $db->getConnection();

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email OR phone = :phone');

    $stmt->execute(['email'=>$email, 'phone'=>$phone]);

    if ($row = $stmt->fetch(PDO::FETCH_LAZY)){
        echo 'Пользователь с этими данными уже существует!';
    }
    else {
        $reg = $conn->prepare('INSERT INTO users VALUES (NULL, :name, :email, :phone)');
        $reg->execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone]);
        echo 'Регистрация успешно завершена!';
    }
    
}