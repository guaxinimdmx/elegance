<?php

namespace elegance;

class Url
{

    protected $url;

    public function __construct($url = null)
    {
        if (is_null($url)) {
            $this->url = $this->getCurrentUrl()->__array();
        } else {
            $url = str_format_url($url);
            if (!substr_count($url, '://')) {
                $url = "http://$url";
            }
            $url = parse_url($url);

            $url['path'] = trim($url['path'] ?? '', '/');

            $this->url['cif'] = cif_check($url['path']) ? substr($url['path'], 1, 1) : false;
            $this->url['ssl'] = $url['scheme'] == 'https';
            $this->url['domain'] = $url['host'];
            $this->url['port'] = $url['port'] ?? null;

            if ($this->url['cif'] === false) {
                $this->url['path'] = explode('/', $url['path']);
                $url['query'] = $_SERVER['QUERY_STRING'] ?? '';
            } else {
                $tmp = cif_off($url['path']);
                $tmp = explode('?', $tmp);
                $this->url['path'] = explode('/', array_shift($tmp));
                $url['query'] = count($tmp) ? implode('?', $tmp) : '';
            }

            $this->url['query'] = [];
            if (isset($url['query'])) {
                parse_str($url['query'], $this->url['query']);
            }
        }
    }

    /**
     * Envia uma resposta de redirecionamento para a URL
     */
    public function redirect()
    {
        header("Location: $this");
        die;
    }

    /**
     * Retorna a string da URL ou uma parte do objeto URL
     */
    public function get()
    {
        if (func_num_args()) {
            return $this->url[func_get_arg(0)] ?? null;
        } else {
            $protocol = $this->url['ssl'] ? 'https' : 'http';
            $domain = $this->url['domain'];
            $port = $this->url['port'] ? ':' . $this->url['port'] : '';
            $path = implode('/', $this->url['path']);

            $query = [];
            foreach ($this->url['query'] as $name => $value) {
                $query[] = "$name=$value";
            }
            $query = implode('&', $query);
            $query = empty($query) ? $query : "?$query";

            $commands = $path . $query;

            if ($this->url['cif'] !== false) {
                $char = $this->url['cif'] === true ? null : $this->url['cif'];
                $commands = cif_on($commands, $char);
            }

            $url = "$protocol://$domain$port/$commands";
            $url = str_format_url($url);
            return $url;
        }
    }

    /** Define se a URL deve ser cifrada */
    public function cif($cif)
    {
        $this->url['cif'] = $cif;
        return $this;
    }

    /** Define se a URL deve utilizar SSL */
    public function ssl(bool $ssl)
    {
        $this->url['ssl'] = $ssl;
        return $this;
    }

    /** Define o domain da URL */
    public function domain(string $domain)
    {
        $this->url['domain'] = $domain;
        return $this;
    }

    /** Define a porta da URL */
    public function port($port)
    {
        $this->url['port'] = is_int($port) ? $port : null;
        return $this;
    }

    /** Define o path da URL */
    public function path()
    {
        $path = func_get_args()[0] ?? '';
        if (is_string($path) && substr($path, 0, 1) == '>') {
            $parametros = func_get_args()[1] ?? [];
            $this->path(Router::urlPath(substr($path, 1), $parametros));
        } else {
            foreach (func_get_args() as $path) {
                if (is_string($path)) {
                    $path = str_replace_all(
                        [' /', '//', '/ ', '  '],
                        ['/', '/', '/', ' '],
                        $path);
                    $path = explode('/', trim($path, '/'));
                    $this->url['path'] = merge($this->url['path'], $path);
                } else if (is_int($path)) {
                    $this->url['path'] = array_slice($this->url['path'], 0, $path);
                }
            }
        }
        return $this;
    }

    /** Define os parametros da query da URL */
    public function query($query)
    {
        if ($query === null) {
            $this->url['query'] = [];
        } else {
            ensure_array($query);
            foreach ($query as $name => $value) {
                if (is_null($value)) {
                    if (isset($this->url['query'][$name])) {
                        unset($this->url['query'][$name]);
                    }
                } else {
                    if (is_int($name)) {
                        $name = $value;
                    }
                    $this->url['query'][$name] = $value;
                }
            }
        }
        return $this;
    }

    #==| Funcionamento |==#

    /** Armazena a URL atual apra evitar retrabalho */
    protected static $currentUrl;

    /** Retorna a string da URL atual */
    protected function getCurrentUrl()
    {
        if (is_null(self::$currentUrl)) {
            $url = self::$currentUrl ??
                (($_SERVER['HTTPS'] ?? '') == 'on' ? 'https' : 'http') .
                '://' .
                $_SERVER['HTTP_HOST'] .
                '/' .
                $_SERVER['REQUEST_URI'] .
                '?' .
                ($_SERVER['QUERY_STRING'] ?? '');
            self::$currentUrl = new Url($url);
        }

        return self::$currentUrl;
    }

    /** Retorna o array estrutural da URL */
    public function __array()
    {
        return $this->url;
    }

    public function __toString()
    {
        return $this->get();
    }

}
