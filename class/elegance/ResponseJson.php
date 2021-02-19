<?php

namespace elegance;

class ResponseJson extends ResponseText
{

    protected $headers = ['Content-Type' => 'application/json; charset=utf-8'];
    protected $data = [];

    #==| Captura |==#

    /** Retorna o conteúdo da resposta */
    protected function getContent()
    {
        $json = [
            'status' => $this->status,
            'message' => $this->getMessage(),
        ];

        foreach ($this->info as $name => $value) {
            $json[$name] = $value;
        }

        $json['data'] = $this->data;

        return json_encode($json);
    }

}
