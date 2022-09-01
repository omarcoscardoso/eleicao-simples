<?php

include("include/conecta.php");

function eleicao($id_ENQUETE){
  // NUMERO DA ENQUETE
  $sqlNenqt = "SELECT id_enquete FROM opcoes where id_enquete=$id_ENQUETE";
  $ResultNenqt = mysql_query($sqlNenqt) ;
  $Nenqt = mysql_result($ResultNenqt,0);
  // NOME DA ENQUETE
  $sqlNomEnqt = "SELECT nome_enquete FROM opcoes where id_enquete=$id_ENQUETE";
  $ResultNomEnqt = mysql_query($sqlNomEnqt);
  $nomEnquete = mysql_result($ResultNomEnqt,0);

  $enquete[$Nenqt]=array("$nomEnquete");
  //$enquete[$Nenqt]=array("$nomEnquete",array(0 => Nulo,'1','2','3','4','5'));

  return $enquete;
}

function  show_enquete($id_ENQUETE,$sessao){
  $enquete=eleicao($id_ENQUETE);
  if (!array_key_exists($id_ENQUETE,$enquete)){
     return ('O id da enquete nao se encontra disponivel');
  }else{
    $result_t= mysql_query("SELECT max(turno) FROM apuracao WHERE apuracao.id_enquete=$id_ENQUETE")or die(mysql_error());
    $opcao_t = mysql_result($result_t,0);
    if($opcao_t >= 1){
      $turno=($opcao_t+1);
    }else{
      $turno="1";
    }
			
    if(isset($_POST[opcao])) {
      $result_f= mysql_query("SELECT candidato.id_candidato 
                                FROM candidato 
                               WHERE candidato.id_candidato='$_POST[opcao]' 
                                 and candidato.id_enquete=$id_ENQUETE 
                                 and ativo='t'")or die(mysql_error());
      $opcao_f = mysql_result($result_f,0);
      $result_id= mysql_query("SELECT max(candidato.id_candidato) FROM candidato WHERE candidato.id_enquete=$id_ENQUETE and ativo='t'")or die(mysql_error());
      $opcao_id = mysql_result($result_id,0);
      if($_POST[opcao] > $opcao_id
          or $_POST[opcao] <> $opcao_f
          or $_POST[opcao] == " "
          or $_POST[opcao] == "0"
          or $_POST[opcao] == ","
          or $_POST[opcao] == "." 
          or $_POST[opcao] == "-" 
          or $_POST[opcao] == "+" 
          or $_POST[opcao] == "*" 
          or $_POST[opcao] == "/"
          or $_POST[opcao] == "") {
        $html_enquete='<font style="font-family:Arial; font-size:30px; color:red"><b>Candidato invalido!!!</b></font>';
      }else{ 
	      $cont = show_cont($id_ENQUETE,$sessao);
        $result_voto   = mysql_query("SELECT count(*) FROM votos where votos.id_enquete='$id_ENQUETE' and turno='$turno' and votos.id_opcao='$_POST[opcao]'")or die(mysql_error());
        $votos_x_opcao = mysql_result($result_voto,0);
        $votos_x_opcao = ($votos_x_opcao+1);
        $msg='<font style="font-family:Arial; font-size:30px; color:red"><b>Voc&ecirc; j&aacute; votou neste candidato!</b></font>';  

        if($cont == 1){

          //1ºTURNO  
  		    if ($turno == 1) {
  				  $ssql=mysql_query('SELECT id_opcao FROM votou where id_opcao="'.$_POST[opcao].'" and id_enquete="'.$id_ENQUETE.'" and sessao="'.$sessao.'"')or die(mysql_error());
  				  $voto=mysql_fetch_row($ssql);
  				  if ($voto[0] == $_POST[opcao]){
              $html_enquete=$msg;
  				  }else{
  				    mysql_query('INSERT INTO votos (id_enquete,id_opcao,total_votos,sessao,turno) 
                           VALUES("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.$votos_x_opcao.'","'.$sessao.'","'.$turno.'")') or die(mysql_error());
              mysql_query('INSERT INTO votou VALUES("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.($cont+1).'","'.$sessao.'")') or die(mysql_error());
              $html_enquete='<font style="font-family:Arial; font-size:30px; color:red"><strong>Vote no 2&deg; Candidato!</strong></font>';       
            }
           //2ºTURNO  ////////////////////////////////////////////////////////////////////////////////////////		
          }elseif ($turno >= 2){
            $ssql=mysql_query('SELECT id_opcao FROM votou where id_opcao="'.$_POST[opcao].'" and id_enquete="'.$id_ENQUETE.'" and sessao="'.$sessao.'"')or die(mysql_error());
            $voto=mysql_fetch_row($ssql);
  					if ($voto[0] == $_POST[opcao]){
              $html_enquete=$msg;
  					}else{
              mysql_query('INSERT INTO votos (id_enquete,id_opcao,total_votos,sessao,turno) 
                           VALUES("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.$votos_x_opcao.'","'.$sessao.'","'.$turno.'")') or die(mysql_error());
              mysql_query('DELETE FROM votou where sessao="'.$sessao.'"') or die(mysql_error());
            }
  					// registra voto
  					$sql=mysql_query('SELECT max(votos) FROM sessao where id_enquete="'.$id_ENQUETE.'" AND sessao="'.$sessao.'" AND turno="'.$turno.'"')or die(mysql_error());
  					$result=mysql_fetch_row($sql);
  					$qtvoto = $result[0]+1;
  					if ($result[0] < 1) {
  						mysql_query('INSERT INTO sessao VALUES( "'.$sessao.'" , "'.$turno.'" , "'.$qtvoto.'", "'.$id_ENQUETE.'")') or die(mysql_error());
  					}else{
  						mysql_query('UPDATE sessao SET votos = "'.$qtvoto.'" WHERE id_enquete="'.$id_ENQUETE.'" AND sessao="'.$sessao.'" AND turno="'.$turno.'" ') or die(mysql_error());	
  					}
  				  echo "<font SIZE=7 STYLE='font-size: 200pt'>FIM!</font>";
  				  echo "<script>setTimeout( function() { window.location = '?urna=".$sessao."'; }, 5000 );</script>";
  				  exit;
  	      } //FECHA 2ºTURNO ////////////////////////////////////////////////////////////////////////////////////////

        }elseif ($cont == 2){

          $ssql=mysql_query('SELECT id_opcao FROM votou where id_opcao="'.$_POST[opcao].'" and id_enquete="'.$id_ENQUETE.'" and sessao="'.$sessao.'"')or die(mysql_error());
          $voto=mysql_fetch_row($ssql);
          if ($voto[0] == $_POST[opcao]){
            $html_enquete=$msg;
          }else{
            mysql_query('INSERT INTO votos (id_enquete,id_opcao,total_votos,sessao,turno) 
                              VALUES ("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.$votos_x_opcao.'","'.$sessao.'","'.$turno.'")') or die(mysql_error());
            mysql_query('INSERT INTO votou VALUES("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.($cont+1).'","'.$sessao.'")') or die(mysql_error());
            $html_enquete='<font style="font-family:Arial; font-size:30px; color:red"><strong>Vote no 3&deg; Candidato!</strong></font>';
          }
        
        }elseif ($cont == 3){
          $ssql=mysql_query('SELECT id_opcao FROM votou where id_opcao="'.$_POST[opcao].'" and id_enquete="'.$id_ENQUETE.'" and sessao="'.$sessao.'"')or die(mysql_error());
          $voto=mysql_fetch_row($ssql);
          if ($voto[0] == $_POST[opcao]) {
            $html_enquete=$msg;
					}else{
            mysql_query('INSERT INTO votos (id_enquete,id_opcao,total_votos,sessao,turno)
                              VALUES ("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.$votos_x_opcao.'","'.$sessao.'","'.$turno.'")') or die(mysql_error());
            mysql_query('INSERT INTO votou VALUES("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.($cont+1).'","'.$sessao.'")') or die(mysql_error());
            $html_enquete='<font style="font-family:Arial; font-size:30px; color:red"><strong>Vote no 4&deg; Candidato!</strong></font>';
					}
		    
        }elseif ($cont == 4){
        
          $ssql=mysql_query('SELECT id_opcao FROM votou where id_opcao="'.$_POST[opcao].'" and id_enquete="'.$id_ENQUETE.'" and sessao="'.$sessao.'"')or die(mysql_error());
          $voto=mysql_fetch_row($ssql);
					if ($voto[0] == $_POST[opcao]){
            $html_enquete=$msg;
					}else{						
							mysql_query('INSERT INTO votos (id_enquete,id_opcao,total_votos,sessao,turno)
                                VALUES ("'.$id_ENQUETE.'","'.$_POST[opcao].'","'.$votos_x_opcao.'","'.$sessao.'","'.$turno.'")') or die(mysql_error());
							mysql_query('DELETE FROM votou where sessao="'.$sessao.'"') or die(mysql_error());
							// registra voto
							$sql=mysql_query('SELECT max(votos) FROM sessao where id_enquete="'.$id_ENQUETE.'" AND sessao="'.$sessao.'" AND turno="'.$turno.'"')or die(mysql_error());
							$result=mysql_fetch_row($sql);
							$qtvoto = $result[0]+1;
							if ($result[0] < 1) {
                mysql_query('INSERT INTO sessao VALUES( "'.$sessao.'" , "'.$turno.'" , "'.$qtvoto.'", "'.$id_ENQUETE.'")') or die(mysql_error());
							}else{
                mysql_query('UPDATE sessao SET votos = "'.$qtvoto.'" WHERE id_enquete="'.$id_ENQUETE.'" AND sessao="'.$sessao.'" AND turno="'.$turno.'" ') or die(mysql_error());	
							}
							echo "<font SIZE=7 STYLE='font-size: 200pt'>FIM!</font>";
							echo "<script>setTimeout( function() { window.location = '?urna=".$sessao."'; }, 5000 );</script>";
							exit;
          }
		    }
      }
    }
  }
// HTML da VOTAÇÃO //
$html_enquete.='<form action="'.$_SERVER[REQUEST_URI].'" method="POST"> ';
$html_enquete.='<strong>Digite o n&uacute;mero do Candidato!</strong> <br>';
$html_enquete.='<br>';
$html_enquete.='<input type="text" id="opcao" name="opcao" size="1" maxlength="2" value="" autocomplete="off" autofocus="autofocus" style="font-size:90px">';
$html_enquete.='<br>';
$html_enquete.='<br>';
$html_enquete.='<input class="botao_urna" type="submit" value="CONFIRMA" tabindex="2" >';
$html_enquete.='<br>';
$html_enquete.='<br>';
$html_enquete.='</form>';
return $html_enquete;
}

function show_cont($id_ENQUETE,$sessao){
$sqlVoto=mysql_query('SELECT votos FROM votou where votou.id_enquete="'.$id_ENQUETE.'" and votou.sessao="'.$sessao.'" order by votos desc limit 1')or die(mysql_error());
$voto=mysql_fetch_row($sqlVoto);
	      if($voto[0] <= 1){
                 $cont = 1;
        } elseif($voto[0] == 2){
                 $cont = 2;
        } elseif($voto[0] == 3){
                 $cont = 3; 
        } elseif($voto[0] == 4){
                 $cont = 4; 
        }
return $cont;
}

function show_candidato($id_ENQUETE){
$nome_eleicao = show_pergunta($id_ENQUETE);	
$html_enquete.= "<link rel='stylesheet' href='css/style.css'>";
$html_enquete.= "<h1>Candidatos: $nome_eleicao</h1>";

$select = mysql_query("SELECT * FROM candidato 
                               WHERE candidato.id_candidato > 0 
                                 and candidato.id_enquete=$id_ENQUETE 
                                 and candidato.ativo='t'
                            order by candidato.nome")or die("ERRO ao consultar ao banco de dados.");

               $html_enquete.="<table class='lista'>";
         $linha = 0;
         while($row = mysql_fetch_array($select)){
               $Cod          = $row["id_candidato"];
               $nome         = $row["nome"];
               
               if($linha % 2){ $cor = "#CCC"; }else{ $cor = "#FFF";}
               
			   $html_enquete.="<tr bgcolor='$cor' >";
               $html_enquete.="<td><b>&nbsp;<font size=5>$Cod</font>&nbsp;</b></td>";
               $html_enquete.="<td>$nome</td>";
               $html_enquete.="</tr>";   
               $linha ++;
          }
$html_enquete.="</table>";

return $html_enquete;
}

function show_eleicao(){
$html_enquete = "<link rel='stylesheet' href='css/style.css'>";
$html_enquete.= "<h1>Elei&ccedil;&atilde;o</h1>";
$select = mysql_query("SELECT * FROM opcoes order by opcoes.id_enquete")or die("ERRO ao consultar ao banco de dados.");

               $html_enquete.="<table class='lista'>";
         $linha = 0;
         while($row = mysql_fetch_array($select)){
               $Cod          = $row["id_enquete"];
               $nome         = $row["nome_enquete"];
               
               if($linha % 2){ $cor = "#CCC"; }else{ $cor = "#FFF";}
               
			   $html_enquete.="<tr bgcolor='$cor' >";
               $html_enquete.="<td align='center'><b>$Cod</b></td>";
               $html_enquete.="<td>$nome</td>";
               $html_enquete.="</tr>";   
               $linha ++;
          }
$html_enquete.="</table>";

return $html_enquete;
}

function show_urnas(){
$html_enquete = "<link rel='stylesheet' href='css/style.css'>";
$html_enquete.= "<h1>Elei&ccedil;&atilde;o</h1>";
$select = mysql_query("SELECT * FROM urnas order by urnas.sessao")or die("ERRO ao consultar ao banco de dados.");

               $html_enquete.="<table class='lista'>";
               $html_enquete.="<th>Sess&atilde;o</th>";               
               $html_enquete.="<th>IP</th>";              
         $linha = 0;
         while($row = mysql_fetch_array($select)){
               $Cod          = $row["sessao"];
               $ip           = $row["ip"];
               
               if($linha % 2){ $cor = "#CCC"; }else{ $cor = "#FFF";}
                
			   $html_enquete.="<tr bgcolor='$cor' >";
               $html_enquete.="<td align='center'><b>$Cod</b></td>";
               $html_enquete.="<td>$ip</td>";
               $html_enquete.="</tr>";   
               $linha ++;
          }
$html_enquete.="</table>";

return $html_enquete;
}

function show_pergunta($id_ENQUETE){
  $enquete=eleicao($id_ENQUETE);
  $pergunta_da_enquete = array_shift($enquete[$id_ENQUETE]);
  $ssql=mysql_query('SELECT * FROM votos WHERE votos.id_enquete="'.$id_ENQUETE.'"')or die(mysql_error());
  $total_votos=mysql_num_rows($ssql);
  $html_enquete ='<strong>'.$pergunta_da_enquete.'&nbsp;&nbsp;</strong>';

return $html_enquete;
}

function show_eleicao_atual(){	
$sql=mysql_query('SELECT * FROM opcoes WHERE opcoes.ativo="t"')or die(mysql_error());
$result=mysql_fetch_array($sql);
$sql2= mysql_query("SELECT max(turno) FROM apuracao WHERE id_enquete=$result[id_enquete]")or die(mysql_error());
	$opcao_t = mysql_result($sql2,0);
    if($opcao_t >= 1){
		$turno=($opcao_t+1);
	}else{
		$turno="1";
	}	

$html_enquete ="$result[nome_enquete] <br> Turno:$turno";

return $html_enquete;
}

function show_head(){
$html_enquete ='<head>';
$html_enquete.='<script type="text/javascript" language="javascript" src="js/lytebox.js"></script>';
$html_enquete.='<link rel="stylesheet" href="css/lytebox.css" type="text/css" media="screen" />';
$html_enquete.='<meta content="text/html; charset=UTF-8" http-equiv="content-type">';
$html_enquete.='<link rel="stylesheet" href="css/style.css">';
$html_enquete.='</head>';
	
return $html_enquete;	
}

?>
