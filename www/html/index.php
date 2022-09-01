<?php
include_once("include/apuracao.php");
include_once("vota.ini.PB.php");
?>

<?php echo show_head();  ?>

<FRAMESET border="0" ROWS="8%, 80%">
<frame src="topo.php">
<frameset border="0" COLS="83%,*,0%">
<frame NAME="esquerda" src="admin.php" NORESIZE borderCOLOR="#3F85B8" target="main">
<frame NAME="direita" src="atual.php" NORESIZE borderCOLOR="#4086C6" target="direita">
</frameset>
<noframes>
<body>
</body>
</noframes>
</FRAMESET>
</html>

