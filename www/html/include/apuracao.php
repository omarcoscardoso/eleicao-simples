<?php
require_once("include/conecta.php");
include("vota.ini.PB.php");

function limpa_apuracao($id_ENQUETE){
	
	    mysql_query('DELETE FROM apuracao where id_enquete="'.$id_ENQUETE.'"')or die(mysql_error()); 

return (mysql_affected_rows() > 0) ? true : false;	    
}

function apuracao($id_ENQUETE,$turno){	
	echo '<div class="msg">';
	$sql= mysql_query("SELECT DISTINCT(turno) FROM apuracao WHERE apuracao.id_enquete=$id_ENQUETE and turno=$turno")or die(mysql_error());
	$result = mysql_result($sql,0);
	
	if($result == $turno){
		echo "<p>Votos j&aacute;  apurados para esta elei&ccedil;&atilde;o</p><br>";
		echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
		exit; 
	}else{
		$exec1 = mysql_query("SELECT * FROM candidato LEFT JOIN votos ON votos.id_opcao = candidato.id_candidato 
	    				       WHERE candidato.id_candidato > 0 
            	                 AND candidato.id_enquete=$id_ENQUETE 
                	             AND candidato.ativo='t'
                	             AND votos.turno=$turno
								 AND votos.id_enquete=$id_ENQUETE 
                	             AND votos.id_opcao is not null")or die("ERRO ao consultar ao banco de dados -> $id_ENQUETE.");                                  
		while($row = mysql_fetch_array($exec1)){
			$Cod  = $row["id_candidato"];
			$ssql = mysql_query('SELECT max(total_votos) FROM votos WHERE id_enquete="'.$id_ENQUETE.'" and id_opcao="'.$Cod.'" and turno="'.$turno.'"')or die("Erro 001 ".mysql_error());
			$total_votos=mysql_result($ssql,0);
			mysql_query('INSERT INTO apuracao (id_enquete,id_candidato,total_votos,turno) VALUES ("'.$id_ENQUETE.'","'.$Cod.'","'.$total_votos.'","'.$turno.'")')or die("Erro 002 ".mysql_error());
        }
	}         
  	echo '</div>';
return (mysql_affected_rows() == 1) ? true : false;
}

function show_apuracao($id_ENQUETE,$turno){
echo '<div class="msg">';
$sql= mysql_query("SELECT DISTINCT(turno) FROM apuracao WHERE apuracao.id_enquete=$id_ENQUETE and turno=$turno")or die(mysql_error());
$result = mysql_result($sql,0);

if($result <> $turno){
	echo "<p>Votos ainda n&atilde;o foram apurados</p><br>";
	echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
	exit; 
}else{
	
	$ssql=mysql_query('SELECT * FROM votos WHERE votos.id_enquete="'.$id_ENQUETE.'" and turno="'.$turno.'"')or die(mysql_error());
	$total_votos=mysql_num_rows($ssql);

	// if ($id_ENQUETE == 1 and $turno == 1){ 
	// 	$total_eleitores = ($total_votos/4); 
	// }elseif($id_ENQUETE == 2 or 3 and $turno ==1){ 
	// 		$total_eleitores = ($total_votos/3);		
	// }elseif($id_ENQUETE >= 1 and $turno >= 2){ 
	// 		$total_eleitores = $total_votos ;		
	// }
	$unico = false;
	if($turno == 1 && $unico == false){
		$total_eleitores = ($total_votos/4);
	}else{
		$total_eleitores = ($total_votos/1);
	}

$html_enquete.='<table class="resulta">';
$html_enquete.= "<caption>";	
$html_enquete.='TURNO '.$turno.'<br>';
$html_enquete.= "</caption>";
$html_enquete.='<tr>';
$html_enquete.='<th>Candidato</th>';
$html_enquete.='<th>Percentual</th>';
$html_enquete.='<th>Votos</th>';
$html_enquete.='</tr>';

$selec = "SELECT distinct(candidato.id_candidato)
               , candidato.nome 
               , apuracao.total_votos 
            FROM apuracao, candidato
           WHERE candidato.id_enquete = ".$id_ENQUETE."
             AND candidato.id_enquete = apuracao.id_enquete
             AND apuracao.total_votos > 0
             AND apuracao.id_candidato = candidato.id_candidato
             AND apuracao.turno = $turno
             order by apuracao.total_votos desc";
         
$exec = mysql_query($selec) or die(mysql_error());
while($dados=mysql_fetch_array($exec)) {
	$estimar_porcentagem= @round($dados['total_votos']*100/$total_eleitores,1);
	$html_enquete.="<tr>";
	$html_enquete.="<td align='left'>".$dados['nome']."</td>";
	$html_enquete.="<td>".$estimar_porcentagem."%</td>";
	$html_enquete.="<td><b>".$dados['total_votos']."</b></td>";
	$html_enquete.="</tr>";
}
$html_enquete.='<tr>';
$html_enquete.='<th colspan="3"><br>Total de eleitores: '.$total_eleitores.'</th>';
$html_enquete.='</tr>';
$html_enquete.='<tr>';
$html_enquete.='<th colspan="3">Total de votos: '.$total_votos.'<br><br></th>';
$html_enquete.='</tr>';

$html_enquete.='</table>';

}         
echo '</div>';
return $html_enquete;
}


?>

