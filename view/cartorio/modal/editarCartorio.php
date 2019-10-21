
<div class="modal fade bs-modal-lg" id="editarCartorio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>EDITAR CARTÓRIO</b></h4>
            </div>


            <div class="modal-body">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Dados gerais</h3>
                    </div>
                    <div class="panel-body">

                        <div id="resultModal" class="fetched-data">


                            <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                <form action="<?php echo CONTROLLER . 'cartorio.php'; ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="arrDadosForm[tabela]" value="cartorio">
                                    <input type="hidden" name="arrDadosForm[method]" value="atualizarCartorio">
                                    <input type="hidden" name="arrDadosForm[id]" id="id_cartorio">
                                    <input type="hidden" name="arrDadosForm[campo_where]" value='id_cartorio'>
                                    <div class="form-body">
                                        <h3 class="form-section">Dados Cadastrais</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nome<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_nome]" id="str_nome"  class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Razao<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_razao]" id="str_razao"  class="form-control" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Tipo Documento<span class="required" aria-required="true">*</span></label>
                                                    <input type="number"  name="arrDadosForm[int_tipo_documento]" id="int_tipo_documento" min='0' class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">N° Documento<span class="required" aria-required="true">*</span></label>
                                                    <input type="number"  name="arrDadosForm[str_documento]"  min='0' id="str_documento" class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Cep<span class="required" aria-required="true">*</span></label>
                                                    <input type="number"  name="arrDadosForm[str_cep]"  id="str_cep" class="form-control" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Endereço<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_endereco]" id="str_endereco"  class="form-control" required>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Bairro<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_bairro]" id="str_bairro" min='0' class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Cidade<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_cidade]" id="str_cidade" min='0' class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Estado<span class="required" aria-required="true">*</span></label>
                                                    <select class="form-control" data-live-search="true" id="id_estado" name="arrDadosForm[id_estado]" data-size="5" required>
                                                        <?php echo $oController->combolistar('estado', 'id_estado', 'str_nome'); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="number" min='0'  name="arrDadosForm[str_telefone]"  id="str_telefone" class="form-control" >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="email"  name="arrDadosForm[str_email]" id="str_email" min='0' class="form-control" >

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tabelião<span class="required" aria-required="true">*</span></label>
                                                    <input type="text"  name="arrDadosForm[str_tabeliao]" id="str_tabeliao" min='0' class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Situação<span class="required" aria-required="true">*</span></label>
                                                    <select class="form-control" data-live-search="true" id="int_status" name="arrDadosForm[int_status]" data-size="5" required>
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
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>