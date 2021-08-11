<?php    
    
    function enviaWhatsapp($idproduto, $celular, $pedido,$link)
    {  

    $qryBigInfo = "SET SQL_BIG_SELECTS = 1";  

    $qry = " SELECT pp.idpedido,
                    pp.idproduto, 
                    p.referencia, 
                    p.produto, 
                    p.preco, 
                    pe.total, 
                    pe.idpedidostatus, 
                    pe.formapagamento,
                    pe.metodoentrega,
                    p.foto   
    FROM `pedidoproduto`pp
    INNER JOIN produto p ON p.codigoproduto = pp.idproduto
    INNER JOIN pedido pe ON pe.codigopedido = pp.idpedido
    WHERE pp.idpedido = $pedido
    and pp.idproduto = $idproduto";  

    echo $qry;            

    mysqli_query($link, $qryBigInfo);    
    $dadosdobanco = mysqli_query($link, $qry);  
    $contador = 0;

    while($dadosproduto = mysqli_fetch_array($dadosdobanco,MYSQLI_ASSOC))
    {    


        $idpedido       = $dadosproduto["idpedido"];
        $idproduto     = $dadosproduto['idproduto']; 
        $referencia     = $dadosproduto['referencia']; 
        $produto        = $dadosproduto['produto']; 
        $preco          = $dadosproduto['preco'];   
        $total          = $dadosproduto['total'];   
        $idpedidostatus = $dadosproduto['idpedidostatus'];   
        $formapagamento = $dadosproduto['formapagamento'];     
        $metodoentrega  = $dadosproduto['metodoentrega'];               
        $imagem  = $dadosproduto['foto'];      
 
        $linkproduto = "https://www.orit.com.br/loja/produto.php?loja=765915&IdProd=86&iniSession=1&601dc6f10c24f";  
        $templateid = "1bcda99e-005b-494b-8be1-e8c26e405f2c"; 
        //$mens = "Pedido: ".$idpedido."\\n Código do produto: ".$referencia."\\n Produto: ".$produto."\\n \\n Preço: ".$preco."\\n Valor total do pedido: ".$total."\\n \\n Status: ".$idpedidostatus."\\n Forma de pagamento: ".$formapagamento."\\n Entrega: ".$metodoentrega.""; 
        //$texto = "{\n  \"from\": \"orit\",\n  \"to\": \"55".$celular."\",\n  \"contents\": [{\n    \"type\": \"text\",\n    \"text\": \" $mens. \"\n  }]\n}";
        $texto = "{\n  \"from\": \"orit\",\n  \"to\": \"55".$celular."\",\"contents\": [{    \"type\": \"template\",    \"templateId\": \"1bcda99e-005b-494b-8be1-e8c26e405f2c\",\"fields\":{\"idpedido\":\"$idpedido\" , \"referencia\":\"$referencia\",  \"produto\":\"$produto\", \"preco\":\"$preco\", \"total\":\"$total\", \"idpedidostatus\":\"$idpedidostatus\", \"formapagamento\":\"$formapagamento\",   \"metodoentrega\":\"$metodoentrega\", \"imagem\":\"$imagem\",   \"linkproduto\":\"$linkproduto\"  }}]}"; 
        echo $texto;
        echo "<br><br>";
        // ZENVIA WHATSAPP 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zenvia.com/v1/channels/whatsapp/messages'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $texto);
        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Api-Token: INsQ6LbvpKcGM1Ice7O58VZVUqcX1uwYhXo4';   
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        echo "<br><br>";
        print_r($headers);  
        echo "<br><br>";

        print_r($result);  
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }  


        curl_close($ch);   


    }  

}

 



function mudancaStatus($idproduto, $celular, $pedido,$link)
{  

    $qryBigInfo = "SET SQL_BIG_SELECTS = 1";  

    $qry = " SELECT pp.idpedido,
                    pp.idproduto, 
                    p.referencia, 
                    p.produto, 
                    p.preco, 
                    pe.total, 
                    pe.idpedidostatus, 
                    pe.formapagamento,
                    pe.metodoentrega,
                    pp.status,
                    p.foto   
    FROM `pedidoproduto`pp 
    INNER JOIN produto p ON p.codigoproduto = pp.idproduto
    INNER JOIN pedido pe ON pe.codigopedido = pp.idpedido
    WHERE pp.idpedido = {$pedido}
    AND pp.idproduto = {$idproduto}"; 

    echo $qry;            

    mysqli_query($link, $qryBigInfo);    
    $dadosdobanco = mysqli_query($link, $qry);  
    $contador = 0;

    while($dadosproduto = mysqli_fetch_array($dadosdobanco,MYSQLI_ASSOC))
    {    

        $idpedido       = $dadosproduto["idpedido"];
        $idproduto     = $dadosproduto['idproduto']; 
        $referencia     = $dadosproduto['referencia']; 
        $produto        = $dadosproduto['produto']; 
        $preco          = $dadosproduto['preco'];   
        $status          = $dadosproduto['status'];   
        $total          = $dadosproduto['total'];   
        $idpedidostatus = $dadosproduto['idpedidostatus'];   
        $formapagamento = $dadosproduto['formapagamento'];    
        $metodoentrega  = $dadosproduto['metodoentrega'];               
        $imagem  = $dadosproduto['foto'];      

        $linkproduto = "https://www.orit.com.br/loja/produto.php?loja=765915&IdProd=86&iniSession=1&601dc6f10c24f";   
        $templateid = "edfa5a29-e0f6-49cb-bf64-55e634a8dd73"; 
        //$mens = "Pedido: ".$idpedido."\\n Código do produto: ".$referencia."\\n Produto: ".$produto."\\n \\n Preço: ".$preco."\\n Valor total do pedido: ".$total."\\n \\n Status: ".$idpedidostatus."\\n Forma de pagamento: ".$formapagamento."\\n Entrega: ".$metodoentrega.""; 
        //$texto = "{\n  \"from\": \"orit\",\n  \"to\": \"55".$celular."\",\n  \"contents\": [{\n    \"type\": \"text\",\n    \"text\": \" $mens. \"\n  }]\n}";
        $texto = "{\n  \"from\": \"orit\",\n  \"to\": \"55".$celular."\",\"contents\": [{    \"type\": \"template\",    \"templateId\": \"edfa5a29-e0f6-49cb-bf64-55e634a8dd73\",\"fields\":{\"idpedidostatus\":\"$status\", \"idpedido\":\"$idpedido\" , \"referencia\":\"$referencia\",  \"produto\":\"$produto\", \"preco\":\"$preco\", \"total\":\"$total\", \"formapagamento\":\"$formapagamento\",   \"metodoentrega\":\"$metodoentrega\", \"imagem\":\"$imagem\" }}]}"; 
        // echo $texto;
        // echo "<br><br>";
        // ZENVIA WHATSAPP 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zenvia.com/v1/channels/whatsapp/messages'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $texto);
        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Api-Token: VAX9hotCTE37KxuApbr9Qzj6z3-bUaeHG_DP';    
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        // echo "<br><br>";
        // print_r($headers);  
        // echo "<br><br>";
        echo "<br><br> resultado do lado: ";
        print_r($result);  
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }  
 

        curl_close($ch);   


    }  

}   


// $produtosvendidos = implode(', ',$novoArray); 
// $referenciavendidos = implode(', ',$referenciaArray);  



 


?>