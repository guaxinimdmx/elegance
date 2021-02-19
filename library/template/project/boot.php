<?php

namespace elegance;

Router::get('', function () {
    (new ResponseText())
        ->data('Tudo funcionando')
        ->send();
});

$result = Router::souve();

(new ResponseText())
    ->status($result)
    ->data(prepare('ERRO: [#]', $result))
    ->send();
