<?php
require_once("include/conecta.php");            
require_once("include/apuracao.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");            

 echo show_head();

if(isset($_POST[enquete])){                       //Testa se o form foi postado
  $var = explode(' ', $_POST[enquete]);
  $id_ENQUETE = $var[0];
  $turno = $var[1] ;
  echo "<h1>Apura&ccedil;&atilde;o  de Votos</h1>";
  echo "<div class='msg'>";
  if(apuracao($id_ENQUETE,$turno)){                  //Chama a função
    echo "Urnas apuradas com sucesso!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }else{
    echo "<p>Falha ao inserir os dados!</p><br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  echo "</div>";
}else{                                           //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Apura&ccedil;&atilde;o  de Votos</h1>  
	<div class="tipo"> 
	<form method="post" action="<?=$PHP_SELF;?>" id="finaliza">
    <?php
      $query = mysql_query("SELECT DISTINCT(votos.turno)
                                 , nome_enquete
                                 , votos.id_enquete as enquete
                              FROM votos, opcoes
                             WHERE votos.id_enquete = opcoes.id_enquete
                          ORDER BY enquete") or die(mysql_error());
      
      echo "<select form='finaliza' name='enquete'>";
        while($row = mysql_fetch_array($query)){
              $id            = $row["enquete"];
              $turno         = $row["turno"];
              $nome_list     = $row["nome_enquete"];
      echo "<option value='$id $turno'><b>$id</b> - $nome_list/Turno:$turno</option>";
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

