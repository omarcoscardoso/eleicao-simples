<?php
require_once("conecta.php");
require_once("vota.ini.PB.php");

function limpa_chamada(){
   mysql_query("UPDATE candidato set ativo='f'")or die(mysql_error());
   mysql_query("UPDATE eleitores set ativo='f'")or die(mysql_error());
   echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=fazer_chamada.php'>";
}

function chamada(){
   if(isset($_POST['ativo'])){ // Testa se o form foi postado
      mysql_query("UPDATE candidato set ativo='f'")or die(mysql_error());
      mysql_query("UPDATE eleitores set ativo='f'")or die(mysql_error());
      
      foreach($_POST['ativo'] as $key){  
         mysql_query("UPDATE candidato set ativo='t' where candidato.nome like '%$key%'")or die(mysql_error());
         mysql_query("UPDATE eleitores set ativo='t' where eleitores.nome like '%$key%'")or die(mysql_error());	
      }

      date_default_timezone_set('America/Sao_Paulo');
      $result= mysql_query("SELECT count(nome) FROM eleitores where ativo='t'")or die(mysql_error());
      $count = mysql_result($result,0);
      $data = date("d/m/Y - H:i:s "); 
      
      // Estilos para impressão simplificada
      $html_enquete .= '<style>
         @media print {
            body {
               font-family: Arial, sans-serif;
               font-size: 12pt;
            }
            .lista {
               width: 100%;
               list-style-type: none;
               padding: 0;
            }
            .lista li {
               margin: 5px 0;
            }
         }
      </style>';

      // Cabeçalho com a data e o número de eleitores presentes
      $html_enquete .= "<h2>Lista de Presença</h2>";
      $html_enquete .= "<p>Data: $data</p>";
      $html_enquete .= "<p>Eleitores Presentes: $count</p>";
      
      // Lista dos nomes
      $html_enquete .= "<ul class='lista'>";

      $selec = "SELECT nome FROM eleitores WHERE ativo='t' order by nome";
      $exec = mysql_query($selec) or die(mysql_error());
      
      while($dados = mysql_fetch_array($exec)) {
         $html_enquete .= "<li>".$dados['nome']."</li>";
      }
      
      $html_enquete .= "</ul>";
      
      echo $html_enquete;   
      echo "<div class='msg'>";
      echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.back();">'; 
      echo '<input class="botao" type="button" name="imprimir" value="Imprimir" onclick="window.print();">';
      echo "</div>";
   } else {
      // Se não foi postado, imprime o formulário
?>
<html>
<head>
    <script type="text/javascript">
        function selecionar_tudo(){
            for (i=0; i<document.habilita.elements.length; i++)
                if(document.habilita.elements[i].type == "checkbox")
                    document.habilita.elements[i].checked = 1;
        }

        function deselecionar_tudo(){ 
            for (i=0; i<document.habilita.elements.length; i++) 
                if(document.habilita.elements[i].type == "checkbox")	
                    document.habilita.elements[i].checked = 0;
        } 
    </script>
</head>
<body>
    <h1>Lista de Eleitores</h1>   
    <div class="habilita"> 
    <form method="post" action="<?=$PHP_SELF;?>" name="habilita">
        <?php 
            $result = mysql_query("SELECT count(nome) FROM eleitores") or die(mysql_error());
            $count = mysql_result($result,0);
        
            $query = mysql_query("SELECT * FROM eleitores order by eleitores.nome") or die(mysql_error());
            while($row = mysql_fetch_assoc($query)){
                $nome_list = $row["nome"];
                $ativo = $row["ativo"];    
                $checked = ($ativo == 't') ? 'checked' : '';
                echo "<input type='checkbox' name='ativo[]' value='$nome_list' $checked/>$nome_list<br>"; 
            }
            echo '<br><input class="botao" name="Marcar" type="button" value="Marcar Tudo" onClick="javascript:selecionar_tudo()">';
            echo '<input class="botao" name="Desmarcar" type="button" value="Desmarcar" onClick="javascript:deselecionar_tudo()"><br>';
            echo "<br>Numero de Eleitores: <b>$count</b>";
        ?>
        <table class="resulta">
            <tr>
                <td>
                    <input class="botao" type="submit" value="OK">
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
<?php
   }
   return (mysql_affected_rows() > 0) ? true : false;
}
?>
