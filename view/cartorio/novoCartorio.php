

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-docs"></i>
            <span>Cartório</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo RAIZ . "cartorio/atualizaCartorio"; ?>">Novo Cartório</a>

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
                        <i class="fa fa-file-text-o"></i> - Novo Cartório </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->

                    <form action="<?php echo CONTROLLER . 'cartorio.php'; ?>" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="arrDadosForm[method]" value="cadastrarCartorio">
                        <div class="form-body">
                            <h3 class="form-section">Dados Cadastrais</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_nome]"   class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Razao<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_razao]"   class="form-control" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tipo Documento<span class="required" aria-required="true">*</span></label>
                                        <input type="number"  name="arrDadosForm[int_tipo_documento]"  min='0' class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">N° Documento<span class="required" aria-required="true">*</span></label>
                                        <input type="number"  name="arrDadosForm[str_documento]"  min='0' class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Cep<span class="required" aria-required="true">*</span></label>
                                        <input type="number"  name="arrDadosForm[str_cep]"   class="form-control" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Endereço<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_endereco]"  class="form-control" required>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Bairro<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_bairro]"  min='0' class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cidade<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_cidade]"  min='0' class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Estado<span class="required" aria-required="true">*</span></label>
                                        <select class="bs-select form-control" data-live-search="true" name="arrDadosForm[id_estado]" data-size="5" required>
                                            <?php echo $oController->combolistar('estado', 'id_estado', 'str_nome'); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telefone</label>
                                        <input type="number" min='0'  name="arrDadosForm[str_telefone]"   class="form-control" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email"  name="arrDadosForm[str_email]"  min='0' class="form-control" >

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tabelião<span class="required" aria-required="true">*</span></label>
                                        <input type="text"  name="arrDadosForm[str_tabeliao]"  min='0' class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Situação<span class="required" aria-required="true">*</span></label>
                                        <select class="bs-select form-control" data-live-search="true" name="arrDadosForm[int_status]" data-size="5" required>
                                            <option value=""></option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>

                                        </select>
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
