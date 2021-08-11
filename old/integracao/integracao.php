<?php
    include("../conexao.php");
    include("../componentes/tray.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();
    //print_r($traycomp);
    date_default_timezone_set('America/Sao_Paulo');
    $params["consumer_key"] = $traycomp->consumer_key;
    $params["consumer_secret"] = $traycomp->consumer_secret;
    $params["code"] = $traycomp->code;

    $url = $traycomp->url . "/auth/";
    //echo $url;
    ob_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_exec($ch);

    // JSON de retorno  
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    ob_end_clean();
    curl_close($ch);
    $traycomp->refresh_token = $resposta->refresh_token;
    $traycomp->access_token = $resposta->access_token;
    $traycomp->AtualizarToken();
    
?>


