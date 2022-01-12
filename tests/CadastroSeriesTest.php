<?php


use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Tests\PageObject\PaginaLogin;
use Tests\PageObject\PaginaCadastroSeries;
use Facebook\WebDriver\WebDriverBy;
use Tests\Singleton\ConexaoWebDriver;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class CadastroSeriesTest extends TestCase{

    private static WebDriver $driver;

    public static function setUpBeforeClass():void
    {
       
         //Arrenge:Dado que estou com o navegador aberto  E estou em "http://127.0.0.1:8080/series"
         $host='http://localhost:4444/wd/hub';
         self::$driver = RemoteWebDriver::create($host,DesiredCapabilities::opera());
         self::$driver->get('http://127.0.0.1:8080/adicionar-serie');
         
 
         //E estou logado no sistema
        // self::$driver->findElement(WebDriverBy::id('email'))->sendKeys('eloisa@email.com'); //sem verificação se o email existe no banco de dados
         //self::$driver->findElement(WebDriverBy::id('password'))->sendKeys('123')->submit();
 
         $paginaLogin = new PaginaLogin(self::$driver);
         $paginaLogin->realizaLoginCom('eloisa@email.com', '123');

    }
    //vai executar sempre que tiver que executar um método dessa classe
   /* protected function setUp():void
    {
        
        self::$driver->get('http://127.0.0.1:8080/adicionar-serie');

    }
*/
    public function testCadastrarNovaSerieDeveRedirecionarParaLista()
    {
       

        //Act: Quando clico em "Adicionar" E preencho o formulário com os dados da série E clico em "Salvar"
        //$inputNome = self::$driver->findElement(WebDriverBy::id('nome'));
        //$inputGenero = self::$driver->findElement(WebDriverBy::id('genre'));
        //$inputTemporadas = self::$driver->findElement(WebDriverBy::id('qtd_temporadas'));
        //$inputEpisodios = self::$driver->findElement(WebDriverBy::id('ep_por_temporada'));

        //$inputNome->sendKeys('La Casa de Papel');
        //$selectGenero = new WebDriverSelect($inputGenero);
        //$selectGenero->selectByValue('acao'); //encontra pela posição ou nome
        //$inputTemporadas->sendKeys('4');
        //$inputEpisodios->sendKeys('25');

        //$inputEpisodios->submit();

        $paginaCadastro = new PaginaCadastroSeries(self::$driver);
        $paginaCadastro->preencheNome('Titans')
        ->selecionaGenero('acao')
        ->comTemporadas(2)
        ->comEpisodios(15)
        ->enviaFormulario();


        //Assert: Então eu devo ser redirecionado para a págia de listagem de séries cadastradas E vejo a mensagem "Série com suas respectivas temporadas e episódios adicionada."
        self::assertSame('http://127.0.0.1:8080/series', self::$driver->getCurrentURL()); //verificando se a url é a de listar series
        self::assertSame('Série com suas respectivas temporadas e episódios adicionada.',
         trim(self::$driver->findElement(WebDriverBy::cssSelector('div.alert.alert-success'))->getText()));//trim remove os espaços

    }

    public static function tearDownAfterClass():void
    {
        self::$driver->close();

    }
}