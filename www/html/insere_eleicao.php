<?php
include_once("include/conecta.php");            
require_once("include/insere.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");                //inclusao do arquivo com a funcao

echo show_head();

if(isset($_POST[nome_enquete])){                //Testa se o form foi postado
   echo '<h1>Inserir Eleição</h1>';	
   echo "<div class='msg'>";  
  if(insertEleicao($_POST,"opcoes")){           //Chama a função
    echo "Dados inseridos com sucesso!<br>";
    echo '<table class="resulta">';
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" autofocus="autofocus" onClick="JavaScript: window.history.back();">';
  }
  else{
	echo "<p>Falha ao inserir os dados!</p><br>";  
	echo '<table class="resulta">';
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  echo "</td></tr>";
  echo "</table>";
  echo "</div>";
}
else{                                           //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Inserir Eleicao</h1>   
	<div class="incluir">  
	<form method="post" action="<?=$PHP_SELF;?>" id="enquete">
       
     Nome Eleicao:<input type='text' name='nome_enquete' autofocus='autofocus'>
     
     <input class="botao" type="submit" value="Incluir">
    </form>
    </div>
  </body>
</html>
<?php
}
?>

