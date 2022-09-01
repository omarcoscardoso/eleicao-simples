<?php
require_once("include/conecta.php");            
require_once("vota.ini.PB.php");            
require_once("include/insere.php");                        //inclusao do arquivo com a funcao
 
 echo show_head();

if(isset($_POST[ip])){                                     //Testa se o form foi postado
   echo '<h1>Cadastrar Terminal Vota&ccedil;&atilde;o</h1>';	
   echo "<div class='msg'>";  
  if(insertUrna($_POST,"urnas")){                          //Chama a função
    echo "Terminal cadastrado com sucesso!<br>";
    echo '<table class="resulta">';
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" autofocus="autofocus" onClick="JavaScript: window.history.back();">';
  }
  else{
	echo "<p>Falha ao cadastrar Terminal!</p><br>";  
	echo '<table class="resulta">';
	echo mysql_error();
	echo '<tr><td>';
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  echo "</td></tr>";
  echo "</table>";
  echo "</div>";
}
else{                                                      //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Cadastrar Terminal Vota&ccedil;&atilde;o</h1>   
	<div class="incluir">  
	<form method="post" action="<?=$PHP_SELF;?>" id="nome_urna">
       
     IP da Sess&atilde;o:<input type='text' name='ip' value="<?php echo $_SERVER["REMOTE_ADDR"] ;?>"><br>
   
     <input class="botao" type="submit" value="Cadastrar">
    </form>
    </div>
  </body>
</html>
<?php
}
?>

