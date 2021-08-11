<?php
    set_time_limit(99999999);
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/pedido.php");
    include("../componentes/pedidoproduto.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $pedidocomp = new Pedido();
    $pedidocomp->link = $link;

    $ppcomp = new PedidoProduto();
    $ppcomp->link = $link;
    

    $params["access_token"] = $traycomp->access_token;
    $params["price_range"] = "0";
    $params["page"] = "1";
    $params["sort"] = "id_desc";   

    $url = $traycomp->url . "/orders/?".http_build_query($params);

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
    
    //echo $code;
    if($code == "200")
    {
        $count = 1;
        $count2 = 1;
        $total = 0;
        $page = 0;
        $offset = 0;
        $limit = 0;
        $maxLimit = 0;
        $limiteregistros = 1;

        //print_r($resposta);
        //exit;
        foreach ($resposta as $arraylinha)
        {
            if($count == 1)
            {
                //print_r($arraylinha);
                //echo "<br><br>";
                $totallinhas = $arraylinha->total;
                $page = $arraylinha->page;
                $offset = $arraylinha->offset;
                $limit = $arraylinha->limit;
                $maxLimit = $arraylinha->maxLimit;
                $totaldepaginas = ceil($totallinhas / $limit);
                //echo $totaldepaginas;
            }
            if($count == 5)
            {
                for($pagina = 1; $pagina <= $totaldepaginas;$pagina++)
                {
                    if($pagina == 1)
                    {
                        for($i=0;$i<$limit;$i++)
                        {
                             
                            
                            $idpedidostatus = $arraylinha[$i]->Order->status;
                            $codigopedido = $arraylinha[$i]->Order->id;
                            $data = $arraylinha[$i]->Order->date;
                            $codigocliente = $arraylinha[$i]->Order->customer_id;
                            $valorparcial = $arraylinha[$i]->Order->partial_total;
                            $taxas = $arraylinha[$i]->Order->taxes;
                            $desconto = $arraylinha[$i]->Order->discount;
                            $pontodevenda = $arraylinha[$i]->Order->point_sale;
                            $metodoentrega = $arraylinha[$i]->Order->shipment;
                            $valorfrete = $arraylinha[$i]->Order->shipment_value;
                            $dataentrega = $arraylinha[$i]->Order->shipment_date;
                            $cupomdesconto = $arraylinha[$i]->Order->discount_coupon;
                            $taxadopagamento = $arraylinha[$i]->Order->payment_method_rate;
                            $valor = $arraylinha[$i]->Order->value_1;
                            $formapagamento = $arraylinha[$i]->Order->payment_form;
                            $codigoenviado = $arraylinha[$i]->Order->sending_code;
                            $idsessao = $arraylinha[$i]->Order->session_id;
                            $total = $arraylinha[$i]->Order->total;
                            $datapagamento = $arraylinha[$i]->Order->payment_date;
                            $codigoacesso = $arraylinha[$i]->Order->access_code;
                            $integradorremessa = $arraylinha[$i]->Order->shipment_integrator;
                            $datamodificacao = $arraylinha[$i]->Order->modified;
                            $idcotacao = $arraylinha[$i]->Order->id_quotation;
                            $dataestimadaentrega = $arraylinha[$i]->Order->estimated_delivery_date;
                            $codigoexterno = $arraylinha[$i]->Order->external_code;
                            $totalcomissao = $arraylinha[$i]->Order->total_comission_user;
                            $rastreavel = $arraylinha[$i]->Order->is_traceable;
                            
                            //print_r($arraylinha[$i]->Order);
                            //echo "<br><br>";
                            
                            

                            $params["access_token"] = $traycomp->access_token;
                            $params["price_range"] = "0";
                            $params["page"] = "1";
                        
                            $urlpedido = $traycomp->url . "/orders/" . $codigopedido . "/complete?".http_build_query($params);
                        
                            ob_start();
                        
                            $chpedido = curl_init();
                            curl_setopt($chpedido, CURLOPT_URL, $urlpedido);
                            curl_setopt($chpedido, CURLOPT_CUSTOMREQUEST, "GET");
                            curl_exec($chpedido);
                        
                            // JSON de retorno  
                            $respostapedido = json_decode(ob_get_contents());
                            $codepedido = curl_getinfo($chpedido, CURLINFO_HTTP_CODE);
                        
                            ob_end_clean();
                            curl_close($chpedido);
                            $arrayproduto = $respostapedido->Order->ProductsSold;
                            $desconto = isset($respostapedido->Order->coupon->discount) ? $respostapedido->Order->coupon->discount : 0;
                            
                            $pedidocomp->codigopedido = $codigopedido;
                            $pedidocomp->idpedidostatus = $idpedidostatus;
                            $ppcomp->idpedidostatus = $idpedidostatus;
                            $pedidocomp->data = $data;
                            $pedidocomp->codigocliente = $codigocliente;
                            $pedidocomp->valorparcial = $valorparcial;
                            $pedidocomp->taxas = $taxas;
                            $pedidocomp->desconto = $desconto;
                            $pedidocomp->pontodevenda = $pontodevenda;
                            $pedidocomp->metodoentrega = $metodoentrega;
                            $pedidocomp->valorfrete = $valorfrete;
                            $pedidocomp->dataentrega = $dataentrega;
                            $pedidocomp->cupomdesconto = $cupomdesconto;
                            $pedidocomp->taxadopagamento = $taxadopagamento;
                            $pedidocomp->valor = $valor;
                            $pedidocomp->formapagamento = $formapagamento;
                            $pedidocomp->codigoenviado = $codigoenviado;
                            $pedidocomp->idsessao = $idsessao;
                            $pedidocomp->total = $total;
                            $pedidocomp->datapagamento = $datapagamento;
                            $pedidocomp->codigoacesso = $codigoacesso;
                            $pedidocomp->integradorremessa = $integradorremessa;
                            $pedidocomp->datamodificacao = $datamodificacao;
                            $pedidocomp->idcotacao = $idcotacao;

                            $pedidocomp->dataestimadaentrega = $dataestimadaentrega;
                            $pedidocomp->codigoexterno = $codigoexterno;
                            $pedidocomp->totalcomissao = $totalcomissao;
                            $pedidocomp->rastreavel = $rastreavel;
                            $pedidocomp->ValidaInsercaoPedido();
                            $limiteregistros++;
                            
                            foreach ($arrayproduto as $linhaproduto)
                            {
                                //print_r($linhaproduto); 
                                $ppcomp->idpedido =$linhaproduto->ProductsSold->order_id;
                                $ppcomp->idproduto = $linhaproduto->ProductsSold->product_id; 
                                $ppcomp->ValidaInsercaoPedidoProduto(); 
                            }
                            

                            if($limiteregistros > $totallinhas)
                            {
                                break;
                            }
                        }
                    }
                    else
                    {
                        $params["page"] = $pagina;
                        $url = $traycomp->url . "/orders/?".http_build_query($params);
                        //echo $url;
                        ob_start();

                        $ch2 = curl_init();
                        curl_setopt($ch2, CURLOPT_URL, $url);
                        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");
                        curl_exec($ch2);

                        // JSON de retorno 
                        $code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                        $resposta2 = json_decode(ob_get_contents());
                        ob_end_clean();
                        curl_close($ch2);
                        $count2 = 1;
                        foreach ($resposta2 as $arraylinha2)
                        {
                            
                            if($count2 == 1)
                            {
                                /*
                                echo "pagina: " . $pagina . "<br>";
                                print_r($arraylinha2);
                                echo "<br><br>";
                                */
                                $totallinhas2 = $arraylinha2->total;
                                $page2 = $arraylinha2->page;
                                $offset2 = $arraylinha2->offset;
                                $limit2 = $arraylinha2->limit;
                                $maxLimit2 = $arraylinha2->maxLimit;
                                $totaldepaginas2 = ceil($totallinhas2 / $limit2);
                                
                            }

                            if($count2 == 5)
                            {
                                //echo $limit2;
                                for($i2=0;$i2<$limit2;$i2++)
                                {
                                    
                                    $idpedidostatus = $arraylinha2[$i2]->Order->status;
                                    $codigopedido = $arraylinha2[$i2]->Order->id;
                                    $data = $arraylinha2[$i2]->Order->date;
                                    $codigocliente = $arraylinha2[$i2]->Order->customer_id;
                                    $valorparcial = $arraylinha2[$i2]->Order->partial_total;
                                    $taxas = $arraylinha2[$i2]->Order->taxes;
                                    $desconto = $arraylinha2[$i2]->Order->discount;
                                    $pontodevenda = $arraylinha2[$i2]->Order->point_sale;
                                    $metodoentrega = $arraylinha2[$i2]->Order->shipment;
                                    $valorfrete = $arraylinha2[$i2]->Order->shipment_value;
                                    $dataentrega = $arraylinha2[$i2]->Order->shipment_date;
                                    $cupomdesconto = $arraylinha2[$i2]->Order->discount_coupon;
                                    $taxadopagamento = $arraylinha2[$i2]->Order->payment_method_rate;
                                    $valor = $arraylinha2[$i2]->Order->value_1;
                                    $formapagamento = $arraylinha2[$i2]->Order->payment_form;
                                    $codigoenviado = $arraylinha2[$i2]->Order->sending_code;
                                    $idsessao = $arraylinha2[$i2]->Order->session_id;
                                    $total = $arraylinha2[$i2]->Order->total;
                                    $datapagamento = $arraylinha2[$i2]->Order->payment_date;
                                    $codigoacesso = $arraylinha2[$i2]->Order->access_code;
                                    $integradorremessa = $arraylinha2[$i2]->Order->shipment_integrator;
                                    $datamodificacao = $arraylinha2[$i2]->Order->modified;
                                    $idcotacao = $arraylinha2[$i2]->Order->id_quotation;
                                    $dataestimadaentrega = $arraylinha2[$i2]->Order->estimated_delivery_date;
                                    $codigoexterno = $arraylinha2[$i2]->Order->external_code;
                                    $totalcomissao = $arraylinha2[$i2]->Order->total_comission_user;
                                    $rastreavel = $arraylinha2[$i2]->Order->is_traceable;
                                    
                                    
                                    $arrayproduto = $arraylinha2[$i2]->Order->ProductsSold;
                                    $desconto = isset($respostapedido->Order->coupon->discount) ? $respostapedido->Order->coupon->discount : 0;
                                    
                                    $pedidocomp->codigopedido = $codigopedido;
                                    $pedidocomp->idpedidostatus = $idpedidostatus;
                                    $ppcomp->idpedidostatus = $idpedidostatus;
                                    $pedidocomp->data = $data;
                                    $pedidocomp->codigocliente = $codigocliente;
                                    $pedidocomp->valorparcial = $valorparcial;
                                    $pedidocomp->taxas = $taxas;
                                    $pedidocomp->desconto = $desconto;
                                    $pedidocomp->pontodevenda = $pontodevenda;
                                    $pedidocomp->metodoentrega = $metodoentrega;
                                    $pedidocomp->valorfrete = $valorfrete;
                                    $pedidocomp->dataentrega = $dataentrega;
                                    $pedidocomp->cupomdesconto = $cupomdesconto;
                                    $pedidocomp->taxadopagamento = $taxadopagamento;
                                    $pedidocomp->valor = $valor;
                                    $pedidocomp->formapagamento = $formapagamento;
                                    $pedidocomp->codigoenviado = $codigoenviado;
                                    $pedidocomp->idsessao = $idsessao;
                                    $pedidocomp->total = $total;
                                    $pedidocomp->datapagamento = $datapagamento;
                                    $pedidocomp->codigoacesso = $codigoacesso;
                                    $pedidocomp->integradorremessa = $integradorremessa;
                                    $pedidocomp->datamodificacao = $datamodificacao;
                                    $pedidocomp->idcotacao = $idcotacao;
                                    $pedidocomp->dataestimadaentrega = $dataestimadaentrega;
                                    $pedidocomp->codigoexterno = $codigoexterno;
                                    $pedidocomp->totalcomissao = $totalcomissao;
                                    $pedidocomp->rastreavel = $rastreavel;
                                    $pedidocomp->ValidaInsercaoPedido();
                                    $limiteregistros++;
                                    
                                    $urlpedido = $traycomp->url . "/orders/" . $codigopedido . "/complete?".http_build_query($params);
                        
                                    ob_start();
                                
                                    $chpedido = curl_init();
                                    curl_setopt($chpedido, CURLOPT_URL, $urlpedido);
                                    curl_setopt($chpedido, CURLOPT_CUSTOMREQUEST, "GET");
                                    curl_exec($chpedido);
                                
                                    // JSON de retorno  
                                    $respostapedido = json_decode(ob_get_contents());
                                    $codepedido = curl_getinfo($chpedido, CURLINFO_HTTP_CODE);
                                
                                    ob_end_clean();
                                    curl_close($chpedido);
                                    $arrayproduto = $respostapedido->Order->ProductsSold;
                                    //print_r($arrayproduto);
                                    //echo "<br><br>";
                                    
                                    //print_r($arrayproduto);
                                    //echo "<br><br>";
                                    
                                    foreach ($arrayproduto as $linhaproduto)
                                    {
                                        //print_r($linhaproduto->id);
                                        $ppcomp->idpedido =$linhaproduto->ProductsSold->order_id;
                                        $ppcomp->idproduto = $linhaproduto->ProductsSold->product_id; 
                                        $ppcomp->ValidaInsercaoPedidoProduto();
                                    }
                                    //echo "<br><br>";
                                    if($limiteregistros > $totallinhas)
                                    {
                                        break;
                                    }
                                }
                            }
                            $count2++;
                        }
                    }
                    
                }
                
            
                
            }
            $count++;
            //print_r($arraylinha);
            //echo "<br><br>";
        }
    }else{
        //Tratamento das mensagens de erro
    }
?>
