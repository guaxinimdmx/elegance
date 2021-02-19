<?php

namespace elegance;

use SimpleXMLElement;

class ResponseXml extends ResponseText
{

    protected $headers = ['Content-Type' => 'text/xml; charset=utf-8'];
    protected $data = [];

    /** Retorna o conteúdo da resposta */
    protected function getContent()
    {
        $return = [
            'status' => $this->status,
            'message' => $this->getMessage(),
        ];

        foreach ($this->info as $name => $value) {
            $return[$name] = $value;
        }

        $return['data'] = $this->data;

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');
        $this->array_to_xml($return, $xml);
        return $xml->asXML();
    }

    /** Adiciona os dados de um array dentro de um XML */
    protected function array_to_xml($data, &$xml_data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

}
