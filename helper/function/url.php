<?php

if (!function_exists('url')) {

    /**
     * Retorna um objeto da URL atual livre de QUERY ou PATH
     * @return \elegance\Url
     */
    function url()
    {
        $url = new \elegance\Url();
        $url->cif(false)->query(null)->path(0)->path(...func_get_args());
        return $url;
    }

}

if (!function_exists('url_free')) {

    /**
     * Retorna um objeto da URL atual livre de QUERY ou PATH, mantendo a cifra, caso exista
     * @return \elegance\Url
     */
    function url_free()
    {
        $url = new \elegance\Url();
        $url->query(null)->path(0)->path(...func_get_args());
        return $url;
    }

}

if (!function_exists('url_true')) {

    /**
     * Retorna um objeto da URL atual da forma que foi interpretada, com QUERY, PATH e cifra
     * @return \elegance\Url
     */
    function url_true()
    {
        $url = new \elegance\Url();
        $url->path(...func_get_args());
        return $url;
    }

}
