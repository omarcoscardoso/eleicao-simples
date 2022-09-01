<?php
require_once("include/conecta.php");            
require_once("include/exclui.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

echo show_head();

   exclui_eleitor();

?>
