<?php

require_once 'db.php';
require_once 'validation.php';

class Model
{
    private $result;
    function __construct($arr)
    {
        $validation = new Validator($arr);
        if ($validation->getErrors() == ""){
            $name = $arr['name'];
            $email = $arr['email'];
            $phone = $arr['phone'];

            $db = new Database;
            $conn = $db->getConnection();

            $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email OR phone = :phone');
    
            $stmt->execute(['email'=>$email, 'phone'=>$phone]);
    
            if ($row = $stmt->fetch(PDO::FETCH_LAZY)){
                if ($row['name'] == $name && $row['email'] == $email && $row['phone'] == $phone){
                    header("HTTP/1.1 200 OK");
                    $this->result = "<p style='color: red'>Данный пользователь уже существует!</p>";
                }
                
                elseif ($row['email'] == $email || $row['phone'] == $phone){
                    header("HTTP/1.1 203 OK");
                    $this->result = "<p style='color: red'>Данный email/телефон уже зарегистрирован в системе!</p>";
                }
            }
            else {
                $reg = $conn->prepare('INSERT INTO users VALUES (NULL, :name, :email, :phone)');
                $reg->execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone]);
                header("HTTP/1.1 201 OK");
                $this->result = "<p style='color: green'>Регистрация успешно завершена!</p>";
                }
            }
        else {
            header("HTTP/1.1 203 OK");
            $this->result = "<p style='color: red'>{$validation->getErrors()}</p>";
        }
    }

    public function getInfo(){
        echo $this->result;
    }
}