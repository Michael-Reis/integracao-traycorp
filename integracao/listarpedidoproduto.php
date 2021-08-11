<?php
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/listarpedido.php"); 
    include("../componentes/produtopedido.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();  

    $traypedidos = new Pedidoslistagem();   
    $traypedidos->link = $link;
    $traypedidoslistar = $traypedidos->GetAll(); 

    $pedidoprodutocomp = new pedidoProduto();
    $pedidoprodutocomp->link = $link;

    while($dp = mysqli_fetch_array($traypedidoslistar,MYSQLI_ASSOC))
    {
      // echo $dp["codigopedido"] . "<br<br>";  
      $params["access_token"] = $traycomp->access_token;

      $url = $traycomp->url . "/orders/" . $dp["codigopedido"] ."/complete"."?".http_build_query($params);
      
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
      if($code == "200")
      { 

        foreach ($resposta->Order->ProductsSold as $arraylinha)
        {

          //echo"Código do pedido"; print_r($resposta->Order->id);
          //echo"<br>";
          //print_r($arraylinha->ProductsSold->product_id);
          //echo"<br>";
          //print_r($resposta->Order->status);
          //echo"<br><br>";                 
          $pedidoprodutocomp->codigopedido = $resposta->Order->id;
          $pedidoprodutocomp->codigoproduto = $arraylinha->ProductsSold->product_id;
          $pedidoprodutocomp->status = $resposta->Order->status;
          $pedidoprodutocomp->ValidaInsercaoPedidoProduto(); 
        }    

      }else{
        echo "teste";
      }
    }

    
?>  

