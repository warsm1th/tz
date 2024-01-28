<?php

class Validator
{
    private string $name;
    private string $email;
    private string $phone;
    private string $errors = "";

    function __construct($arr)
    {
        $this->name = $arr['name'];
        $this->email = (string)$arr['email'];
        $this->phone = $arr['phone'];
        $this->validateName();
        $this->validateEmail();
        $this->validatePhone();
    }

    function validateName()
    {
        if ($this->name == ""){
            $this->errors .= "Укажите имя!<br>";
        }

        elseif (strlen($this->name) < 2){
            $this->errors .= "Имя должно включать не менее 2-х символов!<br>";	
        }
    }

    function validateEmail()
    {   
        $value = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        if ($value == ""){
            $this->errors .= "Email не введен!<br>";
        }

        elseif (!(filter_var($value, FILTER_VALIDATE_EMAIL))){
            $this->errors .= "Некорректный email!<br>";
        }
    }
    
    function validatePhone()
    {
        if ($this->phone == ""){
            $this->errors .= "Номер не введен!<br>";
        }

        elseif (strlen($this->phone) < 11){
            $this->errors .= "Телефон должен включать не менее 11-ти цифр!<br>";
        }
    }

    function getErrors(){
        return $this->errors;
    }

}