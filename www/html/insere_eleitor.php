<?php
require_once("include/conecta.php");            
require_once("include/insere.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");                //inclusao do arquivo com a funcao

echo show_head();

if(isset($_POST[nome])){                        //Testa se o form foi postado
   echo '<h1>Inserir Eleitor</h1>';	
   echo "<div class='msg'>";  
  if(insertEleitor($_POST)){      //Chama a função
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
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Inserir Eleitor</h1>   
	<div class="incluir">  
	<form  method="post" action="<?=$PHP_SELF;?>" id="eleitor">
	  <fieldset>
		    <br>
			<label for="nome" >Nome:</label>
			<input type='text' name='nome' autofocus='autofocus'><br><br>
			
			<label for="sexo">Sexo:</label>
			<input type="radio" name="sexo" value="Feminino">Feminino
		    <input type="radio" name="sexo" value="Masculino">Masculino<br><br>
			
			<label for="data_nascimento">Nascimento:</label>
			<input type='date' name='data_nascimento' autofocus='autofocus'><br><br>
			
			<label for="data_admissao" >Admissao:</label>
			<input type='date' name='data_admissao' autofocus='autofocus'><br><br>
			
			<label for="tipo_consagracao">Consagracao:</label><br>
			<input type="radio" name="tipo_consagracao" value="Presbitero">Presbitero<br>
			<input type="radio" name="tipo_consagracao" value="Diacono">Diacono<br>
		    <input type="radio" name="tipo_consagracao" value="Diaconisa">Diaconisa<br><br>
			
		<input class="botao" type="submit" value="Incluir"/><br>
	  </fieldset>
     
    </form>
    </div> 
  </body>
</html>
<?php
}
?>

