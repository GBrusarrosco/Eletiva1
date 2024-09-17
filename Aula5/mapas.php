<?php
    $frutas = array("morango", "maçã", "abacaxi"); // array classsico 

    echo "<p>" . $frutas[0] . "</p>";

    $frutas[0] = "laranja";

    $frutas["fruta"] = 15;

    $cores[0] = "azul";
    $cores["cor"] = "cinza";
    $cores = [
        "cor1" => "vermelho",
        "cor2" => "violeta",
        "cor3" => "marelo"
    ];
    asort($frutas); // ordenar por nome
    ksort($frutas); 
    var_dump($cores);
    print_r($cores);

    foreach($frutas as $valor); // apenas para acessar o valor
    foreach($frutas as $chave => $valor) 
    {
        echo "Na posição $chave temos o valor $valor";
    } // para acessar o valor da chave e o valor associado 


    echo "Quantidade de elementos no:" . count($cores);

?>  
