<?php

class Database
{
    // данные для подключения к БД
    private $username = "bebeg";
    private $password = "Memefrog_6277";
    private $attr = "mysql:host=localhost;dbname=dbase1";
    public $conn;

    // получение соединения с базой данных
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO($this->attr, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}