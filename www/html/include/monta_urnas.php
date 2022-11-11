<?php
require_once("conecta.php");
// include("../vota.ini.PB.php");

function inicia_sessao($sessao){
		
	$sql= mysql_query("SELECT ip FROM urnas WHERE urnas.sessao=$sessao")or die(mysql_error());
	$result = mysql_result($sql,0);

if($result == $_SERVER["REMOTE_ADDR"]){
	$sql= mysql_query("SELECT id_enquete FROM opcoes WHERE ativo='t'")or die(mysql_error());
	$result = mysql_result($sql,0);
    $id_enquete = $result;
    
    $sql= mysql_query("SELECT max(turno) FROM apuracao WHERE id_enquete=$id_enquete")or die(mysql_error());
	$opcao_t = mysql_result($sql,0);
    if($opcao_t >= 1){
		$turno=($opcao_t+1);
	}else{
		$turno="1";
	}
	
    
?>

<html>
	
<?php echo show_head(); ?>

<body bgcolor= #EEE  >
<div class="urna">
<table class="urna_top">
	    <br><br>
	    <caption>Elei&ccedil;&atilde;o de Oficiais</caption>
	    <th colspan="2">Cabine de Vota&ccedil;&atilde;o</th> 
		<tr>
			<td>Sess&atilde;o:	<?php echo $sessao; ?></td>
	    </tr>
		<tr>
			<td>Elei&ccedil;&atilde;o para:	<?php echo show_pergunta($id_enquete); ?></td>
	    </tr>
</table>	
 <table class="urna">   
	<th colspan="2" > <?php echo $turno; ?>&deg; turno</th>
	<tr>
		<td>
			<?php echo show_enquete($id_enquete,$sessao); ?>
		</td>
		<td>
			<?php echo show_candidato($id_enquete); ?>
		</td>
	</tr>
</table>
</div>

</body> 
</html>

<?php
}else{
	echo '<div class="msgs">';
    echo "<p>O IP do  terminal selecionado n&atilde;o  confere com o da maquina local</p>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">';
    echo '</div>';
    exit;
}         
 
}
?>
