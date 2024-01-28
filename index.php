<?php
require_once 'db.php';
require_once 'validation.php';

$db = new Database;

$conn = $db->getConnection();


$validation = new Validator($_POST);
if ($validation->getErrors() == ""){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email OR phone = :phone');

    $stmt->execute(['email'=>$email, 'phone'=>$phone]);

    if ($row = $stmt->fetch(PDO::FETCH_LAZY)){
        echo "<p style='color: red'>Пользователь с этими данными уже существует!</p>";
    }
    else {
        $reg = $conn->prepare('INSERT INTO users VALUES (NULL, :name, :email, :phone)');
        $reg->execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone]);
        echo "<p style='color: green'>Регистрация успешно завершена!</p>";
    }
}
else{
    echo "<p style='color: red'>{$validation->getErrors()}</p>";
}