

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-docs"></i>
            <span>Cartório</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo RAIZ . "cartorio/atualizaCartorio"; ?>">Atualiza Cartorio Excel</a>
           
        </li>
      
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <a onclick="window.history.go(-1)" class="btn btn-fit-height grey-salt dropdown-toggle"><i class="fa fa-reply"></i> Voltar </a>
        </div>
    </div>
</div>
<!-- FIM TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->

<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">




        <!-- ALERTAS -->
        <?php require HELPER . "mensagem.php"; ?>
        <!-- FIM ALERTAS -->


        <div class="tab-pane" >
            <div class="portlet box blue-madison" style="border-radius: 4px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i> - Atualizar Cartório via Excel </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->

                    <form action="<?php echo CONTROLLER . 'cartorio.php'; ?>" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="arrDadosForm[method]" value="atualizaExcel">
                        <div class="form-body">
                            <h3 class="form-section">Informação Pessoal</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Escolha o arquivo Excel <span class="required" aria-required="true">*</span></label>
                                        <input type="file" id="file" name="file"  accept=".xlsx" class="form-control" required>
                                        <span class="help-block"> Apenas arquivo XLSX </span>
                                    </div>
                                </div>
                         
                            </div>

                            <div class="form-actions right">
                                <button type="button" class="btn default btn-circle">Cancelar</button>
                                <button type="submit" class="btn blue-madison btn-circle">
                                    <i class="fa fa-check"></i> Salvar</button>
                            </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>




    </div>
</div>




<script>
    $(document).ready(function () {




    });




</script>
