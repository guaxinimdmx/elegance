<?php

namespace elegance;

use elegance\Action;
use elegance\Request;
use elegance\Url;
use Exception;

class Router
{

    protected static $listRoute = [];
    protected static $listName = [];
    protected static $listAction = [];

    protected static $groupRoute = [];
    protected static $groupAction = [];
    protected static $groupNamespce = [];

    protected static $urlPathIgnore = 0;

    /**
     * Resolve a URL atual em uma rota
     * @param int|null $ignore Numero de parametros da URL que devem ser ignorados
     */
    public static function souve()
    {
        //Praparando comandos
        $commands = self::formatCommands();

        //Executando action
        $action = self::getaction($commands);
        Action::runRoutine($action);

        //Executando Rota
        $route = self::getRoute($commands);

        //Retornando status automático
        if (is_bool($route)) {
            return boolval($route) ? 200 : 500;
        }

        //Retornando status manual
        if (is_numeric($route) || is_null($route)) {
            return $route ?? 404;
        }

        if (is_string($route)) {
            if (is_string($route)) { //Redirecionando
                if (substr($route, 0, 1) == '>') {
                    return url($route)->redirect();
                } else if (self::is_refClass($route)) { //Retornando controller
                    $method = explode(':', $route);
                    $class = array_shift($method);
                    $class = str_replace('/', '\\', $class);
                    if (class_exists($class)) {
                        $method = array_shift($method);
                        $method = $method == '' ? 'index' : $method;
                        if (is_callable([$class, $method])) {
                            return (new $class($commands))->{$method}($commands);
                        }
                    }
                    return 404;
                }
            }
        }
        //Retornando como uma action
        return Action::run($route, $commands);

    }

    #==| Utilização |==#

    /** Define a quantidade de parametos da URL que não devem ser interpretados como rota */
    public static function urlPathIgnire($ignore)
    {
        self::$urlPathIgnore = max(0, $ignore);
    }

    /**
     * Retorna o caminho URL para uma rota
     * @param string $routeName Nome da rota que deve ter o link retornado
     * @param array $parametros Parametros para serem inseridos ao link
     */
    public static function urlPath($routeName, $parametros = [])
    {
        $route = self::$listName[$routeName] ?? $routeName;
        $route = str_replace(['{#', '{', '}'], ['[#', '[#', ']'], $route);
        $route = prepare($route, $parametros);
        return $route;
    }

    #==| Grupos |==#

    /**
     * Cria regras de rota para um grupo de dominios especifico
     * @param string|string[] $domain Dominio ou array de dominios que devem ter as regras aplicads
     * @param string $function Função contento as regras
     */
    public static function group_domain($domain, $function)
    {
        $validate = false;
        ensure_array($domain);
        foreach ($domain as $d) {
            $validate = $validate || Request::domain($d);
        }
        if ($validate) {
            if (is_closure($function)) {
                $function();
            } else {
                throw new Exception("O parametro [\$function] deve conter um objeto Clousure");
            }
        }
    }

    /**
     * Cria um grupo de rotas
     * @param string $route Rota que deve ser adicionada antes de qualquer as rota do grupo
     * @param string $function Função contento as rotas do grupo
     */
    public static function group_route($route, $function)
    {
        if (is_closure($function)) {
            self::$groupRoute[] = $route;
            $function();
            array_pop(self::$groupRoute);
        } else {
            throw new Exception("O parametro [\$function] deve conter um objeto Clousure");
        }
    }

    /**
     * Cria um grupo de actions
     * @param string $action Actions que devem ser executadas antes de qualquer rota do grupo
     * @param string $function Função contento as rotas do grupo
     */
    public static function group_action($action, $function)
    {
        if (is_closure($function)) {
            self::$groupAction[] = $action;
            $function();
            array_pop(self::$groupAction);
        } else {
            throw new Exception("O parametro [\$function] deve conter um objeto Clousure");
        }
    }

    /**
     * Cria um grupo de namespace
     * @param string $namespace Namespace que devem ser adicionado antes de todas as classes de reposta do gupo
     * @param string $function Função contento as rotas do grupo
     */
    public static function group_namespace($namspace, $function)
    {
        if (is_closure($function)) {
            self::$groupNamespce[] = $namspace;
            $function();
            array_pop(self::$groupNamespce);
        } else {
            throw new Exception("O parametro [\$function] deve conter um objeto Clousure");
        }
    }

    /**
     * Adiciona uma rota que responde requisições do tipo get
     * @param string $route Padrão para interpretação da rota
     * @param string $name Nome da rota para chamadas dinamicas
     * @param string|int|function $response Forma como a rota deve ser respondida
     */
    public static function get($route, $response, $name = null)
    {
        self::addRoute('get', $route, $response, $name);
    }

    /**
     * Adiciona uma rota que responde requisições do tipo post
     * @param string $route Padrão para interpretação da rota
     * @param string $name Nome da rota para chamadas dinamicas
     * @param string|int|function $response Forma como a rota deve ser respondida
     */
    public static function post($route, $response, $name = null)
    {
        self::addRoute('post', $route, $response, $name);
    }

    /**
     * Adiciona uma rota que responde requisições do tipo put
     * @param string $route Padrão para interpretação da rota
     * @param string $name Nome da rota para chamadas dinamicas
     * @param string|int|function $response Forma como a rota deve ser respondida
     */
    public static function put($route, $response, $name = null)
    {
        self::addRoute('put', $route, $response, $name);
    }

    /**
     * Adiciona uma rota que responde requisições do tipo delete
     * @param string $route Padrão para interpretação da rota
     * @param string $name Nome da rota para chamadas dinamicas
     * @param string|int|function $response Forma como a rota deve ser respondida
     */
    public static function delete($route, $response, $name = null)
    {
        self::addRoute('delete', $route, $response, $name);
    }

    #==| Funcionamento |==#

    /**
     * Adiciona uma rota para ser gerenciada
     * @param string $type Tipo de rota que deve ser adicionada (GET, POST, PUT DELEET)
     * @param string $route Rota como pode ser encontada na URL
     * @param string $name Nome da rota para chamadas dinamicas
     * @param string $response Modo como a rota deve ser respondida
     */
    protected static function addRoute($type, $route, $response, $name = null)
    {
        $type = self::prepareType($type);
        $route = self::prepareRoute($route);
        $response = self::prepareResponse($response);

        self::$listRoute[$type][$route] = $response;

        if ($name) {
            self::$listName[$name] = $route;
        }

        if (!empty(self::$groupAction)) {
            self::$listAction[$type][$route] = self::$groupAction;
        }
    }

    /** Verifica se uma string aponta para uma classe */
    protected static function is_refClass($response)
    {
        if (is_string($response)) {
            if (substr_count($response, ':') || substr_count($response, '\\') || substr_count($response, '/')) {
                return true;
            }
        }
        return false;
    }

    /** Verifica se a rota pode ser representada por um grupo de comandos */
    protected static function is_route($route, $commands)
    {
        $routeParts = array_filter(explode('/', $route), function ($e) {
            return $e != '';
        });
        if (count($routeParts) != count($commands)) {
            return false;
        }
        $expression = [];
        foreach ($routeParts as $part) {
            $expression[] = preg_match("/^\{+/", $part) ? "[a-zA-Z0-9-\_]+" : $part;
        }
        $expression = '/^' . implode("\/", $expression);
        $expression .= (substr($route, -1) == '/') ? '$/' : '/';
        return preg_match($expression, implode('/', $commands));
    }

    #==| Preparação |==#

    /** Prepara um tipo de rota para ser utilizado */
    protected static function prepareType($type)
    {
        $type = toCase_upper($type);
        self::$listRoute[$type] = self::$listRoute[$type] ?? [];
        self::$listAction[$type] = self::$listAction[$type] ?? [];
        return $type;
    }

    /** Prepara uma rota para ser utilizada */
    protected static function prepareRoute($route)
    {
        $route = implode('/', self::$groupRoute) . "/$route";
        $route = self::formatRoute($route);
        return $route;
    }

    /** Prepara uma resposta para ser utilizada */
    protected static function prepareResponse($response)
    {
        if (self::is_refClass($response)) {
            $response = str_replace('\\', '/', $response);
            if (substr($response, 0, 1) !== '/') {
                $response = implode('/', self::$groupNamespce) . "/$response";
            }
            $response = str_replace_all(['\\', '//'], '/', $response);
            $response = str_replace('/:', ':', $response);
        }
        return $response;
    }

    #==| Formatação |==#

    /** Formata o nome de uma rota */
    protected static function formatRoute($route)
    {
        $route = str_replace(' ', '', $route);
        $route = trim($route, '/');
        $route = "$route/";
        $route = str_replace_all('//', '/', $route);
        return $route;
    }

    /** Retorna comandos formatados e prontos para serem interpretados */
    protected static function formatCommands()
    {
        $commands = (new Url())->get('path');
        foreach ($commands as $p => $v) {
            if (!strlen($v)) {
                unset($commands[$p]);
            }
        }
        $commands = array_slice($commands, self::$urlPathIgnore);
        return $commands;
    }

    /** Formata uma estrutura de rotas */
    protected static function formatStructure($structure)
    {
        uksort($structure, function ($a, $b) {
            $va = substr_count($a, '/');
            $vb = substr_count($b, '/');
            if ($va != $vb) {return ($va <=> $vb) * -1;}

            $va = substr_count($a, '{#');
            $vb = substr_count($b, '{#');
            if ($va != $vb) {return ($va <=> $vb);}

            $va = strpos($a, '{#');
            $vb = strpos($b, '{#');
            if ($va != $vb) {return ($va <=> $vb) * -1;}

            $va = strlen($a);
            $vb = strlen($b);
            if ($va != $vb) {return ($va <=> $vb) * -1;}

            return 0;
        });

        return $structure;
    }

    #==| Interpretação |==#

    /** Retorna a action que deve ser executada  */
    protected static function getAction($commands)
    {
        $list = self::formatStructure(self::$listAction[Request::type()] ?? []);
        foreach ($list as $route => $action) {
            if (self::is_route($route, $commands)) {
                return $action;
            }
        }
    }

    /** Retorna a respota que deve ser executada */
    protected static function getRoute(&$commands)
    {
        $list = self::formatStructure(self::$listRoute[Request::type()] ?? []);
        foreach ($list as $route => $response) {
            if (self::is_route($route, $commands)) {
                $commands = self::getData($route, $commands);
                return $response;
            }
        }
    }

    /** Retorna os comandos forneceidos via URL removendo os parametros estaticos */
    protected static function getData($route, $commands)
    {
        $route = explode('/', $route);
        $data = [];
        while (count($route)) {
            $valor = array_shift($commands);
            $name = array_shift($route);
            if (preg_match("/^\{+/", $name)) {
                $name = trim($name, '{}');
                if ($name == '#') {
                    $data[] = $valor;
                } else {
                    $data[$name] = $valor;
                }
            }
        }
        return $data;
    }

}
