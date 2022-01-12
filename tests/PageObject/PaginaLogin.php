<?php
namespace Tests\PageObject;


use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class PaginaLogin{

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function realizaLoginCom(string $email, string $senha):void
    {
        $this->driver->get('http://127.0.0.1:8080/entrar');
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys($email); //sem verificação se o email existe no banco de dados
        $this->driver->findElement(WebDriverBy::id('password'))->sendKeys($senha)->submit();
    }

    
}