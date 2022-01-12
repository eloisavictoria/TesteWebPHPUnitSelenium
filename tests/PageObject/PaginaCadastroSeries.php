<?php
namespace Tests\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;

class PaginaCadastroSeries {

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
        $this->driver->get('http://127.0.0.1:8080/adicionar-serie');
    }

    public function preencheNome(string $nome)
    {
        $this->driver->findElement(WebDriverBy::id('nome'))->sendKeys($nome);
        return $this;
    }

    public function selecionaGenero(string $genero)
    {
        $selectGenero = new WebDriverSelect($this->driver->findElement(WebDriverBy::id('genre')));
        $selectGenero->selectByValue($genero);

        return $this;
    }

    public function comTemporadas(string $qtdTemporadas)
    {
        $this->driver->findElement(WebDriverBy::id('qtd_temporadas'))->sendKeys($qtdTemporadas);

        return $this;
    }

    public function comEpisodios(string $episodios)
    {
       $this->driver->findElement(WebDriverBy::id('ep_por_temporada'))->sendKeys($episodios);

        return $this;
    }

    public function enviaFormulario()
    {
        $this->driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();
    }
}