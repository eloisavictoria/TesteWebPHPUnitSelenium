<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Tests\PageObject\PaginaListagemSeries;
use Tests\Singleton\ConexaoWebDriver;

class PaginalInicialTest extends TestCase{

    private static WebDriver $driver;
   

    public static function setUpBeforeClass():void
    {
        
        //arrenge: Dado que estou com o navegador aberto
        $host='http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host,DesiredCapabilities::opera()); //criando o webdriver. 
        //primeiro parametro: onde esta rodando o servidor do selenium
        //quais capacidades do navegador usando o navegador do opera (segundo parametro)
    }

    public function testQPaginaInicialNaoLogadaDeverSerListagemDeSeries()
    {
        
        //act: Quando acesso "http:localhost:8080"
        self::$driver->navigate()->to('http://127.0.0.1:8080/');

        //assert: Então vejo que o título da página contém a palavra "Séries"
        //self::assertStringContainsString('Séries', $driver->getPageSource());
        //$driver->getPageSource() - pega o codigo fonte da página, assim como existem outras formas
        //de pegar outras informações da página também

        //como não quero buscar na página inteira se tem a palavra séries, vou buscar pela tag onde contem essa informação
        //$h1Locator = WebDriverBy::tagName('h1'); //localizador de componentes dentro da página
        //$textoH1 = self::$driver->findElement($h1Locator)->getText();//pegando o conteúdo dentro do elemento
        $paginaListaSeries = new PaginaListagemSeries(self::$driver);
        
        self::assertStringContainsString('Séries', $paginaListaSeries->titulo());//verificando o conteúdo do texto
            
        
    
    }

    public static function tearDownAfterClass():void
    {
        self::$driver->close();
    }
}