<?php
namespace Tests\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

class PaginaListagemSeries{

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function visita():self {
        $this->driver->get('http://127.0.0.1:8080/series');
        return $this;
    }

    public function titulo(): string
    {
        return $this->driver->findElement(WebDriverBy::tagName('h1'))->getText();
    }

    public function clicaEmAlterarSerieComId(int $idSeriado)
    {
        $elementoLista = $this->driver->findElement(WebDriverBy::cssSelector("li[data-serie-id='$idSeriado']"));
        $elementoLista->findElement(WebDriverBy::cssSelector("button.btn-info"))->click();
        return $this;

    }

    public function defineNomeDaSerieComId(int $idSeriado , string $nomeAlterado)
    {
        //busco o elemento da lista
        $elementoLista = $this->driver->findElement(WebDriverBy::cssSelector("li[data-serie-id='$idSeriado']"));
        //pego o conteudo que ficou 
        $elementoLista->findElement(WebDriverBy::cssSelector("#input-nome-serie-$idSeriado input"))
        ->clear()
        ->sendKeys($nomeAlterado);

        return $this;
    }

    public function finalizaEdicaoDaSerieComId(int $idSeriado) : void
    {
        $elementoLista = $this->driver->findElement(WebDriverBy::cssSelector("li[data-serie-id='$idSeriado']"));
        //pego o botão da lista
        $elementoLista->findElement(WebDriverBy::cssSelector("#input-nome-serie-$idSeriado button"))
        ->click();
    }

    public function nomeSerie(int $idSeriado):string
    {
      $nomeSeriado = WebDriverBy::id("nome-serie-$idSeriado");
      $elementoNomeSeriado = $this->driver->findElement($nomeSeriado);

      //vai esperar até que o elemento do nome do seriado esteja na tela 
      $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOf($elementoNomeSeriado));

      return $elementoNomeSeriado->getText();

    }
}
