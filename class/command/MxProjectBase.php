<?php

namespace command;

use elegance\Cmd;
use elegance\Dir;

class MxProjectBase extends Cmd
{
    public function __construct()
    {
        $this->add('create', 'Cria arquivos básicos para um projeto com elegance');
    }

    #==| Comandos |==#

    public function create()
    {
        $to = dirname(__DIR__, 2) . "/library/template/project";
        Dir::copy($to, '.');
        $this->show('Projeto base criado');
    }
}
