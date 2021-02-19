# request
Captura informações sobre a requisição

A classe estaica **Request** pode ser encontrada dentro do namespace **elegance**

### Metodos

    
    /** Retorna/Compara o dominio (host) utilizado na requisição */
    Request::domain();
    Request::domain(domain_para_comparação);

    /** Retorna/Compara o tipo de chamada que foi realizada (GET, POST...) */
    Request::type();
    Request::type(type_para_comparação);
 

    /** Retorna/Compara o modo utillizado para realizar a chamada (terminal, browser...) */
    Request::mode();
    Request::mode(mode_para_comparação);
 

    /** Retorna um ou todos os parametros enviados via URL */
    Request::query();
    Request::query(parametro_para_retorno);
 

    /** Retorna um ou todos os parametros enviados via form */
    Request::data();
    Request::data(parametro_para_retorno);
 

    /** Retorna/Compra o sistema operacional do cliente */
    Request::os();
    Request::os(os_para_comparação);
 

    /** Retorna/Compra a versão do sistema operacional do cliente */
    Request::osVersion();
    Request::osVersion(osVersion_para_comparação);
 

    /** Retorna/Compra o navegador do cliente */
    Request::browser();
    Request::browser(browser_para_comparação);
 

    /** Retorna/Compra a versão do navegador do cliente */
    Request::browserVersion();
    Request::browserVersion(browserVersion_para_comparação);

### Constantes de tipo

 - TYPE_COMMAND
 - TYPE_GET
 - TYPE_POST
 - TYPE_PUT
 - TYPE_DELETE

### Constantes de modo

 - MODE_TERMINAL
 - MODE_BROWSER

### Constantes de sistema operacional

 - OS_WINDOWS
 - OS_WINDOWS_PHONE
 - OS_OS_X
 - OS_IOS
 - OS_ANDROID
 - OS_CHROME_OS
 - OS_LINUX
 - OS_SYMBOS
 - OS_NOKIA
 - OS_BLACKBERRY
 - OS_FREEBSD
 - OS_OPENBSD
 - OS_NETBSD
 - OS_OPENSOLARIS
 - OS_SUNOS
 - OS_OS2
 - OS_BEOS

### Constantes de navegador

 - BROWSER_VIVALDI
 - BROWSER_OPERA
 - BROWSER_OPERA_MINI
 - BROWSER_WEBTV
 - BROWSER_INTERNET_EXPLORER
 - BROWSER_POCKET_INTERNET_EXPLORER
 - BROWSER_MICROSOFT_EDGE
 - BROWSER_KONQUEROR
 - BROWSER_ICAB
 - BROWSER_OMNIWEB
 - BROWSER_FIREBIRD
 - BROWSER_FIREFOX
 - BROWSER_ICEWEASEL
 - BROWSER_SHIRETOKO
 - BROWSER_MOZILLA
 - BROWSER_AMAYA
 - BROWSER_LYNX
 - BROWSER_SAFARI
 - BROWSER_CHROME
 - BROWSER_NAVIGATOR
 - BROWSER_GOOGLEBOT
 - BROWSER_YAHOO_SLURP
 - BROWSER_W3C_VALIDATOR
 - BROWSER_BLACKBERRY
 - BROWSER_ICECAT
 - BROWSER_NOKIA_S60_OSS_BROWSER
 - BROWSER_NOKIA_BROWSER
 - BROWSER_MSN_BROWSER
 - BROWSER_MSN_BOT
 - BROWSER_NETSCAPE_NAVIGATOR
 - BROWSER_GALEON
 - BROWSER_NETPOSITIVE
 - BROWSER_PHOENIX
 - BROWSER_SEAMONKEY
 - BROWSER_YANDEX_BROWSER
 - BROWSER_COMODO_DRAGON
 - BROWSER_SAMSUNG_BROWSER
 - BROWSER_WKHTMLTOPDF