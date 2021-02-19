<?php

namespace command;

use elegance\Cmd;

class MxServer extends Cmd
{

    public function __construct()
    {
        $this->add('in', 'Instancia um servidor embutido php em uma porta', true);
    }

    public function in($porta = '3333')
    {
        loadEnv();
        $public = env('DIR_PUBLIC', './public');
        if (!is_dir($public)) {
            return $this->show("Diretório [./public] não encontrado");
        }
        $this->show('|> Iniciando servidor PHP');
        $this->show('|> Acesse: [#]', "http://localhost:$porta/");
        $this->show('|> Use: [#] para finalizar o servidor', "CLTR+C");
        $this->show("|> Escutando porta [#]\n...", $porta);
        sleep(2);
        echo shell_exec("cd $public && php -S localhost:$porta");
        die("\n\n");
    }
}
