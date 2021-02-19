<?php

namespace elegance;

class ResponseJs extends ResponseText
{

    protected $headers = ['Content-Type' => 'text/javascript; charset=utf-8'];
    protected $data = '';

    /** Retorna o conteúdo da resposta */
    protected function getContent()
    {
        $content = '';
        foreach ($this->info as $name => $value) {
            $content .= "/* $name: $value */\n";
        }
        $content .= $this->data;
        return $content;
    }

}
