<?php
require_once("include/conecta.php");            
require_once("include/exclui.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

echo show_head();

if(isset($_GET[id_exclui])){                       //Testa se o form foi postado
   exclui_eleicao($_GET[id_exclui]);
}
else{                                             //se não foi postado imprime o form
?>
<html>
  <body>  
  	<h1>Excluir Candidatos</h1>   
	<div class="tipo">
    <form method="get" action="<?=$PHP_SELF;?>" id="excluiEleicao">
    <?php
      $query = mysql_query("SELECT * FROM opcoes") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='excluiEleicao' name='id_exclui'>";      
        while($row = mysql_fetch_array($query)){
              $id            = $row["id_enquete"];
              $nome_list     = $row["nome_enquete"];
              
      echo "<option value='$id'><b>$id</b> - $nome_list</option>";
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
