<?php

namespace elegance;

class ResponseHtml extends ResponseText
{

    protected $headers = ['Content-Type' => 'text/html; charset=utf-8'];
    protected $data = '';

    /** Retorna o conteúdo da resposta */
    protected function getContent()
    {
        $info = [];
        foreach ($this->info as $name => $value) {
            $info[] = "<!--$name: $value-->";
        }
        $info = implode("\n", $info);
        $content = "$info\n$this->data\n$info";
        return $content;
    }

}
