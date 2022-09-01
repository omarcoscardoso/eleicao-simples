<?php
require_once("include/conecta.php");            
require_once("include/apuracao.php");             //inclusao do arquivo com a funcao
require_once("vota.ini.PB.php");

echo show_head();

if(isset($_POST[id_apaga])){                       //Testa se o form foi postado
  
  echo "<h1>Excluir Apura&ccedil;&atilde;o</h1>";
  echo "<div class='msg'>";
  if(limpa_apuracao($_POST[id_apaga])){            //Chama a função
    echo "Votos apurados foram APAGADOS!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  else{
    echo "<p>Falha ao apagar os dados!</p><br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
  }
  echo "</div>";
}
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Excluir Apura&ccedil;&atilde;o</h1>   
	<div class="tipo">  
    <form method="post" action="<?=$PHP_SELF;?>" id="apaga">
    <?php
      $query = mysql_query("SELECT * FROM opcoes") or die("Não foi possível realizar consulta ao banco de dados Clientes.");
      echo "<select form='apaga' name='id_apaga'>";
        while($row = mysql_fetch_array($query)){
              $id            = $row["id_enquete"];
              $nome_list     = $row["nome_enquete"];
              
      echo "<option value='$id'>$nome_list</option>";
          }  
    //   echo "</select>";   
     ?>
     <br>
     <input class="botao" type="submit" value="Ok">
    </form>
    </div>
  </body>
</html>
<?php
}
?>
