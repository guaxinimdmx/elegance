<?php

namespace command;

use elegance\Cmd;
use elegance\Dir;

class MxProjectBase extends Cmd
{
    public function __construct()
    {
        $this->add('create', 'Cria arquivos básicos para um projeto com elegance', true);
    }

    #==| Comandos |==#

    public function create()
    {
        Dir::create('./class');

        Dir::create('./helper/function');
        Dir::create('./helper/constant');
        Dir::create('./helper/script');

        Dir::create('./library');

        Dir::create('./public/assets');

        $to = dirname(__DIR__, 2) . "/library/template/project";

        Dir::copy($to, '.');

        $this->show('Projeto base criado');
    }
}
