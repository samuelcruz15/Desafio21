<?php
$sqlCartorio = $oCartorio->listarCartorios();
?>


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-docs"></i>
            <span>Cartórios</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>

            <a href="<?php echo RAIZ . "cartorio/listarCartorios"; ?>">Listagem de Cartórios</a>
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

        <div class="portlet light ">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list "></i>
                    <span class="caption-subject sbold uppercase">Listagem de Cartórios</span>
                </div>
                <div class="actions">
                    <a href="novoCartorio">
                        <button type="button" class="btn btn-success btn-circle" >
                            <i class="fa fa-user-plus"></i> Novo registro
                        </button></a>
                </div>
            </div>
            <div class="portlet-body" id="pagina">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th style="width: 5% !important;" class="text-center">Ação</th>
                            <th>Estado</th>
                            <th>Nome</th>
                            <th>Razao</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Tabeliao</th>
                            <th>Tipo documento</th>
                            <th>Cep</th>
                            <th>Endereço</th>
                            <th>Bairro</th>
                            <th>Cidade</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($dadosCartorio = mysqli_fetch_array($sqlCartorio)) { ?>
                            <tr>
                                <td>
                                    <div class="btn-toolbar" style="margin-left:0px !important;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?php echo $dadosCartorio['id_cartorio']; ?>" data-target='#editarCartorio' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div> 
                                        <div style="float: right !important;" > <!-- class="btn-group"  -->
                                            <?php
                                            if ($dadosCartorio['int_status'] == '0') { #Desativado
                                                $classIcon = 'fa fa-remove';
                                                $msgAcao = 'Ativar Cartório?';
                                                $corBtn = 'btn btn-danger';
                                            } else { // Ativado
                                                $classIcon = 'fa fa-check-square';
                                                $msgAcao = 'Desativar Cartório?';
                                                $corBtn = 'btn btn-success';
                                            }
                                            ?>
                                            <form action="<?php echo CONTROLLER . 'cartorio.php'; ?>" method="POST">
                                                <button type="submit" class="<?php echo $corBtn; ?> btn-xs mod" data-toggle="confirmation" data-original-title="<?php echo $msgAcao; ?>">
                                                    <input type='hidden' name='arrDadosForm[int_status]' value="<?php echo $dadosCartorio['int_status']; ?>" />
                                                    <input type='hidden' name='arrDadosForm[id]' value="<?php echo $dadosCartorio['id_cartorio']; ?>" />
                                                    <input type="hidden" name="arrDadosForm[tabela]" value="cartorio" />
                                                    <input type="hidden" name="arrDadosForm[campo_where]" value="id_cartorio" />
                                                    <input type="hidden" name="arrDadosForm[method]" value="desativarAtivar" />
                                                    <i class="<?php echo $classIcon; ?>"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $oController->retornoIdUF(1, $dadosCartorio['id_estado']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_nome']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_razao']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_telefone']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_email']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_tabeliao']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['int_tipo_documento']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_cep']); ?></td> 
                                <td><?php echo utf8_encode($dadosCartorio['str_endereco']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_bairro']); ?></td>
                                <td><?php echo utf8_encode($dadosCartorio['str_cidade']); ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>



    </div>
</div>
<?php
include 'modal/editarCartorio.php';
?>


<script>
    $(document).ready(function () {

        $('#editarCartorio').on('show.bs.modal', function (e) {
            var id_cartorio = $(e.relatedTarget).data('doc');

            $.ajax({
                type: 'POST',
                data: 'id_cartorio=' + id_cartorio + '&method=listarCartorios&acao=ajax',
                url: '<?php echo CONTROLLER; ?>cartorio.php',
                success: function (data) {
                    var response = $.parseJSON(data);
                    $("#id_cartorio").val(response.id_cartorio);
                    //$("#id_estado").val(response.id_estado);
                     $("#id_estado").val(response.id_estado).attr('selected','selected');
                    $("#str_nome").val(response.str_nome);
                    $("#str_razao").val(response.str_razao);
                    $("#int_tipo_documento").val(response.int_tipo_documento);
                    $("#str_documento").val(response.str_documento);
                    $("#str_cep").val(response.str_cep);
                    $("#str_endereco").val(response.str_endereco);
                    $("#str_bairro").val(response.str_bairro);
                    $("#str_cidade").val(response.str_cidade);
                    $("#str_telefone").val(response.str_telefone);
                    $("#str_email").val(response.str_email);
                    $("#str_tabeliao").val(response.str_tabeliao);
                   // $("#int_status").val(response.int_status);
                   $("#int_status").val(response.int_status).attr('selected','selected');
                    

                }
            });
        });

        // Pulsante da Mensagem de Sucesso ou Erro
        UIGeneral.init();

    });

</script>