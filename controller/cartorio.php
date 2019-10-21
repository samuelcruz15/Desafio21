<?php

@session_start();
//Substituir require_once por $_SESSION['PATH'];
require_once $_SESSION['PATH'] . 'model/MCartorio.php';

class Cartorio extends MCartorio {

    function cargaXML() {

        ini_set('max_execution_time', 500);
        //Definindo o tipo da acao
        $opcaoAcao = $_POST['opcao'];

        $xml = simplexml_load_file($_FILES['file']['tmp_name']);
        $contADD = 0;
        $contUPDATE = 0;
        $parAdd = 0;
        foreach ($xml->cartorio as $cartorio) {
            //motando array para insert ou update
            $arrDados = Array();
            $arrDados['tabela'] = 'cartorio';
            $arrDados['str_nome'] = $this->validaString(utf8_decode($cartorio->nome));
            $arrDados['str_razao'] = $this->validaString(utf8_decode($cartorio->razao));
            $arrDados['int_tipo_documento'] = $this->validaString(utf8_decode($cartorio->tipo_documento));
            $arrDados['str_documento'] = trim($this->validaString(utf8_decode($cartorio->documento)));
            $arrDados['str_cep'] = $this->validaString(utf8_decode($cartorio->cep));
            $arrDados['str_endereco'] = $this->validaString(utf8_decode($cartorio->endereco));
            $arrDados['str_bairro'] = $this->validaString(utf8_decode($cartorio->bairro));
            $arrDados['str_cidade'] = $this->validaString(utf8_decode($cartorio->cidade));
            $arrDados['str_tabeliao'] = $this->validaString(utf8_decode($cartorio->tabeliao));
            $arrDados['int_status'] = $this->validaString(utf8_decode($cartorio->ativo));
            $arrDados['id_estado'] = $this->retornoIdUF(2, $cartorio->uf);

            if ($opcaoAcao == 1 || $opcaoAcao == 3) {

                $documento = trim($cartorio->documento);
                //verificando se ja existi o cartorio pelo documento
                $checkCartorio = $this->select_check('cartorio', 'str_documento', "'$documento'");

                if ($checkCartorio == 0) {
                    //insercao                             
                    $insercao = $this->insert($arrDados);

                    if ($insercao == true) {

                        $contADD++;
                        $parAdd = 1;
                    }
                }
            }
            if ($opcaoAcao == 2 || $opcaoAcao == 3) {

                if ($parAdd == 0) {
                    //adicionando parametros para update
                    $arrDados['id'] = $arrDados['str_documento'];
                    $arrDados['campo_where'] = 'str_documento';
                    $update = $this->update($arrDados);
                    if ($update == true) {

                        $contUPDATE++;
                    }
                }
            }

            $parAdd = 0;
        }
        //Montando mensagem
        if ($contADD > 0 || $contUPDATE > 0) {

            if ($contADD > 0) {
                $msg1 = " <b>Inserção</b> de $contADD dados <br>";
            }
            if ($contUPDATE > 0) {
                $msg2 = " <b>Atualização</b> de $contUPDATE dados";
            }

            $msgFinal = "As seguintes ações foram feitas: $msg1 $msg2";
            $this->redirect(17, 'cartorio/listarCartorios', $msgFinal);
        } else {
            $this->redirect(16, 'cartorio/listarCartorios');
        }
    }

    function listarCartorios() {
        if (isset($_POST['acao'])) {
            $id = $_POST['id_cartorio'];
            $result = $this->listaDados('cartorio', $id, null, 'id_cartorio');

            while ($arDados = mysqli_fetch_array($result)) {
                $arr['id_cartorio'] = $arDados['id_cartorio'];
                $arr['id_estado'] = $arDados['id_estado'];
                $arr['str_nome'] = utf8_encode($arDados['str_nome']);
                $arr['str_razao'] = utf8_encode($arDados['str_razao']);
                $arr['int_tipo_documento'] = $arDados['int_tipo_documento'];
                $arr['str_documento'] = utf8_encode($arDados['str_documento']);
                $arr['str_cep'] = utf8_encode($arDados['str_cep']);
                $arr['str_endereco'] = utf8_encode($arDados['str_endereco']);
                $arr['str_bairro'] = utf8_encode($arDados['str_bairro']);
                $arr['str_cidade'] = utf8_encode($arDados['str_cidade']);
                $arr['str_telefone'] = utf8_encode($arDados['str_telefone']);
                $arr['str_email'] = utf8_encode($arDados['str_email']);
                $arr['str_tabeliao'] = utf8_encode($arDados['str_tabeliao']);
                $arr['int_status'] = $arDados['int_status'];
            }

            echo json_encode($arr);
        } else {
            return $this->listaDados('cartorio');
        }
    }

    function desativarAtivar($arrDadosForm) {
        (($arrDadosForm['int_status'] == '0') ? $arrDadosForm['int_status'] = '1' : $arrDadosForm['int_status'] = '0' );

        $result = $this->update($arrDadosForm);

        $this->redirect('1', "cartorio/listarCartorios");
    }

    function atualizarCartorio() {
        var_dump($_POST);
        $arrDados = Array();

        $_POST['arrDadosForm']['str_nome'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_nome']));
        $_POST['arrDadosForm']['str_razao'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_razao']));
        $_POST['arrDadosForm']['str_endereco'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_endereco']));
        $_POST['arrDadosForm']['str_bairro'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_bairro']));
        $_POST['arrDadosForm']['str_cidade'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_cidade']));
        $_POST['arrDadosForm']['str_tabeliao'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_tabeliao']));


        $arrDados = $_POST['arrDadosForm'];

        $update = $this->update($arrDados);

        if ($update == true) {
            $this->redirect('1', "cartorio/listarCartorios");
        } else {
            $this->redirect('2', "cartorio/listarCartorios");
        }
    }

    function cadastrarCartorio() {


        $arrDados = Array();

        $_POST['arrDadosForm']['str_nome'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_nome']));
        $_POST['arrDadosForm']['str_razao'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_razao']));
        $_POST['arrDadosForm']['str_endereco'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_endereco']));
        $_POST['arrDadosForm']['str_bairro'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_bairro']));
        $_POST['arrDadosForm']['str_cidade'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_cidade']));
        $_POST['arrDadosForm']['str_tabeliao'] = $this->validaString(utf8_decode($_POST['arrDadosForm']['str_tabeliao']));


        $arrDados = $_POST['arrDadosForm'];
        $arrDados['tabela'] = 'cartorio';
        $documento = $_POST['arrDadosForm']['str_documento'];
        //verificando se ja existi o cartorio pelo documento
        $checkCartorio = $this->select_check('cartorio', 'str_documento', "'$documento'");

        if ($checkCartorio == 0) {
            $cadastro = $this->insert($arrDados);
            if ($cadastro == true) {
                $this->redirect('1', "cartorio/listarCartorios");
            } else {
                $this->redirect('2', "cartorio/listarCartorios");
            }
        } else {
            $this->redirect('18', "cartorio/listarCartorios");
        }
    }

    function atualizaExcel() {
        require_once '../application/class/SimpleXLSX.php';
        ini_set('max_execution_time', 500);
        $caminho = '../public/anexo/';
        $uploadfile = $caminho . 'atualiza.xlsx';


        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $xlsx = SimpleXLSX::parse($uploadfile);
            $contADD = 0;
            $contUPDATE = 0;
            foreach ($xlsx->rows() as $k => $r) {
                if ($r[0] <> 'NOME') {

                    //Guardando valos em um array
                    $arr = array();
                    $arr['tabela'] = 'cartorio';
                    $arr['str_nome'] = $this->validaString(utf8_decode(trim($r[0])));
                    $arr['str_razao'] = $this->validaString(utf8_decode(trim($r[1])));
                    $arr['str_documento'] = $this->validaString(utf8_decode(trim($r[2])));
                    $arr['str_cep'] = $this->validaString(utf8_decode(trim($r[3])));
                    $arr['str_endereco'] = $this->validaString(utf8_decode(trim($r[4])));
                    $arr['str_bairro'] = $this->validaString(utf8_decode(trim($r[5])));
                    $arr['str_cidade'] = $this->validaString(utf8_decode(trim($r[6])));
                    $arr['id_estado'] = $this->retornoIdUF(2, $r[7]);
                    $arr['str_telefone'] = $this->validaString(utf8_decode(trim($r[8])));
                    $arr['str_email'] = $this->validaString(utf8_decode(trim($r[9])));
                    $arr['str_tabeliao'] = $this->validaString(utf8_decode(trim($r[10])));
                    if ($r[11] == 'SIM') {
                        $arr['int_status'] = '1';
                    } else {
                        $arr['int_status'] = '0';
                    }



                    $documento = trim($r[2]);
                    //verificando se ja existi o cartorio pelo documento
                    $checkCartorio = $this->select_check('cartorio', 'str_documento', "'$documento'");

                    if ($checkCartorio == 0) {
                        $insert = $this->insert($arr);
                        if ($insert == true) {
                            $contADD++;
                        }

                        break;
                    } else {
                        $arr['id'] = $arr['str_documento'];
                        unset($arr['str_documento']);
                        $arr['campo_where'] = 'str_documento';

                        $update = $this->update($arr);

                        if ($update == true) {

                            $contUPDATE++;
                        }
                    }
                }
            }

            //Montando mensagem
            if ($contADD > 0 || $contUPDATE > 0) {

                if ($contADD > 0) {
                    $msg1 = " <b>Inserção</b> de $contADD dados <br>";
                }
                if ($contUPDATE > 0) {
                    $msg2 = " <b>Atualização</b> de $contUPDATE dados";
                }

                $msgFinal = "As seguintes ações foram feitas: $msg1 $msg2";
                $this->redirect(17, 'cartorio/listarCartorios', $msgFinal);
            } else {
                $this->redirect(16, 'cartorio/listarCartorios');
            }
        } else {
            
        }
    }

}

$oCartorio = new Cartorio();
$classe = 'Cartorio';
$oBjeto = $oCartorio;
@include_once '../application/request.php';
?>