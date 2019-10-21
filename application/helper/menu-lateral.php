<?php
    define('DESKTOP', 'visible-md visible-lg visible-sm hidden-xs');
    define('MOBILE', 'visible-xs hidden-sm hidden-md hidden-lg');
?>
<script>
    function sair(){ 
        $(document).ready(function() {
            $('.openForm').click(function(event) {
                event.preventDefault();
                $form = $('#transport');

                // Extrai os dados dos atributos customizados do link tirando o prefixo "data-"
                var data = extractData(this); 

                // Preenche os dados no form
                for(var attr in data) {
                    $form.find('input[name="' + attr + '"]').val(data[attr]);
                }

                // Atualiza o action do form com o href do link
                $form.attr('action', this.href);

                // Submete o form
                $form.submit();
            });
        });
        <form action="#" method="post" style="display:none" id="transport">
            <input type="hidden" name="method" />
            <input type="hidden" name="cliente" />
        </form>

</script>









<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-compact" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item start ">
                <a href="<?php echo RAIZ . "cartorio/mapaCartorio"; ?>" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                    <span class="arrow"></span>
                </a> 
            </li>
            
              <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Cartório</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "cartorio/atualizaCartorio"; ?>" class="nav-link ">
                            <span class="title">Upload Arquivo Cartório XML</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "cartorio/listarCartorios"; ?>" class="nav-link ">
                            <span class="title">Listar Cartórios</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "cartorio/novoCartorio"; ?>" class="nav-link ">
                            <span class="title">Novo Cartório</span>
                        </a>
                    </li>
                      <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "cartorio/atualizaCartorioExce"; ?>" class="nav-link ">
                            <span class="title">Atualizar Cartório Excel</span>
                        </a>
                    </li>
                      <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "cartorio/mandaEmal"; ?>" class="nav-link ">
                            <span class="title">Enviar Email</span>
                        </a>
                    </li>
                 
                </ul>
            </li>
            
         
            
            
            
            
            
            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Administrador</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "usuario/listarUsuario"; ?>" class="nav-link ">
                            <i class="icon-users"></i>
                            <span class="title">Controle de Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "perfil/listarPerfil"; ?>" class="nav-link ">
                            <i class="icon-shield"></i>
                            <span class="title">Perfil de Usuário</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "modulo/listarModulo"; ?>" class="nav-link ">
                            <i class="icon-grid"></i>
                            <span class="title">Módulo do Sistema</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "view/listarView"; ?>" class="nav-link ">
                            <i class="icon-screen-desktop"></i>
                            <span class="title">Páginas do Sistema</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "acesso/listarAcesso"; ?>" class="nav-link ">
                            <i class="icon-lock-open"></i>
                            <span class="title">Permissões de Acesso</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?php echo RAIZ . "auditoria/auditoria-adm"; ?>" class="nav-link ">
                            <i class="icon-eye"></i>
                            <span class="title">Auditoria Adm</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item start ">
                <a href="<?php echo RAIZ . "inicio/manual"?>" class="nav-link nav-toggle">
                    <i class="icon-book-open"></i>
                    <span class="title">Manual do Sistema</span>
                    <span class="arrow"></span>
                </a>
            </li>
            
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
