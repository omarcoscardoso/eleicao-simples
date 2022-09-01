<?php
require_once("include/conecta.php");            
require_once("include/exclui.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

echo show_head();

if(isset($_GET[ip])){                       //Testa se o form foi postado
   exclui_urna($_GET[ip]);
}
else{                                             //se não foi postado imprime o form
?>
<html>
  <body>  
  	<h1>Excluir Candidatos</h1>   
	<div class="tipo">
    <form method="get" action="<?=$PHP_SELF;?>" id="excluiUrna">
    <?php
      $query = mysql_query("SELECT * FROM urnas") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='excluiUrna' name='ip'>";      
        while($row = mysql_fetch_array($query)){
              $ip            = $row["ip"];
              $sessao        = $row["sessao"];
              
      echo "<option value='$ip'>Sess&atilde;o:<b>$sessao</b>/IP:$ip</option>";
          }  
     ?>
     <input class="botao" type="submit" value="Ok">
    </form>
    </div>
  </body>
</html>
<?php
}

?>
