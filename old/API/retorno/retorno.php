<?php
    function EnviaEmail($to,$subj,$emailremetente,$nome,$corpo,$bcc = '',$cc = '')
    {
        // construção do cabecalho
        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset='UTF-8'\n";
        $headers .= "From: ".$nome." <".$emailremetente.">\n";
    
        if(strlen($cc) > 0)
        {
            $headers .= "Cc: $cc\r\n";
        }
    
        if(strlen($bcc) > 0)
        {
            $headers .= "Bcc: $bcc\r\n";
        }
        $headers .= "Return-Path: <$emailremetente>\n";
        $headers .= "Reply-to: $nome <$emailremetente>\n";
        $headers .= "X-Priority: 1\n"; 
        
        if(mail($to,$subj,$corpo,$headers)){  // enviando o email

        }else{
            echo "Ocorreu um erro ao tentar enviar o email";
        }
    }
    $corpo = "POST: " . implode(",", $_POST) . "<br>";
    $corpo .= "GET: " . implode(",", $_GET) . "<br>";
    $corpo .= "BODY" . file_get_contents('php://input');
    /*
    $cont = 0;
    foreach($_POST as $result) {
        $corpo .= $result[$cont].'<br>';
        $cont++;
    }
    */
    EnviaEmail( /* $to = "mauromouraloureiro@gmail.com",
                $subj = "Dados retorno",
                $emailremetente = "noreply@joia1958.com.br",
                $nome = "Tray",
                $corpo = $corpo,
                $bcc = '',
                $cc = '');
 */
?>