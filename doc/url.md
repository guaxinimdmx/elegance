# url
Cria e manipula URL em PHP

## A Classe
A classe URL pode ser encontrada dentro do namespace **elegance** e é do tipo Objeto

## Criando um Objeto de URL
Para criar um objeto, basta instanciar a classe passando a URL que quer manipular
Caso nenhuma URL seja informada, a URL atual será utilizada

    $googleUrl = new Url('google.com');
    $currentUrl = new Url();

## Helper
O Helper URL retorna um objeto da URL atual livre de QUERY ou PATH

    url([...$path]);

O Helper URL_TRUE retorna um objeto da URL atual da forma que foi interpretada, com QUERY, PATH e cifra

    url_true([...$path]);

O Helper URL_CLEAN retorna um objeto da URL atual livre de QUERY ou PATH, mas mantema cifra, caso exista

    url_free([...$path]);

## Manipulando URL
Uma vez que o objeto tenha sido criado, pode-se manipular a URL com os seguintes metodos

    /**
     * Define a utilização do SSL pela URL
     * @return this
     */
    ssl(bool $use)
ㅤ

    /**
     * Define o dominio da URL
     * @return this
     */
    domain(string $domain)
ㅤ

    /**
     * Define a porta que deve ser utilizada na URL
     * @return this
     */
    port(int $port)
ㅤ

    /**
     * Manipula o caminho da URL
     * @return this
     */
    path()
ㅤ

    /**
     * Manipula a quary da URL
     * @return this
     */
    query(array $query)

Todos estes metodos, retornam o proprio objeto e podem ser encadeados

    $url->ssl(true)->port(3333);

### Metodo especial Path
O Metodo Path define o caminho da URL, e tem um comportamenteo especial
Pode-se passar quantos parametros precisar para o metodo, ele vai interpretar da seguinte maneira:

**String:** O metodo vai adicionar esta string a lista dos caminhos da URL
**INT Positivo** O metodo vai manter os X primeiros caminhos da URL e descartar os demais
**INT Negativo** O metodo vai descartar os X ultimos caminhos da URL
**INT 0** O metodo vai descartar todos os parametros

Ainda é possivel utilizar nome de rotas como path da URL
Para isso, utilize o atalho **>**

    $url->path(0,'>home');

## Utilização
Para utilizar o objeto de URL, exitem duas meneira
Pode-se utilizar o metodo **get** para capturar a string da URL

    $url->get();

Pode-se concatenar o objeto com uma string, obtendo um resultado semelhante ao metodo get

    "A Url é $url";

## Redirecionamento
Pode-se redirecionar a requisição para a URL utilizando o metodo abaixo

    $url->redirect();

## Capturar informações
O metodo **get**, alem de retornar a string da URL, pode retornar um parametro especifico do objeto.

    $url->get('ssl');//Retorna o status de uso do SSL
    $url->get('domain');//Retorna o dominio da URL
    $url->get('port');//Retorna a porta utilizada na URL
    $url->get('path');//Retorna o caminho da URL
    $url->get('query');//Retorna a quaery GET
