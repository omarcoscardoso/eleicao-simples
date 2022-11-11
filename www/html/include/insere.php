<?php

function iniciaEleicao($id_ENQUETE){

	mysql_query("UPDATE opcoes set ativo='f'")or die(mysql_error());
	mysql_query("UPDATE opcoes set ativo='t' where id_enquete=$id_ENQUETE")or die(mysql_error());
  
  return (mysql_affected_rows() > 0) ? true : false; 
}


function insertCandidato($id_ENQUETE){
 
  if(isset($_POST[ativo])){                          //Testa se o form foi postado
		
    foreach($_POST[ativo] as $key){  
      $Result = mysql_query("SELECT max(candidato.id_candidato) as soma FROM candidato WHERE candidato.id_enquete=$id_ENQUETE");
      $idCandidato = mysql_result($Result,0);
      if ($idCandidato < 0 ){
	  	$idCandidato = 1;
	  	}else{
	  	$idCandidato ++ ;
	  	}
	  		$sql = mysql_query("SELECT candidato.nome FROM candidato WHERE candidato.nome='$key' and candidato.id_enquete=$id_ENQUETE")or die(mysql_error());
	  		$result_c = mysql_result($sql,0);
	  		if ($result_c != $key){
	  			mysql_query("INSERT INTO candidato (id_candidato,nome,id_enquete,ativo) VALUES ($idCandidato,'$key',$id_ENQUETE,'t')")or die(mysql_error()); 			
	  			}     
    }
    echo '<h1>Incluir Candidatos</h1>';	
    echo "<div class='msg'>";   
    echo "Candidatos incluidos!<br>";
    echo '<input class="botao" name="Voltar" type="button" value="Voltar" onClick="JavaScript: window.history.go(-2);">'; 
    echo "</div>";
  } else {                                            //se não foi postado imprime o form
    ?>
    <html>
      <body>
        <h1>Inserir Candidatos</h1>   
    	<div class="habilita">    
        <form method="post" action="<?=$PHP_SELF;?>" name="habilita">
        <?php 
         if ($id_ENQUETE == '1'){
    		   $sexo = 'Masculino';
    		 }elseif($id_ENQUETE == '2'){
    		   $sexo = 'Masculino';
    		 }elseif($id_ENQUETE == '3'){
    		   $sexo = 'Feminino';
    		 }
       
          $query = mysql_query("SELECT * FROM eleitores WHERE sexo = '$sexo' order by eleitores.nome") or die(msql_error());

          while($row = mysql_fetch_assoc($query)){
            $nome_list     = $row["nome"];
            $ativo         = $row["ativo"];
    				$sql = mysql_query("SELECT candidato.nome FROM candidato WHERE candidato.nome='$nome_list' and id_enquete =$id_ENQUETE ") or die(mysql_error());
    				$nome_c = mysql_result($sql, 0);
    				if ($nome_c == $nome_list){
    					$checked = 'checked';
    					$abilita = 'DISABLED';
    				}else{
    					$checked = '';
    					$abilita = '';
    				}     	
             echo "<input type='checkbox' name='ativo[]' value='$nome_list' $checked $abilita />$nome_list<br>";              
          }
         ?>
         <table class="resulta">
    		<tr>
    			<td>
    				<input class="botao" type="submit" value="Incluir">
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

function insertEleitor($info) {
	 $count = 1;                          //Contador para auxiliar na colocação das virgula
  foreach($info as $key=>$value){
    $fields .= $key;                   //Montagem da query
    $values .= "'".$value."'";         //Montagem da query
    if($count < sizeof($info)){
      $fields .= ",";                  //Inserção das virgulas
      $values .= ",";                  //Inserção das virgulas
    }
    $count++;
  }

  mysql_query("INSERT INTO eleitores ($fields,ativo) VALUES ($values,'f')")or die(mysql_error());       //Realização da query

  return (mysql_affected_rows() == 1) ? true : false; 

	}

function insertUrna($info,$table){
  $count = 1;                          //Contador para auxiliar na colocação das virgula
  foreach($info as $key=>$value){
    $fields .= $key;                   //Montagem da query
    $values .= "'".$value."'";         //Montagem da query
    if($count < sizeof($info)){
      $fields .= ",";                  //Inserção das virgulas
      $values .= ",";                  //Inserção das virgulas
    }
    $count++;
  }
  
  mysql_query("INSERT INTO $table($fields) VALUES($values)");                    //Realização da query
  return (mysql_affected_rows() == 1) ? true : false;                            //Testa se a linha foi inserida no BD
}

function insertEleicao($info,$table){
  $count = 1;                          //Contador para auxiliar na colocação das virgula
  foreach($info as $key=>$value){
    $fields .= $key;                   //Montagem da query
    $values .= "'".$value."'";         //Montagem da query
    if($count < sizeof($info)){
      $fields .= ",";                  //Inserção das virgulas
      $values .= ",";                  //Inserção das virgulas
    }
    $count++;
  }

  $sql = "SELECT max(opcoes.id_enquete)+1 as soma FROM opcoes";
  $Result = mysql_query($sql);
  $idEnquete = mysql_result($Result,0);
  if($idEnquete == null ){
      $idEnquete = '1';
  }

  mysql_query("INSERT INTO $table($fields,id_enquete) VALUES($values,$idEnquete)");                         //Realização da query
  mysql_query("INSERT INTO candidato(id_candidato,nome,id_enquete,ativo) VALUES(0,'Nulo',$idEnquete,'f')"); //Realização da query
  return (mysql_affected_rows() == 1) ? true : false;                                                       //Testa se a linha foi inserida no BD
}
?>
