# response
Controla a resposta de uma requisição PHP

## Criando respostas
Para criar uma resposta, basta instanciar um dos objetos fornecidos por este pacote. 
todos podem ser encotnados dentro do namespace **elegance**
Cada objeto cria uma resposta de um tipo especifico

    $response = new \elegance\ReponseCss();
    $response = new \elegance\ReponseHtml();
    $response = new \elegance\ReponseJs();
    $response = new \elegance\ReponseJson();
    $response = new \elegance\ReponseText();
    $response = new \elegance\ReponseXml();

## Adicionar Conteúdo
Para adicionar conetúdo, basta utilziar o metodo **data**

    $reponse->data('conteúdo');

## Definir Status
Para definir um status, utlize o metodo **status**

    $response->status(404);
POde-se alterar a mensagem de status enviada em algumas requisições. 
Isso não atera a mensagem enviada no Header
Para alterar a mensagem utilize o metodo **message**

    $reponse->status(404)->message('página não encontrada');

## Adicionar cabeçalhos
Em algumas ocasioes, precisamos adicionar cabeçalhos extras a resposta, pode-se utilziar o metodo **header**

    $responce->header('headerName','headerValue');

> O cebeçalho **status** e **content-type** são adicinados automaticamente

## Informações
As informações são enviadas junto ao corpo da resposta de forma automatica e organizada

    $reponse->info(['version'=>'2.0']);

## Constantes de Status
As contantes podem ser utilizadas para dar um apoio na hora de fornecer o status correo
são elas:
 - STS_100_Continue
 - STS_101_Switching_Protocol
 - STS_102_Processing
 - STS_103_Early_Hints
 - STS_200_OK
 - STS_201_Created
 - STS_202_Accepted
 - STS_203_Non-Authoritative_Information
 - STS_204_No_Content
 - STS_205_Reset_Content
 - STS_206_Partial_Content
 - STS_207_Multi-Status
 - STS_208_Multi-Status
 - STS_226_IM_Used
 - STS_300_Multiple_Choice
 - STS_301_Moved_Permanently
 - STS_302_Found
 - STS_303_See_Other
 - STS_304_Not_Modified
 - STS_305_Use_Proxy
 - STS_306_unused
 - STS_307_Temporary_Redirect
 - STS_308_Permanent_Redirect
 - STS_400_Bad_Request
 - STS_401_Unauthorized
 - STS_402_Payment_Required
 - STS_403_Forbidden
 - STS_404_Not_Found
 - STS_405_Method_Not_Allowed
 - STS_406_Not_Acceptable
 - STS_407_Proxy_Authentication_Required
 - STS_408_Request_Timeout
 - STS_409_Conflict
 - STS_410_Gone
 - STS_411_Length_Required
 - STS_412_Precondition_Failed
 - STS_413_Payload_Too_Large
 - STS_414_URI_Too_Long
 - STS_415_Unsupported_Media_Type
 - STS_416_Requested_Range_Not_Satisfiable
 - STS_417_Expectation_Failed
 - STS_418_Im_a_teapot
 - STS_421_Misdirected_Request
 - STS_422_Unprocessable_Entity
 - STS_423_Locked
 - STS_424_Failed_Dependency
 - STS_425_Too_Early
 - STS_426_Upgrade_Required
 - STS_428_Precondition_Required
 - STS_429_Too_Many_Requests
 - STS_431_Request_Header_Fields_Too_Large
 - STS_451_Unavailable_For_Legal_Reasons
 - STS_500_Internal_Server_Error
 - STS_501_Not_Implemented
 - STS_502_Bad_Gateway
 - STS_503_Service_Unavailable
 - STS_504_Gateway_Timeout
 - STS_505_HTTP_Version_Not_Supported
 - STS_506_Variant_Also_Negotiates
 - STS_507_Insufficient_Storage
 - STS_508_Loop_Detected
 - STS_510_Not_Extended
 - STS_511_Network_Authentication_Required

## Criar classes de resposta
Para criar seus proprios objetos de resposa, basta extender a classe **ResponseText** que pode ser encontrado dentro do namespace **elegance**

Ex:

    <?php

    use elegance\ResponseText;

    class NameClass extends ResponseText
    {
        protected $headers = ['Content-Type' => 'text/html; charset=utf-8'];
        protected $data    = '';
    }
