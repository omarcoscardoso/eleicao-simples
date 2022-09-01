<?php
require_once("include/apuracao.php");
require_once("vota.ini.PB.php");
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
?> 
<html>
	 <?php echo show_head(); ?>	
<body>	

<table class="figura" >
	<th colspan="4">Cadastro de Elei&ccedil;&atilde;o</th>
<tr>		
	<td><a href="insere_eleicao.php" class="lytebox" data-title="Incluir Elei&ccedil;&atilde;o" data-lyte-options="width:400 height:100 scrollbars:no">
		<IMG class="escala" SRC="icon/sis/white/eMule.png" onMouseOver="this.src='icon/sis/black/eMule.png'" onMouseOut="this.src='icon/sis/white/eMule.png'"></a>
	    <br>Incluir Elei&ccedil;&atilde;o</td>
	<td><a href="ver_eleicao.php" class="lytebox" data-title="Listar Elei&ccedil;&atilde;o" data-lyte-options="width:500 height:800">
	    <IMG class="escala" SRC="icon/sis/white/List.png" onMouseOver="this.src='icon/sis/black/List.png'" onMouseOut="this.src='icon/sis/white/List.png'"></a>
	    <br>Listar Elei&ccedil;&otilde;es</td>
	<td><a href="exclui_eleicao.php" class="lytebox" data-title="Excluir Elei&ccedil;&atilde;o" data-lyte-options="width:400 height:100">
		<IMG class="escala" SRC="icon/sis/white/lixeira.png" onMouseOver="this.src='icon/sis/black/lixeira.png'" onMouseOut="this.src='icon/sis/white/lixeira.png'"></a>
	    <br>Excluir Elei&ccedil;&atilde;o</td>
</tr>
	<th colspan="4">Controle de Candidatos</th>
<tr>		
	<td><a href="insere_candidato.php" class="lytebox" data-title="Incluir Candidato" data-lyte-options="width:750 height:650 scrollbars:yes">
		<IMG class="escala" SRC="icon/sis/white/User.png" onMouseOver="this.src='icon/sis/black/User.png'" onMouseOut="this.src='icon/sis/white/User.png'"></a>
	    <br>Incluir Candidato</td>
	<td><a href="habilita_candidato.php" class="lytebox" data-title="Habilitar Candidato" data-lyte-options="width:750 height:800">
	    <IMG class="escala" SRC="icon/sis/white/Contacts.png" onMouseOver="this.src='icon/sis/black/Contacts.png'" onMouseOut="this.src='icon/sis/white/Contacts.png'"></a>
	    <br>Habilitar Candidatos</td>
	<td><a href="exclui_candidato.php" class="lytebox" data-title="Excluir Candidato" data-lyte-options="width:650 height:800">
		<IMG class="escala" SRC="icon/sis/white/UserDel.png" onMouseOver="this.src='icon/sis/black/UserDel.png'" onMouseOut="this.src='icon/sis/white/UserDel.png'"></a>
	    <br>Excluir Candidatos</td>
	<td><a href="ver_candidato.php" class="lytebox" data-title="Lista de Candidato" data-lyte-options="width:500 height:800">
		<IMG class="escala" SRC="icon/sis/white/MySpace.png" onMouseOver="this.src='icon/sis/black/MySpace.png'" onMouseOut="this.src='icon/sis/white/MySpace.png'"></a>
	    <br>Listar Candidatos</td>

</tr>
<th colspan="4">Configura&ccedil;&atilde;o de Terminais de Vota&ccedil;&atilde;o</th>
<tr>		
	
	<td><a href="cadastra_urna.php" class="lytebox" data-title="Cadastar Terminal Vota&ccedil;&atilde;o" data-lyte-options="width:650 height:250 scrollbars:no">
		<IMG class="escala" SRC="icon/sis/white/Control Panel 2.png" onMouseOver="this.src='icon/sis/black/Control Panel 2.png'" onMouseOut="this.src='icon/sis/white/Control Panel 2.png'"></a>
	    <br>Cadastrar Terminal</td>   
	<td><a href="ver_urnas.php" class="lytebox" data-title="Terminais de Vota&ccedil;&atilde;o Cadastrados" data-lyte-options="width:650 height:250 scrollbars:no">
		<IMG class="escala" SRC="icon/sis/white/Network.png" onMouseOver="this.src='icon/sis/black/Network.png'" onMouseOut="this.src='icon/sis/white/Network.png'"></a>
	    <br>Terminais Cadastrados</td>   
	<td><a href="exclui_urnas.php" class="lytebox" data-title="Cadastar Terminal Vota&ccedil;&atilde;o" data-lyte-options="width:650 height:250 scrollbars:no">
		<IMG class="escala" SRC="icon/sis/white/lixeira.png" onMouseOver="this.src='icon/sis/black/lixeira.png'" onMouseOut="this.src='icon/sis/white/lixeira.png'"></a>
	    <br>Excluir Terminais</td>   
	<td><a href="javascript:window.open('urnas.php', 'principal', 'status=no, toolbar=no, menubar=no, location=no, fullscreen=1, scrolling=auto');">
		<IMG class="escala" SRC="icon/sis/white/Contacts 2.png" onMouseOver="this.src='icon/sis/black/Contacts 2.png'" onMouseOut="this.src='icon/sis/white/Contacts 2.png'"></a>
	    <br>Iniciar Urnas</td>  
</tr>
<th colspan="4">Controle de Eleitores</th>	     
<tr>
	<td><a href="insere_eleitor.php" class="lytebox" data-title="Incluir Eleitor" data-lyte-options="width:400 height:500 scrollbars:no">
		<IMG class="escala" SRC="icon/sis/white/User.png" onMouseOver="this.src='icon/sis/black/User.png'" onMouseOut="this.src='icon/sis/white/User.png'"></a>
	    <br>Incluir Eleitor</td>
	<td><a href="fazer_chamada.php" class="lytebox" data-title="Fazer chamada" data-lyte-options="width:600 height:1500 scrollbars:yes">
		<IMG class="escala" SRC="icon/sis/white/Task.png" onMouseOver="this.src='icon/sis/black/Task.png'" onMouseOut="this.src='icon/sis/white/Task.png'"></a>
	    <br>Lista de Presen&ccedil;a</td>  
	<td><a href="limpa_chamada.php" class="lytebox" data-title="Limpar chamada" data-lyte-options="width:600 height:1500 scrollbars:yes">
		<IMG class="escala" SRC="icon/sis/white/Task.png" onMouseOver="this.src='icon/sis/black/Task.png'" onMouseOut="this.src='icon/sis/white/Task.png'"></a>
	    <br>Limpar Lista</td>
	<td><a href="exclui_eleitor.php" class="lytebox" data-title="Excluir Eleitor" data-lyte-options="width:500 height:800">
		<IMG class="escala" SRC="icon/sis/white/UserDel.png" onMouseOver="this.src='icon/sis/black/UserDel.png'" onMouseOut="this.src='icon/sis/white/UserDel.png'"></a>
	    <br>Excluir Eleitor</td>  
</tr>	     

</table>

<div class="ontext" style="width:210px;z-index:101;">
<i>
	<a href="inicia_eleicao.php" class="lytebox" data-title="Iniciar Elei&ccedil;&atilde;o" data-lyte-options="width:450 height:150">
		<img class="escala" src="icon/sis/white/1.png" title="Iniciar Elei&ccedil;&atilde;or" /></a>
		<p>Iniciar Elei&ccedil;&atilde;o</p>
</i>
<i>
	<a href="finaliza_eleicao.php" class="lytebox" data-title="Apura&ccedil;&atilde;o de Votos" data-lyte-options="width:450 height:150">
		<img class="escala" src="icon/sis/white/2.png" title="Apurar" /></a>
		<p>Apurar Votos</p>
</i>
<i>
	<a href="ver_resultado.php" class="lytebox" data-title="Resultado" data-lyte-options="width:700 height:750">
		<IMG class="escala" SRC="icon/sis/white/3.png" title="Resultado"></a>
		<p>Mostra Resultado</p>
</i>
<i>
	<a href="exclui_apuracao.php" class="lytebox" data-title="Apaga Apura&ccedil;&atilde;o" data-lyte-options="width:450 height:150">
		<IMG class="escala" SRC="icon/sis/white/4.png" title="Apagar"></a>
		<p>Apaga Apura&ccedil;&atilde;o</p>
</i>
</div>

</body>
</html>


