<?php
namespace Tests\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;


class PaginaRegistroNovoUsuario{

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
        $this->driver->get('http://127.0.0.1:8080/novo-usuario');
    }

    public function preencheNome(string $nome){
        $this->driver->findElement(WebDriverBy::id('name'))->sendKeys($nome);
        return $this;
    }

    public function preencheEmail(string $email){
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys($email);
        return $this;
    }

    public function preencheSenha(string $senha){
        $this->driver->findElement(WebDriverBy::id('password'))->sendKeys($senha);
        return $this;
    }

    public function enviaFormulario()
    {
        $this->driver->findElement(WebDriverBy::cssSelector('.btn.btn-primary.mt-3'))->click();

    }
}