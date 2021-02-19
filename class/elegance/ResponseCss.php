<?php

namespace elegance;

class ResponseCss extends ResponseText
{

    protected $headers = ['Content-Type' => 'text/css; charset=utf-8'];
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
