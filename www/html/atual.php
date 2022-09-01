<?php
include("include/apuracao.php");
// include("vota.ini.PB.php");
?>
<html>
	 <?php echo show_head(); ?>	
	  <META HTTP-EQUIV="Refresh" CONTENT="3"  > 
<body>	
<br>
<table class="info">	
<th colspan='2'>Elei&ccedil;&atilde;o/Turno Atual</th>
<tr>
	<td><?php echo show_eleicao_atual();  ?></td>
</tr>    
</table>
</body>
</html>
