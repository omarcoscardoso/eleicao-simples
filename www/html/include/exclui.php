<?php
require_once("conecta.php");
require_once("vota.ini.PB.php");

function exclui_candidato($id_ENQUETE){

if(isset($_POST[ativo])){                         //Testa se o form foi postado
	
  foreach($_POST[ativo] as $key){
	mysql_query("DELETE FROM candidato where id_candidato=$key and id_enquete=$id_ENQUETE")or die("Erro ao habilitar candidato");
  }
    echo '<h1>Excluir Candidatos</h1>';	
    echo "<div class='msg'>";   
    echo "Candidatos Excluidos!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.go(-2);">'; 
//    echo '<INPUT type="button" value="Fechar" onClick="window.close()">'; 
    echo "</div>";
}
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Excluir Candidatos</h1>   
	<div class="habilita">
    <form method="post" action="<?=$PHP_SELF;?>" name="exclui">
    <?php 
      $query = mysql_query("SELECT * FROM candidato
                                    WHERE candidato.id_candidato > 0 
                                      and candidato.id_enquete=$id_ENQUETE
                                 order by candidato.id_candidato") or die("Não foi possível realizar consulta ao banco de dados.");
                                     
        while($row = mysql_fetch_assoc($query)){
              $id            = $row["id_candidato"];
              $nome_list     = $row["nome"];
                     
             echo "<input type='checkbox' name='ativo[]' value='$id'/><b>$id</b> - $nome_list<br>"; 
        }
     ?>
     <table class="resulta">
		<tr>
			<td>
				<input class="botao" type="submit" value="Excluir">
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

function exclui_eleitor(){

if(isset($_POST[ativo])){                         //Testa se o form foi postado
	
  foreach($_POST[ativo] as $key){
	mysql_query("DELETE FROM eleitores where eleitores.nome='$key'")or die(mysql_error());
  }
    echo '<h1>Excluir Candidatos</h1>';	
    echo "<div class='msg'>";   
    echo "Candidatos Excluidos!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.go(-1);">'; 
    echo "</div>";
}
else{                                            //se não foi postado imprime o form
?>
<html>
  <body>
	<h1>Excluir Eleitores</h1>   
	<div class="habilita">
    <form method="post" action="<?=$PHP_SELF;?>" name="exclui">
    <?php 
      $query = mysql_query("SELECT * FROM eleitores order by eleitores.nome") or die("Não foi possível realizar consulta ao banco de dados.");
                                     
        while($row = mysql_fetch_assoc($query)){
              $nome_list     = $row["nome"];
                     
             echo "<input type='checkbox' name='ativo[]' value='$nome_list'/>$nome_list<br>"; 
        }
     ?>
     <table class="resulta">
		<tr>
			<td>
				<input class="botao" type="submit" value="Excluir">
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

function exclui_eleicao($id_ENQUETE){

	mysql_query("DELETE FROM opcoes where id_enquete=$id_ENQUETE")or die("Erro ao excluir Eleicao");
	mysql_query("DELETE FROM candidato where id_candidato = 0 and id_enquete = $id_ENQUETE")or die("Erro ao excluir candidato");
  
    echo '<h1>Excluir Eleicao</h1>';	
    echo "<div class='msg'>";   
    echo "Eleicao $id_ENQUETE foi Excluida!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.go(-1);">'; 
//    echo '<INPUT type="button" valufe="Fechar" onClick="window.close()">'; 
    echo "</div>";

}

function exclui_urna($ip){

	mysql_query("DELETE FROM urnas where ip='$ip'")or die(mysql_error());
  
    echo '<h1>Excluir Urna</h1>';	
    echo "<div class='msg'>";   
    echo "Urna $ip foi Excluida!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.go(-1);">'; 
//    echo '<INPUT type="button" valufe="Fechar" onClick="window.close()">'; 
    echo "</div>";

}
?>


