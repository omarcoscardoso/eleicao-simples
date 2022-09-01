<?php
require_once("include/conecta.php");            
require_once("include/habilita.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

echo show_head();

if(isset($_GET[id_habi])){                       //Testa se o form foi postado
   habilita($_GET[id_habi]);
} else {                                         //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Habilitar Candidatos</h1>   
	<div class="tipo">    
    <form method="get" action="<?=$PHP_SELF;?>" id="habi">
    <?php
      $query = mysql_query("SELECT * FROM opcoes") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='habi' name='id_habi'>";      
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
