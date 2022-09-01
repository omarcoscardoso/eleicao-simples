<?php
require_once("include/conecta.php");            
require_once("vota.ini.PB.php");             //inclusao do arquivo com a funcao

if(isset($_POST[id_ver])){                  //Testa se o form foi postado
   echo show_candidato($_POST[id_ver]);
   echo '<table class="lista">';
   echo '<tr><td>';
   echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">'; 
//   echo '<INPUT type="button" value="Fechar" onClick="window.close()">'; 
   echo '<input class="botao" type="button" name="imprimir" value="Imprimir" onclick="window.print();">';
   echo '</td></tr>';
}
else{                                             //se não foi postado imprime o form
?>
<html>
 <?php echo show_head(); ?>	
  <body>
	<h1>Candidatos</h1>
	<div class="tipo">  
    <form method="post" action="<?=$PHP_SELF;?>" id="ver">
    <?php
      $query = mysql_query("SELECT * FROM opcoes") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='ver' name='id_ver'>";      
        while($row = mysql_fetch_array($query)){
              $id            = $row["id_enquete"];
              $nome_list     = $row["nome_enquete"];
              
      echo "<option value='$id'><b>$id</b> - $nome_list</option>";
          }  
     ?>
     <input class="botao" type="submit" value="Ver">
    </form>
    </div>
  </body>
</html>
<?php
}
?>
