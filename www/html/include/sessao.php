<html>
<head>
<title></title>
</head>

<body>
<div align="center">
<?
include('../vota.ini.pb.php');
?>
<br>
<table border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="">
<tr>
<font color="#ff0000" face="arial" size="6">sess&atilde;o 1 </font><br>
  <td>
    <? 
       echo show_pergunta(3); 
    ?>
  </td>
</tr>
</table>
<br>
<table border="1" align="center" cellpadding="50" cellspacing="2" bgcolor="#e2ead5">
<tr>
<td align="center">
    <?
//         enquete,sessao
echo show_enquete(3,1); 
?>
</td>
<td>
<? echo show_candidato(3); ?>
</td>
</tr>
</table>

</div>

</body> 
</html>



 
