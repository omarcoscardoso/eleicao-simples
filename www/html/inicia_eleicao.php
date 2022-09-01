<?php
require_once("include/conecta.php");            
require_once("vota.ini.PB.php");            
require_once("include/insere.php");             //inclusao do arquivo com a funcao
 
 echo show_head();

if(isset($_POST[id_enquete])){                              //Testa se o form foi postado
   echo '<h1>Iniciar Elei&ccedil;&atilde;o</h1>';	
   echo "<div class='msg'>";  
  if(iniciaEleicao($_POST[id_enquete])){                          //Chama a função
    echo "Elei&ccedil;&atilde;o iniciada com sucesso!<br>";
    echo '<table class="resulta">';
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" autofocus="autofocus" onClick="JavaScript: window.history.back();">';
  }
  else{
	echo "<p>Falha ao iniciar Eleicao!</p><br>";  
	echo '<table class="resulta">';
	echo mysql_error();
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  echo "</td></tr>";
  echo "</table>";
  echo "</div>";
}
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Iniciar Elei&ccedil;&atilde;o</h1>   
	<div class="incluir">  
	<form method="post" action="<?=$PHP_SELF;?>" id="opcao">
       <?php
      $query = mysql_query("SELECT * FROM opcoes") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='opcao' name='id_enquete'>";      
        while($row = mysql_fetch_array($query)){
              $id            = $row["id_enquete"];
              $nome_list     = $row["nome_enquete"];
              
      echo "<option value='$id'><b>$id</b> - $nome_list</option>";
          }  
     ?>
     <input class="botao" type="submit" value="Iniciar">
    </form>
    </div>
  </body>
</html>
<?php
}
?>

