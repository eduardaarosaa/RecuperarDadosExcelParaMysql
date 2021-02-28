<?php

  //Criar conexão com o banco de dados
  // Conecta-se ao banco de dados MySQL
    $mysqli = new mysqli($host = $servidor, $username = $usuario, $passwd = $senha, $dbname = $banco);

  //ARQUIVO DEVE ESTAR NO PROJETO - ARQUIVO .CSV
  $filename = 'excel/dados.csv';
  if (($handle    =   fopen($filename, "r")) !== FALSE) {
    $n          =   1;
    while (($row    =   fgetcsv($handle, 10000, ";")) !== FALSE){
       
        if($n>1){
       

          $agencia = str_replace(";", "", $row[0]);
          $descricao = str_replace(";", "", $row[1]);
          $nroContrato = str_replace(";", "", $row[2]);
          $periodo = str_replace(";", "", $row[3]);
          $documentoSD = str_replace(";", "", $row[4]);
          $dataRetirada = str_replace(";", "", $row[5]);
          $dataDevolucao = str_replace(";", "", $row[6]);
          $nomeFirma = str_replace(";", "", $row[7]);
          $baseCalculo = str_replace(";", "", $row[8]);
          $comissao = str_replace(";", "", $row[9]);
          $moeda = str_replace(";", "", $row[10]);
          $vencimento = str_replace(";", "", $row[11]);
          $docCompra = str_replace(";", "", $row[13]);
          $nomeCliente = str_replace(";", "", $row[23]);
          $voucher = str_replace(";", "", $row[24]);

          $formateVencimento = date("Y/m/d", strtotime($vencimento));
          $formateRetirada = date("Y/m/d", strtotime($dataRetirada));
          $formateDevolucao = date("Y/m/d", strtotime($dataDevolucao));
          $formateCompra = date("Y/m/d", strtotime($docCompra));
    
          //Validando o campo data - Vencimento
          if($vencimento == ''){
            $formateVencimento = '';
          }else{
            $formateVencimento = date("Y/m/d", strtotime($vencimento));
          }
          
          //Validando o campo Data Retirada
          if($dataRetirada == ''){
            $formateRetirada = '';
          }else{
            $formateRetirada = date("Y/m/d", strtotime($dataRetirada));
          }
    
          //Validando o campo Data Devolução
    
          if($dataDevolucao == ''){
            $formateDevolucao = '';
          }else{
            $formateDevolucao = date("Y/m/d", strtotime($dataDevolucao));
          }
    
          //Validando o campo data - DocCompra 
       
          if($docCompra == ''){
            $formateCompra = date("0000/00/00");
          }else{
            $formateCompra = date("Y/m/d", strtotime($docCompra));
          }

  
    
          $resultInsert = "Insert into Dados (AgenciaID,DescricaoAgencia,
          Voucher,NomeCliente,NroContrato,Periodo,DocSD,DataRetirada,DataDevolucao,NomeEmpresa,
          BaseCalculo,Comissao,Moeda,Vencimento,DocCompra)
          values('$agencia','$descricao','$voucher','$nomeCliente','$nroContrato',
          '$periodo','$documentoSD','$formateRetirada','$formateDevolucao','$nomeFirma',
          '$baseCalculo','$comissao','$moeda','$formateVencimento','$formateCompra')";
    
         $result = $mysqli->query($resultInsert);
        }
       
        $n++;
    }
    fclose($handle);
}
