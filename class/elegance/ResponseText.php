<?php

namespace elegance;

class ResponseText
{

    protected $headers = ['Content-Type' => 'text/plain'];
    protected $message = null;
    protected $status = 200;
    protected $info = [];
    protected $data = '';

    /** Retorna o conteúdo da resposta */
    protected function getContent()
    {
        $info = [];
        foreach ($this->info as $name => $value) {
            $info[] = "$name: $value";
        }
        $info = implode("\n", $info);
        $info = $info == '' ? '' : "$info\n----------\n";
        $content = "$info$this->data";
        return $content;
    }

    /** Envia a resposta e finaliza a requisição */
    public function send()
    {
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        die($this->getContent());
    }

    /** Altera o status da resposta */
    public function status($status)
    {
        $this->status = intval($status);
        return $this;
    }

    /** Altera a mensagem que acompanah a resposta (não altera a mensagem do header) */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    /** Adiciona um item ao heder da resposta */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /** Define um conteúdo da resposta */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /** Define um conteúdo extra que deve ser enviado junto a resposta */
    public function info($name, $value)
    {
        $this->info[$name] = $value;
        return $this;
    }

    /** Retorna a mensagem de status */
    public function getMessage()
    {
        return $this->message ?? MESSAGE_STS[$this->status] ?? 'Unknown Status Cod';
    }

}
