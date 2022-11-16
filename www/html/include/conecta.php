<?php

    $user = 'root';
    $password = 'root';
    $db = 'eleicao';
    $host = '172.19.0.2';

mysql_connect($host, $user,$password) or die('ERRO NA CONEXAO:'.mysql_error());
mysql_select_db($db)or die('ERRO AO ESCOLHER O BD :'.mysql_error());

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
