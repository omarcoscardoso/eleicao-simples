<?php
require_once("include/conecta.php");            
require_once("include/apuracao.php");                  //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

 echo show_head();

if(isset($_POST[id_resultado])){                  //Testa se o form foi postado

	$var = $_POST[id_resultado]; 
	$id_ENQUETE = $var[0]; 
	$turno = $var[2] ;

	echo '<h1>Resultado</h1>';	
	echo show_apuracao($id_ENQUETE,$turno);
	echo '<table class="resulta">';
	echo '<tr><td>';
	echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">'; 
//    echo '<INPUT type="button" value="Fechar" onClick="window.close()">'; 
	echo '<input class="botao" type="button" name="imprimir" value="Imprimir" onclick="window.print();">';
	echo '</td></tr>';
}
else{                                             //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Resultado</h1>   
	<div class="tipo">  
    <form method="post" action="<?=$PHP_SELF;?>" id="resultado">
    <?php
      $query = mysql_query("SELECT DISTINCT(turno)
                                 , nome_enquete
                                 , votos.id_enquete as enquete
                              FROM votos, opcoes
                             WHERE votos.id_enquete = opcoes.id_enquete
                          ORDER BY enquete,turno") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
                          
      echo "<select form='resultado' name='id_resultado'>";
        while($row = mysql_fetch_array($query)){
              $id            = $row["enquete"];
              $turno         = $row["turno"];
              $nome_list     = $row["nome_enquete"];
      echo "<option value='$id $turno'><b>$id</b> - $nome_list/Turno:$turno</option>";
          }
      echo "</select>";    
     ?>
     <br>
     <input class="botao" type="submit" value="Ver">
    </form>
    </div>
  </body>
</html>
<?php
}
?>
