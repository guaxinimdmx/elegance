<?php

if (!function_exists('url')) {

    /**
     * Retorna a URL baseada na URL atual
     * @return \elegance\Url
     */
    function url()
    {
        $url = new \elegance\Url();
        $url->cif(false)->query(null)->path(0)->path(...func_get_args());
        return $url;
    }

}
