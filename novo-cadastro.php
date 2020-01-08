<?php require("../../includes/topo.php"); ?>

<?php
@session_start();
$_SESSION['aguarda_endereco_nr'] = md5(time());

$editx=0;
$edit=0;
if(isset($id)){
  $sql = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");  
  $ln = $db->expand($sql);
  $edit=1;
}
?>

<script>







</script>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">CADASTROS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
      <?php
        if($edit==1){
          echo $ln['cli_nome'];
        } else {
          echo 'NOVO CADASTRO';
        }
      ?>
  </h6>
</div>


<form method="post" action="controlers/cadastros/salva_cadastro01.php">
<div class="row">

<div class="col-md-12">  

            <ul class="nav nav-activity-profile">
            
                <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="1">Dados Principais</a></li>
                
                <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="2">HISTÓRICO DE LOCAÇÕES</a></li>

                <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="3">FINANCEIRO</a></li>

              
            </ul>


<div class="section-wrapper">


      
      <input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

      <div class="form-layout">
      <div class="row">

          <div class="row tabs" id="tab1">
              
              <div class="col-lg-2">
                <div class="form-group">                  
                  <label class="form-control-label">TIPO: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="cli_tipo" onchange="javascript:muda_mascara_campo(this.value);" required>
                    <?php

                      $cli_tipo = $ln['cli_tipo'];

                      if ($edit==1) {

                          if($cli_tipo==1){
                            echo '<option value="1" selected>FÍSICO</option><option value="0">JURÍDICO</option>';
                          } else {
                            echo '<option value="0" selected>JURÍDICO</option><option value="1">FISÍCO</option>';
                          }



                      }else{

                          echo '
                            <option value="">-------------</option>
                            <option value="1">FISÍCO</option>
                            <option value="0">JURÍDICO</option>
                          ';
                        
                      }
                      
                    ?>

                    
                  </select>
                </div>
              </div><!-- col-4 -->




              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">CPF/CNPJ: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  id="cli_cpf"  name="cli_cpf" required="required" value="<?php if($edit==1){ echo $ln['cli_cpf'];} ?>" onblur="javascript:valida_cpf_cnpj(this.value);">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-7">
                <div class="form-group">
                  <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="cli_nome" required="required" value="<?php if($edit==1){ echo $ln['cli_nome'];} ?>">
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Celular:</label>
                  <input class="form-control" type="text" data-mask="(00) 0.0000-0000" name="cli_celular" required="required" value="<?php if($edit==1){ echo $ln['cli_celular'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Telefone:</label>
                  <input class="form-control" type="text" data-mask="(00) 0000-0000" name="cli_fone" value="<?php if($edit==1){ echo $ln['cli_fone'];} ?>">
                </div>
              </div><!-- col-4 -->

               <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Contato:</label>
                  <input class="form-control" type="text" name="cli_contato" required="required" value="<?php if($edit==1){ echo $ln['cli_contato'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">E-mail:</label>
                  <input class="form-control" type="text" name="cli_email" required="required" value="<?php if($edit==1){ echo $ln['cli_email'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-12">
            <div class="form-layout-footer" >
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>        
              <button type="submit" name="retorno" value="1" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>      
            </div>
          </div>

      </div>
             

      </div>


</div>


  
  <div class="row tabs" id="tab2">

      <?php if($edit==1){ ?>
        
        <a href="nova-locacao-cliente/<?php echo $id; ?>"><button style="margin-top: -20px" type="button" class="btn btn-primary btn-sm  pull-right">NOVA LOCAÇÃO PARA O CLIENTE</button></a>

      <?php } ?>
  
      <div class="table-responsive" <?php if($edit==1){ echo 'style="margin-top: 20px"'; } ?>>
                <table class="table mg-b-0 tx-13">
                  <thead>
                     <tr class="tx-10">
                      <th class="pd-y-5" width="10"></th>    
                      <th class="pd-y-5" width="20">CÓD</th>    
                      <th class="pd-y-5" width="110">LOCAÇÃO</th>                              
                      <th class="pd-y-5" width="110">RETIRADA</th>                              
                      <th class="pd-y-5" >CLIENTE/ENDEREÇO</th>                                                    
                      <th class="pd-y-5" >TAMANHO/EQUIP.</th>                             
                      <th class="pd-y-5" >STATUS</th>                           
                      <th class="pd-y-5" width="100">VALOR</th>                             

                      <th width="40" class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                

                  
                     <?php
                if($edit==1){    

                $hoje = date("Y-m-d"); 

                     $sel = $db->select("SELECT locacoes.*, clientes.cli_nome, clientes_enderecos.cli_endereco, clientes_enderecos.cli_num, tipo_cacambas.tipo_cacamba, cacambas.cacamba FROM locacoes 
                      LEFT JOIN clientes ON locacoes.id_cliente=clientes.id
                      LEFT JOIN clientes_enderecos ON locacoes.id_endereco=clientes_enderecos.id
                      LEFT JOIN tipo_cacambas ON locacoes.tamanho=tipo_cacambas.id_tipo_cacamba
                      LEFT JOIN cacambas ON locacoes.equipamento=cacambas.id
                      WHERE locacoes.id_cliente='$id'
                      ORDER BY locacoes.status, locacoes.data_locacao DESC");
                    
                    if($db->rows($sel)){
                      $x=1; 
                      while($yy = $db->expand($sel)){  

                        $total = ($total+$yy['preco']);

                         $status='<span class="tx-success">EM VIGÊNCIA</span>';
                   
                         if($yy['retirada_data']!='0000-00-00'){
                            $status='<span class="tx-info">CONCLUÍDO</span>';
                        
                         } else if($yy['equipamento']=='0'){
                            $status='<span class="tx-warning">AGUARDANDO</span>';
                         
                         } else if($yy['data_retirada']<$hoje){
                            $status='<span class="tx-danger">RET. ATRASADA</span>';
                         }
                    ?>    

                    <tr>
                     
                      <td class="valign-middle upper">
                          <input type="checkbox" id="pago<?php echo $yy['id']; ?>" <?php if($yy['pago']==1){echo 'checked';} ?> onclick="javascript:marca_pago(<?php echo $yy['id']; ?>);">
                      </td>   
                      <td class="valign-middle upper">#<?php echo $yy['id']; ?></td>   
                      <td class="valign-middle upper"><?php echo data_mysql_para_user($yy['data_locacao']); ?></td>


                      <?php
                        if($yy['retirada_data']!='0000-00-00'){
                      ?>

                        <td class="valign-middle upper"><?php echo data_mysql_para_user($yy['retirada_data']); ?></td>

                      <?php
                        } else {
                      ?>
                        <td class="valign-middle upper">---------------</td>
                      <?php
                        } 
                      ?>

                      


                     <td class="valign-middle upper"><?php echo $yy['cli_nome']; ?><br><?php echo $yy['cli_endereco'].', '.$yy['cli_num']; ?></td>
                      
                      <td class="valign-middle upper"><?php echo $yy['tipo_cacamba'].'<br>(<b>EQUIP: </b>'.$yy['cacamba']; ?>)</td> 

                      <td class="valign-middle upper"><?php echo $status; ?></td> 

                      <td class="valign-middle upper">R$ <?php echo number_format($yy['preco'],2,",","."); ?></td> 
                        

                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">

                            <a target="_blank" href="imprime-locacao/<?php echo $yy['id']; ?>" class="nav-link"><i class="icon fa fa-print"></i> Imprimir</a> 
                            
                            <?php
                              if($yy['equipamento']!=0 && $yy['retirada_data']=='0000-00-00'){
                            ?>
                              <a href="retirada-loc-cli/<?php echo $yy['id']; ?>/<?php echo $id; ?>" class="nav-link"><i class="icon fa fa-calendar-check-o"></i> Retirada</a>                            

                            <?
                              } else if($yy['equipamento']!=0){
                            ?>        

                            <a href="reativar-loc-cli/<?php echo $yy['id']; ?>/<?php echo $id; ?>" class="nav-link"><i class="icon fa fa-check-square-o"></i> Reativar</a>             

                            <?
                              } 
                            ?> 


                            <?php
                              if($yy['retirada_data']=='0000-00-00'){
                            ?>
                              <a href="locacoes/edit-loc-cli/<?php echo $yy['id']; ?>/<?php echo $id; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar</a>
                            <?php
                              } else {
                            ?>
                              <a href="retirada-loc-cli/<?php echo $yy['id']; ?>/<?php echo $id; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Retirada</a>
                            <?php
                              } 
                            ?>
                            
                            <a href="controlers/servicos/apaga_locacao.php?id=<?php echo $yy['id']; ?>&cliente=<?php echo $id; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir</a>                            
                          </nav>
                        </div>
                      </td>


                    </tr>


                   


                    <?php
                      if($yy['retirada_data']!='0000-00-00'){

                          $xp = $yy['retirada_classificacao'];
                          $bomb = $db->select("SELECT * FROM classificacoes WHERE id='$xp' LIMIT 1");
                          $pen = $db->expand($bomb);
                          $cla = $pen['classificacao'];

                          $mot = $yy['retirada_motorista'];
                          $jnn = $db->select("SELECT mot_nome FROM motoristas WHERE id='$mot' LIMIT 1");
                          $epa = $db->expand($jnn);

                          $mot2 = $yy['motorista'];
                          $jnn2 = $db->select("SELECT mot_nome FROM motoristas WHERE id='$mot2' LIMIT 1");
                          $epa2 = $db->expand($jnn2);


                    ?>

                      <tr>
                          <td style="border-top: 0; padding-top: 0" colspan="4"></td>
                          <td style="border-top: 0; padding-top: 0" colspan="5" class="upper">
                              <b>MOTORISTA ENTREGA: </b ><?php echo $epa2['mot_nome']; ?><br>  

                              <b>CTR: </b><?php echo $yy['retirada_ctr']; ?><br>
                              <b>RETIRADA CTR: </b ><?php echo $cla; ?><br>
                              <b>MOTORISTA RETIRADA: </b ><?php echo $epa['mot_nome']; ?><br>
                          </td>
                      </tr>  


                      <tr style="display: none;">
                          <td style="border-top: 0; padding-top: 0" colspan="4"></td>
                          <td style="border-top: 0; padding-top: 0" colspan="10">
                              
                          <div class="row row-xs">


                            <div class="col-md-3">
                              <b style="color:#00008C">RECEBIMENTO:</b><br>
                              <input class="form-control" type="date" name="data_recebido" id="data_recebido<?php echo $yy['id']; ?>" value="<?php  echo $yy['data_recebido']; ?>">
                            </div>
                            
                            <div class="col-md-2">  
                              <b style="color:#00008C">&nbsp;</b><br>
                              <input class="form-control valores" type="text" name="valor_recebido" id="valor_recebido<?php echo $yy['id']; ?>" value="<?php  echo $yy['valor_recebido']; ?>" placeholder="R$ 0.00"> 
                            </div>
                            
                            <div class="col-md-3">  
                              <b style="color:#00008C">&nbsp;</b><br>
                              <select  class="form-control select2" name="forma_recebido" id="forma_recebido<?php echo $yy['id']; ?>" >
                                  
                                  <?php
                                            
                                            if($yy['forma_recebido']!=''){

                                              $forma_recebido = $yy['forma_recebido'];
                                              echo '<option value="'.$forma_recebido.'">'.$forma_recebido.'</option>';                                              

                                              echo '<option value="DINHEIRO">DINHEIRO</option>';
                                              echo '<option value="CARTÃO">CARTÃO</option>';
                                              echo '<option value="BOLETO">BOLETO</option>';
                                              echo '<option value="DEPÓSITO">DEPÓSITO</option>';
                                              echo '<option value="CHEQUE">CHEQUE</option>';
                                              

                                            }  else {

                                              echo '<option value="">------FORMA DE PGTO-------</option>';

                                              echo '<option value="DINHEIRO">DINHEIRO</option>';
                                              echo '<option value="CARTÃO">CARTÃO</option>';
                                              echo '<option value="BOLETO">BOLETO</option>';
                                              echo '<option value="DEPÓSITO">DEPÓSITO</option>';
                                              echo '<option value="CHEQUE">CHEQUE</option>';

                                            }
                                          
                                      ?>                                
                                     
                                </select> 
                              </div>  

                              <div class="col-md-3">
                              <b style="color:#00008C">&nbsp;</b><br>
                              <input class="form-control" type="text" placeholder="Nome Recebedor" name="nome_recebido" id="nome_recebido<?php echo $yy['id']; ?>" value="<?php  echo $yy['nome_recebido']; ?>">
                            </div>

                              <div class="col-md-1">  
                                <b style="color:red">&nbsp;</b><br>
                                <button id="btyy<?php echo $yy['id']; ?>" class="btn btn-primary btn-block" type="button" onclick="javascript:salva_pgto(<?php echo $yy['id']; ?>)">OK</button>
                              </div>

                          </div>

                          </td>
                      </tr>

                    <?php
                      }
                    ?>





                  
                  <?php
                    }

                     echo '<tr>';
                        echo '<td colspan="6" align="center"></td>';
                        echo '<td colspan="3" align="right"><h5>Total R$ '.number_format($total,2,",",".").'</h5></td>';
                      echo '</tr>';
                    
                  } else {

                      echo '<tr>';
                        echo '<td colspan="10" align="center">NENHUMA LOCAÇÃO ENCONTRADA PARA O CLIENTE.</td>';
                      echo '</tr>';

                  }

                }
                  ?>  

                  </tbody>
                </table>
              </div>





  </div>









  <div class="row tabs" id="tab3">
    <div class="col-md-12" >

      <?php if($edit==1){ ?>

      <a href="novo-lancamento/<?php echo $id; ?>"><button style="margin-top: -20px" type="button" class="btn btn-primary btn-sm  pull-left">NOVO LANÇAMENTO</button></a>  
        
       
      <div class="table-responsive" style="margin-top: 20px; width: 100%;">
                <table class="table mg-b-0 tx-13" >
                  <thead>
                     <tr >
                      
                      <th width="5%">CÓD</th>    
                      <th  width="10%">DATA</th>                              
                      <th width="45%"  >MOTIVO</th>                           
                      <th width="20%"  >FORMA PGTO</th>                           
                      <th  width="15%">VALOR</th>                             

                      <th width="5%" class=" tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                

                  
                     <?php
                     $total=0;
                if($edit==1){    

                $hoje = date("Y-m-d"); 

                     $sel = $db->select("SELECT * FROM financeiro
                      WHERE id_cliente='$id'
                      ORDER BY id DESC");
                    
                    if($db->rows($sel)){
                      $x=1; 
                      while($yy = $db->expand($sel)){  

                        $total = ($total+$yy['valor']);

                        
                    ?>    

                    <tr>
                     
                        
                      <td class="valign-middle upper">#<?php echo $yy['id']; ?></td>   
                      <td class="valign-middle upper"><?php echo data_mysql_para_user($yy['data']); ?></td>
                      <td class="valign-middle upper"><?php echo $yy['motivo']; ?></td> 
                      <td class="valign-middle upper"><?php echo $yy['forma']; ?></td>   

                      <td class="valign-middle upper">R$ <?php echo number_format($yy['valor'],2,",","."); ?></td> 
                        

                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            
                            <a href="controlers/cadastros/apaga_lancamento.php?id=<?php echo $yy['id']; ?>&cliente=<?php echo $id; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir</a>                            
                          </nav>
                        </div>
                      </td>


                    </tr>


                   

                  <?php
                    }

                     echo '<tr>';
                        
                        echo '<td colspan="13" align="right"><h5>Total R$ '.number_format($total,2,",",".").'</h5></td>';
                      echo '</tr>';
                    
                  } else {

                      echo '<tr>';
                        echo '<td colspan="10" align="center">NENHUM LANÇAMENTO ENCONTRADO PARA O CLIENTE.</td>';
                      echo '</tr>';

                  }

                }
                  ?>  

                  </tbody>
                </table>
              </div>



              <?php } ?>

  </div>


  

  </div>      
</div>




<div class="slim-pageheader" style="margin-top: 40px">
  <ol class="breadcrumb slim-breadcrumb">
  <a href="javascript:void(0)" onclick="javascript:novo_endereco(0,<?php echo $id; ?>);"><button type="button" name="retorno" class="btn btn-primary bd-0 ">INSERIR NOVO ENDEREÇO</button></a>   
  </ol>
  <h6 class="slim-pagetitle upper">
      ENDEREÇOS DO CLIENTE   

  </h6>
</div>


<div class="row row-sm">        
<div class="col-lg-12" id="reload_enderecos">
  
  
            

              <?php require("listagem/lista_enderecos_clientes.php"); ?>
              

</div>
</div>




</div>


</div>
</form>




<?php require("../../includes/rodape.php"); ?>

