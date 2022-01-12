<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriver;
use Tests\PageObject\PaginaListagemSeries;
use Tests\PageObject\PaginaLogin;

class PaginaListagemTest extends TestCase{

    private WebDriver $driver;

    public function setUp()
    {
        //Arrenge
        //Dado que com o navegador aberto
        $host='http://localhost:4444/wd/hub';
        $this->driver = RemoteWebDriver::create($host,DesiredCapabilities::opera());
    }

    public function testAlterarNomeDeSerie()
    {
        

        //E estou logado no sistema
        $paginaLogin = new PaginaLogin($this->driver);
        $paginaLogin->realizaLoginCom('eloisa@email.com', '123');

        //E estou em "http://127.0.0.1:8080/series"
        $paginaListagem = new PaginaListagemSeries($this->driver);
        $paginaListagem->visita();

        //Act
        $idSeriado = 2;
        $nomeAlterado='Serie com novo nome';

        //Quando clico em "Alterar"  
        $paginaListagem->clicaEmAlterarSerieComId($idSeriado)
        //E altero a serie para o novo nome
        ->defineNomeDaSerieComId($idSeriado, $nomeAlterado)
        //E clico em "Salvar"
        ->finalizaEdicaoDaSerieComId($idSeriado);
        //Assert
        self::assertSame('Serie com novo nome', $paginaListagem->nomeSerie(2));
    }

    public function tearDown()
    {
        $this->driver->close();
    }
}