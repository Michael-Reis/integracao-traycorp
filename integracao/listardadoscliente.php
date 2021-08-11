<?php
    include("../conexao.php");
    include("../componentes/tray.php");
    include("../componentes/cliente.php");
    include("../componentes/clientedetalhe.php");

    $traycomp = new Tray();
    $traycomp->link = $link;
    $traycomp->DadosTray();

    $clientecomp = new Cliente();
    $clientecomp->link = $link;

    
    $clientedetalhecomp = new Clientedetalhe();
    $clientedetalhecomp->link = $link; 

    $params["access_token"] = $traycomp->access_token;
    $params["page"] = "1";

    $url = $traycomp->url . "/customers/?".http_build_query($params);

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
                            
                            $codigocontas = $arraylinha[$i]->Customer->id;  
                            $clientecomp->cliente = $arraylinha[$i]->Customer->name;
                            $clientecomp->codigocliente = $arraylinha[$i]->Customer->id;
                            //$codigocliente = $arraylinha[$i]->Customer->id;
                            $clientecomp->cnpj = $arraylinha[$i]->Customer->cnpj;
                            $clientecomp->datacriacao = $arraylinha[$i]->Customer->created;
                            $clientecomp->dataregistro = $arraylinha[$i]->Customer->registration_date;
                            $clientecomp->cpf = $arraylinha[$i]->Customer->cpf;
                            $clientecomp->datanascimento = $arraylinha[$i]->Customer->birth_date;
                            $clientecomp->genero = $arraylinha[$i]->Customer->gender;
                            $clientecomp->email = $arraylinha[$i]->Customer->email;
                            $clientecomp->desconto = $arraylinha[$i]->Customer->discount;
                            $clientecomp->ultimavisita = $arraylinha[$i]->Customer->last_visit;
                            $clientecomp->cidade = $arraylinha[$i]->Customer->city;
                            $clientecomp->uf = $arraylinha[$i]->Customer->state;
                            $clientecomp->newsletter = $arraylinha[$i]->Customer->newsletter;
                            $clientecomp->datamodificacao = $arraylinha[$i]->Customer->modified;
                            $clientecomp->ValidaInsercaoCliente();
                           
                            $parametro["access_token"] = $traycomp->access_token;
                            $urldetalhecliente = $traycomp->url . "/customers/${codigocontas}" . "?" . http_build_query($parametro);
                            //echo $urldetalhecliente;
                            ob_start();
 
                            $chcliente = curl_init();
                            curl_setopt($chcliente, CURLOPT_URL, $urldetalhecliente);
                            curl_setopt($chcliente, CURLOPT_CUSTOMREQUEST, "GET");
                            curl_exec($chcliente); 
                         
                            // JSON de retorno  
                            $responseclient = json_decode(ob_get_contents()); 
                            ob_end_clean();
                            curl_close($chcliente); 

                            $clientedetalhecomp->codigocliente = $arraylinha[$i]->Customer->id;    
                            $clientedetalhecomp->cnpj = $responseclient->Customer->cnpj;
                            $clientedetalhecomp->newsletter = $responseclient->Customer->newsletter;
                            $clientedetalhecomp->created = $responseclient->Customer->created;
                            $clientedetalhecomp->terms = $responseclient->Customer->terms;
                            $clientedetalhecomp->id = $responseclient->Customer->id;
                            $clientedetalhecomp->name = $responseclient->Customer->name;
                            $clientedetalhecomp->registration_date = $responseclient->Customer->registration_date;
                            $clientedetalhecomp->rg = $responseclient->Customer->rg;
                            $clientedetalhecomp->cpf = $responseclient->Customer->cpf;
                            $clientedetalhecomp->phone = $responseclient->Customer->phone;
                            $clientedetalhecomp->cellphone = $responseclient->Customer->cellphone;
                            $clientedetalhecomp->birth_date = $responseclient->Customer->birth_date;
                            $clientedetalhecomp->gender = $responseclient->Customer->gender;
                            $clientedetalhecomp->email = $responseclient->Customer->email;
                            $clientedetalhecomp->nickname = $responseclient->Customer->nickname;
                            $clientedetalhecomp->token = $responseclient->Customer->token;
                            $clientedetalhecomp->total_orders = $responseclient->Customer->total_orders;
                            $clientedetalhecomp->observation = $responseclient->Customer->observation;
                            $clientedetalhecomp->type = $responseclient->Customer->type;
                            $clientedetalhecomp->company_name = $responseclient->Customer->company_name;
                            $clientedetalhecomp->state_inscription = $responseclient->Customer->state_inscription;
                            $clientedetalhecomp->reseller = $responseclient->Customer->reseller;
                            $clientedetalhecomp->discount = $responseclient->Customer->discount;
                            $clientedetalhecomp->blocked = $responseclient->Customer->blocked;
                            $clientedetalhecomp->credit_limit = $responseclient->Customer->credit_limit;
                            $clientedetalhecomp->indicator_id = $responseclient->Customer->indicator_id;
                            $clientedetalhecomp->profile_customer_id = $responseclient->Customer->profile_customer_id;
                            $clientedetalhecomp->last_sending_newsletter = $responseclient->Customer->last_sending_newsletter;
                            $clientedetalhecomp->last_purchase = $responseclient->Customer->last_purchase;
                            $clientedetalhecomp->last_visit = $responseclient->Customer->last_visit;
                            $clientedetalhecomp->last_modification = $responseclient->Customer->last_modification;
                            $clientedetalhecomp->address = $responseclient->Customer->address;
                            $clientedetalhecomp->zip_code = $responseclient->Customer->zip_code;
                            $clientedetalhecomp->number = $responseclient->Customer->number;
                            $clientedetalhecomp->complement = $responseclient->Customer->complement;
                            $clientedetalhecomp->neighborhood = $responseclient->Customer->neighborhood;
                            $clientedetalhecomp->city = $responseclient->Customer->city;
                            $clientedetalhecomp->state = $responseclient->Customer->state;
                            $clientedetalhecomp->country = $responseclient->Customer->country;
                            //echo "<br><br>state: ". $responseclient->Customer->state . "<br><br>";  
                            $clientedetalhecomp->modified = $responseclient->Customer->modified;
                            $clientedetalhecomp->insertClienteDetalhe(); 
                             
                            
                            $limiteregistros++;
                            if($limiteregistros > $totallinhas)
                            {
                                break;
                            }
                              
                  
                            
                        }
                    }
                    else
                    {
                        $params["page"] = $pagina;
                        $url = $traycomp->url . "/customers/?".http_build_query($params);
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
                                   
                                    // echo "<br><br>";
                                    // echo "linha 2 <br>";
                                    // print_r($arraylinha2[$i2]);
                                    

                                    $codconta =  $arraylinha2[$i2]->Customer->id;  
                                    $clientecomp->cliente = $arraylinha2[$i2]->Customer->name;
                                    $clientecomp->codigocliente = $arraylinha2[$i2]->Customer->id;
                                    $clientecomp->cnpj = $arraylinha2[$i2]->Customer->cnpj;
                                    $clientecomp->datacriacao = $arraylinha2[$i2]->Customer->created;
                                    $clientecomp->dataregistro = $arraylinha2[$i2]->Customer->registration_date;
                                    $clientecomp->cpf = $arraylinha2[$i2]->Customer->cpf;
                                    $clientecomp->datanascimento = $arraylinha2[$i2]->Customer->birth_date;
                                    $clientecomp->genero = $arraylinha2[$i2]->Customer->gender;
                                    $clientecomp->email = $arraylinha2[$i2]->Customer->email;
                                    $clientecomp->desconto = $arraylinha2[$i2]->Customer->discount;
                                    $clientecomp->ultimavisita = $arraylinha2[$i2]->Customer->last_visit;
                                    $clientecomp->cidade = $arraylinha2[$i2]->Customer->city;
                                    $clientecomp->uf = $arraylinha2[$i2]->Customer->state;
                                    $clientecomp->newsletter = $arraylinha2[$i2]->Customer->newsletter;
                                    $clientecomp->datamodificacao = $arraylinha2[$i2]->Customer->modified;
                                    $clientecomp->ValidaInsercaoCliente();

                                    $parametro["access_token"] = $traycomp->access_token;
                                    $urldetalhecliente2 = $traycomp->url . "/customers/" . $codconta . "?" . http_build_query($parametro);
                                    ob_start();
         
                                    $chcliente2 = curl_init();
                                    curl_setopt($chcliente2, CURLOPT_URL, $urldetalhecliente2);
                                    curl_setopt($chcliente2, CURLOPT_CUSTOMREQUEST, "GET");
                                    curl_exec($chcliente2); 
                                 
                                    // JSON de retorno  
                                    $responseclientes = json_decode(ob_get_contents());
                                    ob_end_clean();
                                    curl_close($chcliente2);
          
                                    //print_r($responseclient);
                                    $clientedetalhecomp->codigocliente = $responseclientes->Customer->id;    
                                    $clientedetalhecomp->cnpj = $responseclientes->Customer->cnpj;
                                    $clientedetalhecomp->newsletter = $responseclientes->Customer->newsletter;
                                    $clientedetalhecomp->created = $responseclientes->Customer->created;
                                    $clientedetalhecomp->terms = $responseclientes->Customer->terms;
                                    $clientedetalhecomp->id = $responseclientes->Customer->id;
                                    $clientedetalhecomp->name = $responseclientes->Customer->name;
                                    $clientedetalhecomp->registration_date = $responseclientes->Customer->registration_date;
                                    $clientedetalhecomp->rg = $responseclientes->Customer->rg;
                                    $clientedetalhecomp->cpf = $responseclientes->Customer->cpf;
                                    $clientedetalhecomp->phone = $responseclientes->Customer->phone;
                                    $clientedetalhecomp->cellphone = $responseclientes->Customer->cellphone;
                                    $clientedetalhecomp->birth_date = $responseclientes->Customer->birth_date;
                                    $clientedetalhecomp->gender = $responseclientes->Customer->gender;
                                    $clientedetalhecomp->email = $responseclientes->Customer->email;
                                    $clientedetalhecomp->nickname = $responseclientes->Customer->nickname;
                                    $clientedetalhecomp->token = $responseclientes->Customer->token;
                                    $clientedetalhecomp->total_orders = $responseclientes->Customer->total_orders;
                                    $clientedetalhecomp->observation = $responseclientes->Customer->observation;
                                    $clientedetalhecomp->type = $responseclientes->Customer->type;
                                    $clientedetalhecomp->company_name = $responseclientes->Customer->company_name;
                                    $clientedetalhecomp->state_inscription = $responseclientes->Customer->state_inscription;
                                    $clientedetalhecomp->reseller = $responseclientes->Customer->reseller;
                                    $clientedetalhecomp->discount = $responseclientes->Customer->discount;
                                    $clientedetalhecomp->blocked = $responseclientes->Customer->blocked;
                                    $clientedetalhecomp->credit_limit = $responseclientes->Customer->credit_limit;
                                    $clientedetalhecomp->indicator_id = $responseclientes->Customer->indicator_id;
                                    $clientedetalhecomp->profile_customer_id = $responseclientes->Customer->profile_customer_id;
                                    $clientedetalhecomp->last_sending_newsletter = $responseclientes->Customer->last_sending_newsletter;
                                    $clientedetalhecomp->last_purchase = $responseclientes->Customer->last_purchase;
                                    $clientedetalhecomp->last_visit = $responseclientes->Customer->last_visit;
                                    $clientedetalhecomp->last_modification = $responseclientes->Customer->last_modification;
                                    $clientedetalhecomp->address = $responseclientes->Customer->address;
                                    $clientedetalhecomp->zip_code = $responseclientes->Customer->zip_code;
                                    $clientedetalhecomp->number = $responseclientes->Customer->number;
                                    $clientedetalhecomp->complement = $responseclientes->Customer->complement;
                                    $clientedetalhecomp->neighborhood = $responseclientes->Customer->neighborhood;
                                    $clientedetalhecomp->city = $responseclientes->Customer->city;
                                    $clientedetalhecomp->state = $responseclientes->Customer->state;
                                    $clientedetalhecomp->country = $responseclientes->Customer->country;
                                    $clientedetalhecomp->modified = $responseclientes->Customer->modified;
                                    $clientedetalhecomp->insertClienteDetalhe();   
                                    
                                    $limiteregistros++;
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
