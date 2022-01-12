<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Tests\Singleton\ConexaoWebDriver;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Tests\PageObject\PaginaRegistroNovoUsuario;

class RegistroTest extends TestCase{

    private static WebDriver $driver;

    //antes de todos os testes, abre o navegador
    public static function setUpBeforeClass():void
    {
         //arrenge: Dado que estou com o navegador aberto
        $host='http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host,DesiredCapabilities::opera()); 
       
    }

    //entro na página que quero fazer os testes
   /* protected function setUp():void
    {
        self::$driver->get('http://127.0.0.1:8080/novo-usuario');
    }*/

    public function testQuandoRegistrarNovoUsuarioDeveRedirecionarParaListaDeSeries()
    {
      

       //Act: Quando preencho o formulário com informações válidas
       //$inputNome = self::$driver->findElement(WebDriverBy::id('name'));
       //$inputEmail = self::$driver->findElement(WebDriverBy::id('email'));
       //$inputSenha = self::$driver->findElement(WebDriverBy::id('password'));
      //$botaoEntrar = $driver->findElement(WebDriverBy::cssSelector('.btn.btn-primary.mt-3')); outra forma de enviar os dados é clicando no botão de enviar

       //$inputNome->sendKeys('Nome teste');
       //$inputEmail->sendKeys(md5(time()).'@email.com');//toda vez que executar o teste, ele vai gerar um nov email com base na hora
       /**Em um cenário real, o ideal seria realizar transações para poder inserir os usuários e depois limpar os dados
        * o ideal mesmo é ter um servidor exclusivo para teste
        Sendo assim, como nesse projeto não tem integração com um banco de dados real, não vamos fazer verificação se o email já existe
        e também vamos encher ele com dados irreais de email, apenas para teste.

        Mas se fosse uma situação rela, o ideal seria fazer isso com um servidor de teste e sempre limpar as informações antes ou depois
        de realizar os testes para manter o estado correto do nosso banco de dados.
        */
       //$inputSenha->sendKeys('123');

       //$inputSenha->sendKeys(WebDriverKeys::ENTER);//vai pressionar enter quando terminar de digitar, mas nem todos os elementos funcionam com o enter
       //$inputSenha->submit();//vai enviar os dados do formulario
        //$botaoEntrar->click(); outra forma de enviar os dados é clicando no botão
        //Assert: Então eu devo ser redirencionado para página de lista de séries
        //E ver o link "Sair"
        $paginaNovoUsuario = new PaginaRegistroNovoUsuario(self::$driver);

        $paginaNovoUsuario->preencheNome('Nome teste')
        ->preencheEmail(md5(time()).'@email.com')
        ->preencheSenha('123')
        ->enviaFormulario();
        
        self::assertSame('http://127.0.0.1:8080/series', self::$driver->getCurrentURL()); //verificando se a url é a de listar series
        self::assertInstanceOf(RemoteWebElement::class, self::$driver->findElement(WebDriverBy::linkText('Sair')));
        //garantindo que o elemento com texto no link SAIR seja válido
        //isDisplayed() - também garante que o elemento está na tela

        
    }

    //no final de todos os testes, quando a classe não for mais existir, então finalizo oo navegador
    public static function tearDownAfterClass():void
    {
        self::$driver->close();
    }

}