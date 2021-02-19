# Router
Analisa os dados da requisição executando a resposta apropriada

---

### A Classe

A classe **Router** é 100% estatica é pode ser encontada dentro do namespace **elegance**

---

### Adicionar rotas
Para adicionar rotas deve-se utilizar os seguintes metodos:

    Route::get(); // Adiciona uma rota que responde requisições do tipo get
    Route::post(); // Adiciona uma rota que responde requisições do tipo post
    Route::put(); // Adiciona uma rota que responde requisições do tipo put
    Route::delete(); // Adiciona uma rota que responde requisições do tipo delete

Os metodo recebe dois parametros básicos

    Route::get($route,$response)

O Parametro **$route** é o padrão para interpretação de rotas 

    home
    blog
    blog/post/{postId}

O Parametro **$response** é a forma como a rota deve ser respondida
Os tipos de reposta são:

 - **int**
    Esta resposta é tratada como um status HTTP
 - **boolean**
    Esta respota é tratada como 200 (caso true) ou 500 (caso false)
 - **controller**
    Pode-se passar um nome de classe para ser utilizada como controller

        elegance/Teste // Responde a requisição com \\elegance\\Teste:index($parametros)
        elegance/Teste:index //Response a requisição com \\elegance\Teste::metodo($parametros)
 - **action**
    Todas as rotas que não se encaixarem nas regras acima, serão respondidas com **action**

---

### Agrupadores

Agrupadores são um modo facil de organizar as rotas. São metodos que modificam temporariamente o comportamento da classe a ao se adicinar rotas novas

    Route::group_domain($domain,$function)
    Route::group_route($route,$function)
    Route::group_namespace($namespace,$function)
    Route::group_action($action,$function)

**group_domain**
    O Agrupador **group_domain** faz com que todas as rotas adicionadas dentro dele sejam definidas **apenas** se o dominio pertencer ao grupo de dominios definidos

    Route::group_route('dominio.com',function(){
        Route::get('post',[...]) // Esta rota será adicionada apenas ao domnio.com
    });
    
    Route::group_route(['dominio.com','dominio.com.br'],function(){
        Route::get('post',[...]) // Esta rota será adicionada apenas ao domnio.com e dominio.com.br
    });

**group_route**
    O Agrupador **group_route** faz com que todas as rotas adicionadas dentro dele tenham uma "pre rota" definida

    Route::group_route('blog',function(){
        Route::get('post',[...]) // Esta rota será adicionada como blog/post
    });
    
**group_namespace**
    O Agrupador **group_namespace** faz com que todas as rotas que respondam com uma classe, tenha um namespace pre definido

    Route::group_namespace('api',function(){
        Route::get('user','User:get') // A resposta desta rota será \\api\\User::get($parametros)
    });
    
**group_action**
    O Agrupador **group_action** faz com que antes de retornar qualquer resposta das rotas adicionadas dentro tele, uma action seja executadas

    Route::group_action('IS_LOGADO',function(){
        // Estas rotas so irão responder se a action 'IS_LOGADO' não finalizar a requisição 
        Route::get('post',[...]) 
        Route::get('user','User:get')
    });
    
### Encadeamento

Você deve enadear os agrupadores afim de conseguir o resultado esperado

    Route::group_action('IS_LOGADO',function(){
        Route::group_route('blog',function(){
            Route::get('post',[...])
        });
        Route::group_route('contato',function(){
            Route::get('',[...])
            Route::post('enviar',[...])
        });
    });

---

## Url Ignore
Por padrão, a classe vai rotear a URL atual completa. 
Em algumas ocasioes, precisamos que um ou mais parametros da URL sejam ignorados do roteamento.
Isso acontece quando o sistema é executando dentro de um diretório, ou dentro de uma pagina de outro sistema.
O metodo **urlPathIgnire** possibilita informar quantos parametos do caminho da URL serão ignorados. Isso afeta o roteamento e a criação de Links

    Router::urlPathIgnire($int);

Ex:

    URL=>'dominio.com.br/imagens/carros/azul/';
    Router::urlPathIgnire(1); //O roteamente será feito usando /carros/azuk
    Router::urlPathIgnire(2); //O roteamente será feito usando /azuk
    Router::urlPathIgnire(0); //O roteamente será feito usando imagens/carros/azuk (comportamento padrão)