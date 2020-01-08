<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM locacoes WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RETIRADA</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo 'LOCAÇÃO Nº '.$ln['id'];
  			} 
  		?>
  </h6>
</div>


<form method="post" action="controlers/servicos/salva_retirada.php" autocomplete="off">
<div class="row">	


<div class="col-md-12">	
<div class="section-wrapper">

		<div class="form-layout">
      		<div class="row mg-b-25">


                  <input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

                  <input class="form-control" type="hidden" name="cliente" value="<?php if(isset($cliente)){echo $cliente;} ?>">
      			   
                    
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">DATA RETIRADA: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="date" name="retirada_data" required="required" value="<?php if($edit==1){ if($ln['retirada_data']=='0000-00-00') { echo date("Y-m-d"); } else {echo $ln['retirada_data'];}}  ?>" >
                          </div>
                        </div><!-- col-4 -->  


                        <div class="col-lg-4">
                          <div class="form-group">
                          <label class="form-control-label">CTR:</label>
                           <input class="form-control" type="text" name="retirada_ctr" required="required" value="<?php if($edit==1){ echo $ln['retirada_ctr'];} ?>" >
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                          <label class="form-control-label">ÁREA:</label>

                            <select class="form-control select2 upper" name="retirada_area" required> 
                                   
                                       <?php
                                            

                                            if($edit==1){

                                              $area = $ln['retirada_area'];

                                            $sel = $db->select("SELECT id, area FROM descarte WHERE id='$area' LIMIT 1");
                                            if($db->rows($sel)){
                                              $yy = $db->expand($sel);  
                                              echo '<option value="'.$yy['id'].'" selected>'.$yy['area'].'</option>';
                                            } else {
                                                echo '<option value="">-------------</option>';
                                            }

                                              $sel = $db->select("SELECT id, area FROM descarte WHERE id!='$area' ORDER BY area");
                                              if($db->rows($sel)){                                      
                                                  while($yy = $db->expand($sel)){  
                                                    echo '<option value="'.$yy['id'].'">'.$yy['area'].'</option>';
                                                  }
                                              }
                                              

                                            } 
                                          
                                      ?>
                                    </select> 

                          
                          </div>
                        </div>    

                        
                    

                              <div class="col-lg-6">
                                <div class="form-group">
                                <label class="form-control-label">CLASSIFICAÇÃO:</label>
                                 <select  class="form-control select2" name="retirada_classificacao" >
                                  
                                  <?php
                                            

                                            if($ln['retirada_classificacao']!=0){

                                              $cla = $ln['retirada_classificacao'];
                                              $sel = $db->select("SELECT * FROM classificacoes WHERE id='$cla' LIMIT 1");
                                              $yy = $db->expand($sel);  
                                              echo '<option value="'.$yy['id'].'" selected>'.$yy['classificacao'].'</option>';

                                              $sel = $db->select("SELECT * FROM classificacoes WHERE id!='$cla' ORDER BY id");
                                              if($db->rows($sel)){                                      
                                                  while($yy = $db->expand($sel)){  
                                                    echo '<option value="'.$yy['id'].'">'.$yy['classificacao'].'</option>';
                                                  }
                                              }
                                              

                                            }  else {

                                              echo '<option value="">-------------</option>';

                                              $sel = $db->select("SELECT * FROM classificacoes ORDER BY id");
                                              if($db->rows($sel)){                                      
                                                  while($yy = $db->expand($sel)){  
                                                    echo '<option value="'.$yy['id'].'">'.$yy['classificacao'].'</option>';
                                                  }
                                              }

                                            }
                                          
                                      ?>
                                  
                                     
                                  </select>
                                </div>
                              </div>    
              	           
                               <div class="col-lg-3">
                                  <div class="form-group">
                                  <label class="form-control-label">MOTORISTA:</label>
                                   <select class="form-control select2 upper" name="retirada_motorista">
                                   
                                       <?php
                                            

                                            if($edit==1){

                                              $motorista = $ln['retirada_motorista'];
                                              $sel = $db->select("SELECT mot_nome, id FROM motoristas WHERE id='$motorista' LIMIT 1");
                                              $yy = $db->expand($sel);  
                                              echo '<option value="'.$yy['id'].'" selected>'.$yy['mot_nome'].'</option>';

                                              $sel = $db->select("SELECT mot_nome, id FROM motoristas WHERE id!='$motorista' ORDER BY mot_nome");
                                              if($db->rows($sel)){                                      
                                                  while($yy = $db->expand($sel)){  
                                                    echo '<option value="'.$yy['id'].'">'.$yy['mot_nome'].'</option>';
                                                  }
                                              }
                                              

                                            } 
                                          
                                      ?>
                                    </select>
                                  </div>
                                </div> 


                                <div class="col-lg-3">

                                  <div class="form-group">
                                  <label class="form-control-label">PLACA VEÍCULO:</label>

                                   <select class="form-control select2 upper" name="retirada_placa_veiculo" required> 
                                   
                                       <?php
                                            

                                            if($edit==1){

                                              $placa = $ln['retirada_placa_veiculo'];

                                              $sel = $db->select("SELECT placa, veiculo FROM veiculos WHERE placa='$placa' LIMIT 1");
                                              if($db->rows($sel)){
                                              $yy = $db->expand($sel);  
                                              echo '<option value="'.$yy['placa'].'" selected>'.$yy['placa'].' - ('.$yy['veiculo'].')</option>';
                                            } else {
                                                echo '<option value="">-------------</option>';
                                            }

                                              $sel = $db->select("SELECT placa, veiculo FROM veiculos WHERE placa!='$placa' ORDER BY placa");
                                              if($db->rows($sel)){                                      
                                                  while($yy = $db->expand($sel)){  
                                                    echo '<option value="'.$yy['placa'].'">'.$yy['placa'].' - ('.$yy['veiculo'].')</option>';
                                                  }
                                              }
                                              

                                            } 
                                          
                                      ?>
                                    </select> 

                                   
                                  </div>
                                </div> 

                             


      		</div>

      		<div class="form-layout-footer">
      		  
              <button type="submit" class="btn btn-primary bd-0">SALVAR RETIRADA</button>        
              
            </div>
      	</div>		

</div>
</div>	


 <div class="col-md-12" style="margin-top: 20px">
    <button type="button" class="btn btn-danger bd-0" onclick="javascript:history.go(-1);">VOLTAR</button>   
  </div>  



</div>
</form>

<?php require("../../includes/rodape.php"); ?>







