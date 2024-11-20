<?php

    use MercadoPago\MercadoPagoConfig;

    require 'vender/autoload.php';

    MercadoPagoConfig::setAccessToken("TEST-2221383748999612-111815-1d20bf7cec550a1fa34354c6d415f622-386056396");

    $client = new PreferenceClient();

    $preference = $client->create([
        "summary" => [
            [
                "unit_price" => 100.00,
            ],
        ],

        
        "statement_descriptor" => "White Knight"

    ]);
    
?>