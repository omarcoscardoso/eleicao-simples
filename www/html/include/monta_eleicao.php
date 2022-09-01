<?php

require_once("include/conecta.php");

function eleicao($id_ENQUETE){
// NUMERO DA ENQUETE
$sqlNenqt = "SELECT id_enquete FROM opcoes where id_enquete=$id_ENQUETE";
$ResultNenqt = mysql_query($sqlNenqt) ;
$Nenqt = mysql_result($ResultNenqt,0);
// NOME DA ENQUETE
$sqlNomEnqt = "SELECT nome_enquete FROM opcoes where id_enquete=$id_ENQUETE";
$ResultNomEnqt = mysql_query($sqlNomEnqt);
$nomEnquete = mysql_result($ResultNomEnqt,0);
// ARRAY DA ENQUETE
       if ($id_ENQUETE == 1){
         	$enquete[$Nenqt]=array("$nomEnquete",array(0 => Nulo,'1','2','3','4','5','6','7','8','9','10'));
} else if ($id_ENQUETE == 2){
		$enquete[$Nenqt]=array("$nomEnquete",array(0 => Nulo,'1','2','3','4','5','6','7','8','9','10','11','12','13'));
} else if ($id_ENQUETE == 3){
		$enquete[$Nenqt]=array("$nomEnquete",array(0 => Nulo,'1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19'));
}

return $enquete;
}

?>
