<?php
#==| Respostas informativas |==#

/**  Essa resposta provisória indica que tudo ocorreu bem até agora e que o cliente deve continuar com a requisição ou ignorar se já concluiu o que gostaria.*/
define('STS_100_Continue', 100);

/**  Esse código é enviado em resposta a um cabeçalho de solicitação Upgrade pelo cliente, e indica o protocolo a que o servidor está alternando.*/
define('STS_101_Switching_Protocol', 101);

/**  Este código indica que o servidor recebeu e está processando a requisição, mas nenhuma resposta está disponível ainda.*/
define('STS_102_Processing', 102);

/**  Este código tem principalmente o objetivo de ser utilizado com o cabeçalho Link, indicando que o agente deve iniciar a pré-carregar recursos enquanto o servidor prepara uma resposta.*/
define('STS_103_Early_Hints', 103);

#==| Respostas de sucesso |==#

/**  Estas requisição foi bem sucedida. O significado do sucesso varia de acordo com o método HTTP:*/
define('STS_200_OK', 200);

/**  A requisição foi bem sucedida e um novo recurso foi criado como resultado. Esta é uma tipica resposta enviada após uma requisição POST.*/
define('STS_201_Created', 201);

/**  A requisição foi recebida mas nenhuma ação foi tomada sobre ela. Isto é uma requisição não-comprometedora, o que significa que não há nenhuma maneira no HTTP para enviar uma resposta assíncrona indicando o resultado do processamento da solicitação. Isto é indicado para casos onde outro processo ou servidor lida com a requisição, ou para processamento em lote.*/
define('STS_202_Accepted', 202);

/**  Esse código de resposta significa que o conjunto de meta-informações retornadas não é o conjunto exato disponível no servidor de origem, mas coletado de uma cópia local ou de terceiros. Exceto essa condição, a resposta de 200 OK deve ser preferida em vez dessa resposta.*/
define('STS_203_Non-Authoritative_Information', 203);

/**  Não há conteúdo para enviar para esta solicitação, mas os cabeçalhos podem ser úteis. O user-agent pode atualizar seus cabeçalhos em cache para este recurso com os novos.*/
define('STS_204_No_Content', 204);

/**  Esta requisição é enviada após realizanda a solicitação para informar ao user agent redefinir a visualização do documento que enviou essa solicitação.*/
define('STS_205_Reset_Content', 205);

/**  Esta resposta é usada por causa do cabeçalho de intervalo enviado pelo cliente para separar o download em vários fluxos.*/
define('STS_206_Partial_Content', 206);

/**  Uma resposta Multi-Status transmite informações sobre vários recursos em situações em que vários códigos de status podem ser apropriados.*/
define('STS_207_Multi-Status', 207);

/**  Usado dentro de um elemento de resposta <dav:propstat> para evitar enumerar os membros internos de várias ligações à mesma coleção repetidamente.*/
define('STS_208_Multi-Status', 208);

/**  O servidor cumpriu uma solicitação GET para o recurso e a resposta é uma representação do resultado de uma ou mais manipulações de instância aplicadas à instância atual.*/
define('STS_226_IM_Used', 226);

#==| Mensagens de redirecionamento |==#

/**  A requisição tem mais de uma resposta possível. User-agent ou o user deve escolher uma delas. Não há maneira padrão para escolher uma das respostas.*/
define('STS_300_Multiple_Choice', 300);

/**  Esse código de resposta significa que a URI do recurso requerido mudou. Provavelmente, a nova URI será especificada na resposta.*/
define('STS_301_Moved_Permanently', 301);

/**  Esse código de resposta significa que a URI do recurso requerido foi mudada temporariamente. Novas mudanças na URI poderão ser feitas no futuro. Portanto, a mesma URI deve ser usada pelo cliente em requisições futuras.*/
define('STS_302_Found', 302);

/**  O servidor manda essa resposta para instruir ao cliente buscar o recurso requisitado em outra URI com uma requisição GET.*/
define('STS_303_See_Other', 303);

/**  Essa resposta é usada para questões de cache. Diz ao cliente que a resposta não foi modificada. Portanto, o cliente pode usar a mesma versão em cache da resposta.*/
define('STS_304_Not_Modified', 304);

/**  Foi definida em uma versão anterior da especificação HTTP para indicar que uma resposta deve ser acessada por um proxy. Foi depreciada por questões de segurança em respeito a configuração em banda de um proxy.*/
define('STS_305_Use_Proxy', 305);

/**  Esse código de resposta não é mais utilizado, encontra-se reservado. Foi usado numa versão anterior da especificação HTTP 1.1.*/
define('STS_306_unused', 306);

/**  O servidor mandou essa resposta direcionando o cliente a buscar o recurso requisitado em outra URI com o mesmo método que foi utilizado na requisição original. Tem a mesma semântica do código 302 Found, com a exceção de que o user-agent não deve mudar o método HTTP utilizado: se um POST foi utilizado na primeira requisição, um POST deve ser utilizado na segunda.*/
define('STS_307_Temporary_Redirect', 307);

/**  Esse código significa que o recurso agora está permanentemente localizado em outra URI, especificada pelo cabeçalho de resposta Location. Tem a mesma semântica do código de resposta HTTP 301 Moved Permanently  com a exceção de que o user-agent não deve mudar o método HTTP utilizado: se um POST foi utilizado na primeira requisição, um POST deve ser utilizado na segunda.*/
define('STS_308_Permanent_Redirect', 308);

#==| Respostas de erro do Cliente |==#

/**  Essa resposta significa que o servidor não entendeu a requisição pois está com uma sintaxe inválida.*/
define('STS_400_Bad_Request', 400);

/**  Embora o padrão HTTP especifique "unauthorized", semanticamente, essa resposta significa "unauthenticated". Ou seja, o cliente deve se autenticar para obter a resposta solicitada.*/
define('STS_401_Unauthorized', 401);

/**  Este código de resposta está reservado para uso futuro. O objetivo inicial da criação deste código era usá-lo para sistemas digitais de pagamento porém ele não está sendo usado atualmente.*/
define('STS_402_Payment_Required', 402);

/**  O cliente não tem direitos de acesso ao conteúdo portanto o servidor está rejeitando dar a resposta. Diferente do código 401, aqui a identidade do cliente é conhecida.*/
define('STS_403_Forbidden', 403);

/**  O servidor não pode encontrar o recurso solicitado. Este código de resposta talvez seja o mais famoso devido à frequência com que acontece na web.*/
define('STS_404_Not_Found', 404);

/**  O método de solicitação é conhecido pelo servidor, mas foi desativado e não pode ser usado. Os dois métodos obrigatórios, GET e HEAD, nunca devem ser desabilitados e não devem retornar este código de erro.*/
define('STS_405_Method_Not_Allowed', 405);

/**  Essa resposta é enviada quando o servidor da Web após realizar a negociação de conteúdo orientada pelo servidor, não encontra nenhum conteúdo seguindo os critérios fornecidos pelo agente do usuário.*/
define('STS_406_Not_Acceptable', 406);

/**  Semelhante ao 401 porem é necessário que a autenticação seja feita por um proxy.*/
define('STS_407_Proxy_Authentication_Required', 407);

/**  Esta resposta é enviada por alguns servidores em uma conexão ociosa, mesmo sem qualquer requisição prévia pelo cliente. Ela significa que o servidor gostaria de derrubar esta conexão em desuso. Esta resposta é muito usada já que alguns navegadores, como Chrome, Firefox 27+, ou IE9, usam mecanismos HTTP de pré-conexão para acelerar a navegação. Note também que alguns servidores meramente derrubam a conexão sem enviar esta mensagem.*/
define('STS_408_Request_Timeout', 408);

/**  Esta resposta será enviada quando uma requisição conflitar com o estado atual do servidor.*/
define('STS_409_Conflict', 409);

/**  Esta resposta será enviada quando o conteúdo requisitado foi permanentemente deletado do servidor, sem nenhum endereço de redirecionamento. É experado que clientes removam seus caches e links para o recurso. A especificação HTTP espera que este código de status seja usado para "serviços promocionais de tempo limitado". APIs não devem se sentir obrigadas a indicar que recursos foram removidos com este código de status.*/
define('STS_410_Gone', 410);

/**  O servidor rejeitou a requisição porque o campo Content-Length do cabeçalho não está definido e o servidor o requer.*/
define('STS_411_Length_Required', 411);

/**  O cliente indicou nos seus cabeçalhos pré-condições que o servidor não atende.*/
define('STS_412_Precondition_Failed', 412);

/**  A entidade requisição é maior do que os limites definidos pelo servidor; o servidor pode fechar a conexão ou retornar um campo de cabeçalho Retry-After.*/
define('STS_413_Payload_Too_Large', 413);

/**  A URI requisitada pelo cliente é maior do que o servidor aceita para interpretar.*/
define('STS_414_URI_Too_Long', 414);

/**  O formato de mídia dos dados requisitados não é suportado pelo servidor, então o servidor rejeita a requisição.*/
define('STS_415_Unsupported_Media_Type', 415);

/**  O trecho especificado pelo campo Range do cabeçalho na requisição não pode ser preenchido; é possível que o trecho esteja fora do tamanho dos dados da URI alvo.*/
define('STS_416_Requested_Range_Not_Satisfiable', 416);

/**  Este código de resposta significa que a expectativa indicada pelo campo Expect do cabeçalho da requisição não pode ser satisfeita pelo servidor.*/
define('STS_417_Expectation_Failed', 417);

/**  O servidor recusa a tentativa de coar café num bule de chá.*/
define('STS_418_Im_a_teapot', 418);

/**  A requisição foi direcionada a um servidor inapto a produzir a resposta. Pode ser enviado por um servidor que não está configurado para produzir respostas para a combinação de esquema ("scheme") e autoridade inclusas na URI da requisição.*/
define('STS_421_Misdirected_Request', 421);

/**  A requisição está bem formada mas inabilitada para ser seguida devido a erros semânticos.*/
define('STS_422_Unprocessable_Entity', 422);

/**  O recurso sendo acessado está travado.*/
define('STS_423_Locked', 423);

/**  A requisição falhou devido a falha em requisição prévia.*/
define('STS_424_Failed_Dependency', 424);

/**  Indica que o servidor não está disposto a arriscar processar uma requisição que pode ser refeita.*/
define('STS_425_Too_Early', 425);

/**  O servidor se recusa a executar a requisição usando o protocolo corrente mas estará pronto a fazê-lo após o cliente atualizar para um protocolo diferente. O servidor envia um cabeçalho Upgrade numa resposta 426 para indicar o(s) protocolo(s) requeridos.*/
define('STS_426_Upgrade_Required', 426);

/**  O servidor de origem requer que a resposta seja condicional. Feito para prevenir o problema da 'atualização perdida', onde um cliente pega o estado de um recurso (GET) , modifica-o, e o põe de volta no servidor (PUT), enquanto um terceiro modificou o estado no servidor, levando a um conflito.*/
define('STS_428_Precondition_Required', 428);

/**  O usuário enviou muitas requisições num dado tempo ("limitação de frequência").*/
define('STS_429_Too_Many_Requests', 429);

/**  O servidor não quer processar a requisição porque os campos de cabeçalho são muito grandes. A requisição PODE ser submetida novemente depois de reduzir o tamanho dos campos de cabeçalho.*/
define('STS_431_Request_Header_Fields_Too_Large', 431);

/**  O usuário requisitou um recurso ilegal, tal como uma página censurada por um governo.*/
define('STS_451_Unavailable_For_Legal_Reasons', 451);

#==| Respostas de erro do Servidor |==#

/**  O servidor encontrou uma situação com a qual não sabe lidar.*/
define('STS_500_Internal_Server_Error', 500);

/**  O método da requisição não é suportado pelo servidor e não pode ser manipulado. Os únicos métodos exigidos que servidores suportem (e portanto não devem retornar este código) são GET e HEAD.*/
define('STS_501_Not_Implemented', 501);

/**  Esta resposta de erro significa que o servidor, ao trabalhar como um gateway a fim de obter uma resposta necessária para manipular a requisição, obteve uma resposta inválida.*/
define('STS_502_Bad_Gateway', 502);

/**  O servidor não está pronto para manipular a requisição. Causas comuns são um servidor em manutenção ou sobrecarregado. Note que junto a esta resposta, uma página amigável explicando o problema deveria ser enviada. Estas respostas devem ser usadas para condições temporárias e o cabeçalho HTTP Retry-After: deverá, se posível, conter o tempo estimado para recuperação do serviço. O webmaster deve também tomar cuidado com os cabaçalhos relacionados com o cache que são enviados com esta resposta, já que estas respostas de condições temporárias normalmente não deveriam ser postas em cache.*/
define('STS_503_Service_Unavailable', 503);

/**  Esta resposta de erro é dada quando o servidor está atuando como um gateway e não obtém uma resposta a tempo.*/
define('STS_504_Gateway_Timeout', 504);

/**  A versão HTTP usada na requisição não é suportada pelo servidor.*/
define('STS_505_HTTP_Version_Not_Supported', 505);

/**  O servidor tem um erro de configuração interno: a negociação transparente de conteúdo para a requisição resulta em uma referência circular.*/
define('STS_506_Variant_Also_Negotiates', 506);

/**  O servidor tem um erro interno de configuração: o recurso variante escolhido está configurado para entrar em negociação transparente de conteúdo com ele mesmo, e portanto não é uma ponta válida no processo de negociação.*/
define('STS_507_Insufficient_Storage', 507);

/**  O servidor detectou um looping infinito ao processar a requisição.*/
define('STS_508_Loop_Detected', 508);

/**  Exigem-se extenções posteriores à requisição para o servidor atendê-la.*/
define('STS_510_Not_Extended', 510);

/**  O código de status 511 indica que o cliente precisa se autenticar para ganhar acesso à rede*/
define('STS_511_Network_Authentication_Required', 511);

/** Mensagens padrão dos status HTTP */
define('MESSAGE_STS', [
    100 => 'Continue',
    101 => 'Switching Protocol',
    102 => 'Processing',
    103 => 'Early Hints',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    208 => 'Multi-Status',
    226 => 'IM Used',
    300 => 'Multiple Choice',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => 'unused',
    307 => 'Temporary Redirect',
    308 => 'Permanent Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Payload Too Large',
    414 => 'URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    418 => 'Im a teapot',
    421 => 'Misdirected Request',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    425 => 'Too Early',
    426 => 'Upgrade Required',
    428 => 'Precondition Required',
    429 => 'Too Many Requests',
    431 => 'Request Header Fields Too Large',
    451 => 'Unavailable For Legal Reasons',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    508 => 'Loop Detected',
    510 => 'Not Extended',
    511 => 'Network Authentication Required',
]);
