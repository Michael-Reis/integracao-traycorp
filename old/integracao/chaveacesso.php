<?php
    $params["consumer_key"] = "1388617810eeb3b36cf2bb5d3beef4667e82c452314aa9dfa7b740600665cb2f";
    $params["consumer_secret"] = "f5fcbf9965d6cd7c9123dc264335f01b801c1479f4c7650f8883af335608a701";
    $params["code"] = "e65b3d146237c7b500cd165054948417026014f397754009e9b950590efc9e42";

    $url = "https://www.loja.joia1958.com.br/web_api/auth";

    ob_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_exec($ch);

    // JSON de retorno  
    $resposta = json_decode(ob_get_contents());
    print_r($resposta);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);
    echo $code;
    if($code == "201"){
        //Tratamento dos dados de resposta da consulta.
    }else{
        //Tratamento das mensagens de erro
    }
?>