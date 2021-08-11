<?php
    $params["access_token"] = "APP_ID-1813-b4969707d7778d808b0178cd18771142971f63b0d2deaa9daef8cf50d675a578";
    $params["price_range"] = "5.00,900,00";

    $url = "https://www.loja.joia1958.com.br/web_api/products/?".http_build_query($params);

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
        foreach ($resposta as $arraylinha)
        {
            print_r($arraylinha);
            echo "<br>";
            
            
        }
    }else{
        //Tratamento das mensagens de erro
    }
?>
