<?php
    $params["refresh_token"] = "acdbf3913f0cf5f798101330cee75aba65c5e04f85025769f7593db9d089f8d0";

    $url = "https://www.orit.com.br/web_api/auth?".http_build_query($params);

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
    echo $code;
    if($code == "200"){
        //Tratamento dos dados de resposta da consulta.
    }else{
        //Tratamento das mensagens de erro
    }
?>