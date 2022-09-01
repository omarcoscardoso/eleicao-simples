<?php
require_once("include/conecta.php");            
require_once("vota.ini.PB.php");             //inclusao do arquivo com a funcao

   echo show_eleicao();
   echo '<table class="lista">';
   echo '<tr><td>';
//   echo '<INPUT type="button" value="Fechar" onClick="window.close()">'; 
   echo '<input class="botao" type="button" name="imprimir" value="Imprimir" onclick="window.print();">';
   echo '</td></tr>';

?>
