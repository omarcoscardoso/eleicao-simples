<?php
require_once("conecta.php");
require_once("vota.ini.PB.php");

function habilita($id_ENQUETE){

if(isset($_POST[ativo])){                         //Testa se o form foi postado
	mysql_query("UPDATE candidato set ativo='f' where id_enquete=$id_ENQUETE")or die("Erro ao habilitar candidato");
  foreach($_POST[ativo] as $key){  
	mysql_query("UPDATE candidato set ativo='t' where id_candidato=$key and id_enquete=$id_ENQUETE")or die("Erro ao habilitar candidato");
  }
    echo '<h1>Habilitar Candidatos</h1>';	
    echo "<div class='msg'>";   
    echo "Candidatos habilitados!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">'; 
//    echo '<INPUT type="button" value="Fechar" onClick="window.close()">'; 
    echo "</div>";
}
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
    <h1>Habilitar Candidatos</h1>   
	<div class="habilita">    
    <form method="post" action="<?=$PHP_SELF;?>" name="habilita">
    <?php 
      $query = mysql_query("SELECT * FROM candidato
                                    WHERE candidato.id_candidato > 0 
                                      and candidato.id_enquete=$id_ENQUETE
                                 order by candidato.id_candidato") or die("Não foi possível realizar consulta ao banco de dados.");
                                     
        while($row = mysql_fetch_assoc($query)){
              $id            = $row["id_candidato"];
              $nome_list     = $row["nome"];
              $ativo         = $row["ativo"];    
              $checked = ($ativo == 't') ? 'checked' : '';
                     
             echo "<input type='checkbox' name='ativo[]' value='$id' $checked/><b>$id</b> - $nome_list<br>"; 
        }
     ?>
     <table class="resulta">
		<tr>
			<td>
				<input class="botao" type="submit" value="Habilitar">
				<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">
			</td>
		</tr>
	 </table>
    </form>
    </div>
  </body>
</html>
<?php
}
  return (mysql_affected_rows() > 0) ? true : false;                                                   //Testa se a linha foi inserida no BD
}
?>


