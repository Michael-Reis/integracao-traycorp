<?php
    $token = "1388617810eeb3b36cf2bb5d3beef4667e82c452314aa9dfa7b740600665cb2f";
    $params["access_token"] = $token;
    $params["sort"] = "id_desc";

    $url = "https://{api_address}/categories/tree/123?".http_build_query($params);

    ob_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_exec($ch);

    // JSON de retorno  
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);

    if($code == "200"){
        //Tratamento dos dados de resposta da consulta.
    }else{
        //Tratamento das mensagens de erro
    }
?>