<?php
require_once("include/conecta.php");            
require_once("vota.ini.PB.php");            
require("include/monta_urnas.php");             //inclusao do arquivo com a funcao
 
 echo show_head();

if(isset($_GET[urna])){                       //Testa se o form foi postado

  inicia_sessao($_GET[urna]);                 //Chama a função
  
}else{                                        //se não foi postado imprime o form
?>
<html>
  <body>    
	<h1>Iniciar Urnas</h1>  
	<div class="tipo"> 
	<form method="get" action="<?=$PHP_SELF;?>" id="urnas">
    <?php
      $query = mysql_query("SELECT *
                              FROM urnas
                          ORDER BY sessao") or die(mysql_error());
      
      echo "<select form='urnas' name='urna'>";
        while($row = mysql_fetch_array($query)){
              $sessao        = $row["sessao"];
              $ip            = $row["ip"];
      echo "<option value='$sessao'>Sess&atilde;o:<b>$sessao</b> / IP:$ip</option>";
          }
      echo "</select>";    
     ?>
     <input class="botao" type="submit" value="Ok">
    </form>
    </div>
  </body>
</html>
<?php
}
?>



