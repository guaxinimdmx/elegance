<?php

namespace elegance;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

abstract class Request
{
    protected static $type;
    protected static $mode;
    protected static $query;
    protected static $data;
    protected static $os;
    protected static $osVersion;
    protected static $browser;
    protected static $browserVersion;

    /** Retorna/Compara o dominio (host) utilizado na requisição */
    public static function domain()
    {
        $domain = (new Url())->get('domain');
        if (func_num_args()) {
            return $domain == (new Url(func_get_arg(0)))->get('domain');
        }
        return $domain;
    }

    /** Retorna/Compara o tipo de chamada que foi realizada (GET, POST...) */
    public static function type()
    {
        if (is_null(self::$type)) {
            if (self::mode(self::MODE_TERMINAL)) {
                self::$type = self::TYPE_COMMAND;
            } else {
                self::$type = toCase_snake_upper($_SERVER['REQUEST_METHOD'] ?? self::TYPE_GET);
            }
        }
        if (func_num_args()) {
            return self::$mode == toCase_snake_upper(func_get_arg(0));
        }
        return self::$type;
    }

    /** Retorna/Compara o modo utillizado para realizar a chamada (terminal, browser...) */
    public static function mode()
    {
        if (is_null(self::$mode)) {
            self::$mode = isset($_SERVER['HTTP_HOST']) ? self::MODE_BROWSER : self::MODE_TERMINAL;
        }
        if (func_num_args()) {
            return self::$mode == toCase_snake_upper(func_get_arg(0));
        }
        return self::$mode;
    }

    /** Retorna um ou todos os parametros enviados via URL */
    public static function query()
    {
        if (is_null(self::$query)) {
            self::$query = (new Url())->get('query');
        }
        if (func_num_args()) {
            return self::$query[func_get_arg(0)] ?? null;
        }
        return self::$query;
    }

    /** Retorna um ou todos os parametros enviados via form */
    public static function data()
    {
        if (is_null(self::$data)) {
            switch (self::type()) {
                case self::TYPE_POST:
                    $data = $_POST;
                    break;
                case self::TYPE_GET:
                case self::TYPE_PUT:
                case self::TYPE_DELETE:
                    parse_str(file_get_contents('php://input'), $data);
                    break;
                default:
                    $data = [];
            }
            ensure_array($data);
            self::$data = $data;
        }
        if (func_num_args()) {
            return self::$data[func_get_arg(0)] ?? null;
        }
        return self::$data;
    }

    /** Retorna/Compra o sistema operacional do cliente */
    public static function os()
    {
        if (is_null(self::$os)) {
            $os = new Os();
            self::$os = $os->getName();
        }
        if (func_num_args()) {
            return self::$os == toCase_snake_upper(func_get_args(0));
        }
        return self::$os;
    }

    /** Retorna/Compra a versão do sistema operacional do cliente */
    public static function osVersion()
    {
        if (is_null(self::$osVersion)) {
            $os = new Os();
            self::$osVersion = $os->getVersion();
        }
        if (func_num_args()) {
            return self::$osVersion == toCase_snake_upper(func_get_args(0));
        }
        return self::$osVersion;
    }

    /** Retorna/Compra o navegador do cliente */
    public static function browser()
    {
        if (is_null(self::$browser)) {
            $browser = new Browser();
            self::$browser = $browser->getName();
        }
        if (func_num_args()) {
            return self::$browser == toCase_snake_upper(func_get_args(0));
        }
        return self::$browser;
    }

    /** Retorna/Compra a versão do navegador do cliente */
    public static function browserVersion()
    {
        if (is_null(self::$browserVersion)) {
            $browser = new Browser();
            self::$browser = $browser->getVersion();
        }
        if (func_num_args()) {
            return self::$browserVersion == toCase_snake_upper(func_get_args(0));
        }
        return self::$browserVersion;
    }

    /** Constantes de modo de requisição */
    const MODE_TERMINAL = 'TERMINAL';
    const MODE_BROWSER = 'BROWSER';

    /** Constantes de tipo de requisição */
    const TYPE_COMMAND = 'CMD';
    const TYPE_GET = 'GET';
    const TYPE_POST = 'POST';
    const TYPE_PUT = 'PUT';
    const TYPE_DELETE = 'DELETE';

    /** Constantes de OS */
    const OS_WINDOWS = 'WINDOWS';
    const OS_WINDOWS_PHONE = 'WINDOWS_PHONE';
    const OS_OS_X = 'OS_X';
    const OS_IOS = 'IOS';
    const OS_ANDROID = 'ANDROID';
    const OS_CHROME_OS = 'CHROME_OS';
    const OS_LINUX = 'LINUX';
    const OS_SYMBOS = 'SYMBOS';
    const OS_NOKIA = 'NOKIA';
    const OS_BLACKBERRY = 'BLACKBERRY';
    const OS_FREEBSD = 'FREEBSD';
    const OS_OPENBSD = 'OPENBSD';
    const OS_NETBSD = 'NETBSD';
    const OS_OPENSOLARIS = 'OPENSOLARIS';
    const OS_SUNOS = 'SUNOS';
    const OS_OS2 = 'OS2';
    const OS_BEOS = 'BEOS';

    /** Constantes de navegadores */
    const BROWSER_VIVALDI = 'VIVALDI';
    const BROWSER_OPERA = 'OPERA';
    const BROWSER_OPERA_MINI = 'OPERA_MINI';
    const BROWSER_WEBTV = 'WEBTV';
    const BROWSER_INTERNET_EXPLORER = 'INTERNET_EXPLORER';
    const BROWSER_POCKET_INTERNET_EXPLORER = 'POCKET_INTERNET_EXPLORER';
    const BROWSER_MICROSOFT_EDGE = 'MICROSOFT_EDGE';
    const BROWSER_KONQUEROR = 'KONQUEROR';
    const BROWSER_ICAB = 'ICAB';
    const BROWSER_OMNIWEB = 'OMNIWEB';
    const BROWSER_FIREBIRD = 'FIREBIRD';
    const BROWSER_FIREFOX = 'FIREFOX';
    const BROWSER_ICEWEASEL = 'ICEWEASEL';
    const BROWSER_SHIRETOKO = 'SHIRETOKO';
    const BROWSER_MOZILLA = 'MOZILLA';
    const BROWSER_AMAYA = 'AMAYA';
    const BROWSER_LYNX = 'LYNX';
    const BROWSER_SAFARI = 'SAFARI';
    const BROWSER_CHROME = 'CHROME';
    const BROWSER_NAVIGATOR = 'NAVIGATOR';
    const BROWSER_GOOGLEBOT = 'GOOGLEBOT';
    const BROWSER_YAHOO_SLURP = 'YAHOO!_SLURP';
    const BROWSER_W3C_VALIDATOR = 'W3C_VALIDATOR';
    const BROWSER_BLACKBERRY = 'BLACKBERRY';
    const BROWSER_ICECAT = 'ICECAT';
    const BROWSER_NOKIA_S60_OSS_BROWSER = 'NOKIA_S60_OSS_BROWSER';
    const BROWSER_NOKIA_BROWSER = 'NOKIA_BROWSER';
    const BROWSER_MSN_BROWSER = 'MSN_BROWSER';
    const BROWSER_MSN_BOT = 'MSN_BOT';
    const BROWSER_NETSCAPE_NAVIGATOR = 'NETSCAPE_NAVIGATOR';
    const BROWSER_GALEON = 'GALEON';
    const BROWSER_NETPOSITIVE = 'NETPOSITIVE';
    const BROWSER_PHOENIX = 'PHOENIX';
    const BROWSER_SEAMONKEY = 'SEAMONKEY';
    const BROWSER_YANDEX_BROWSER = 'YANDEX_BROWSER';
    const BROWSER_COMODO_DRAGON = 'COMODO_DRAGON';
    const BROWSER_SAMSUNG_BROWSER = 'SAMSUNG_BROWSER';
    const BROWSER_WKHTMLTOPDF = 'WKHTMLTOPDF';

}
