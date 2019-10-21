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

    function listarCartorios($par) {
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
        } elseif ($par != 'inicio') {
            $uf = explode('-', $par);
            $uf = $uf[1];
            $uf = $this->retornoIdUF(2, $uf);

            return $this->listaDados('cartorio', $uf, null, 'id_estado');
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

    function mandaEmail() {

        require_once '../application/class/PHPMailer/src/PHPMailer.php';
        require_once '../application/class/PHPMailer/src/SMTP.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'anoregsistema@gmail.com';
        $mail->Password = 'anoreg159';
        $mail->Port = 587;
        $mail->SMTPDebug = 3;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom('anoregsistema@gmail.com');

        $mail->addAddress('samuka10fute@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = utf8_decode($_POST['assunto']);
        $mail->Body = utf8_decode($_POST['conteudo']);

        if (!$mail->send()) {
            //  echo 'Não foi possível enviar a mensagem.<br>';
            // echo 'Erro: ' . $mail->ErrorInfo;
            $this->redirect('19', "cartorio/mandaEmal");
        } else {
            $this->redirect('20', "cartorio/mandaEmal");
        }
    }

    function mapa() {



        $consultaCartorios2 = $this->listarQntCartorios('cartorio');


        $maior_valor = 0;
        $menor_valor = 0;
        $local = '';
        $qtd = 0;
        while ($dados = mysqli_fetch_array($consultaCartorios2)) {

            if (empty($local)) {
                $local = $this->retornoIdUF(1, $dados['id_estado']);
                $qtd = $dados['total'];
            } else {
                $local = $local . '-' . $this->retornoIdUF(1, $dados['id_estado']);
                $qtd = $qtd . '-' . $dados['total'];
            }


            if ($dados['total'] > $maior_valor) {
                $maior_valor = $dados['total'];
            }
            if ($menor_valor == 0) {
                $menor_valor = $dados['total'];
            }
            if ($dados['total'] < $menor_valor) {
                $menor_valor = $dados['total'];
            }
        }

        $Locais = $local;
        $Qtd = $qtd;
        $maior_valor = $maior_valor;
        $menor_valor = $menor_valor;
        ?>
        <!-- Styles -->
        <style>
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>
        <!-- FIM Styles -->


        <!-- INICIO Estagiarios Ativos -->
        <script>
            //variáveis
            var i, arraylocais, arraytotal, maior_valor, menor_valor;
            //recebe a string com elementos separados, vindos do PHP
            arraylocais = "<?php echo $Locais; ?>";
            arraytotal = "<?php echo $Qtd; ?>";
            maior_valor = "<?php echo $maior_valor; ?>";
            menor_valor = "<?php echo $menor_valor; ?>";


            //transforma esta string em um array próprio do Javascript
            arraylocais = arraylocais.split("-");
            arraytotal = arraytotal.split("-");

            //alert( arraytotal);
            var map = AmCharts.makeChart("chartdiv", {
                "type": "map",
                "theme": "light",
                "colorSteps": 10,
                "dataProvider": {
                    "map": "brazilLow",
                    "getAreasFromMap": true,
                    "zoomLevel": 0.9,
                    //Posso usar id,value,description,percent
                    "areas": function() {
                        var dadosArray = [];
                        for (i in arraylocais) {
                            dadosArray.push({
                                "id": "BR-" + arraylocais[i],
                                "value": arraytotal[i],

                            })
                        }
                        return dadosArray;
                    }()
                },
                "areasSettings": {
                    "autoZoom": true,
                    "balloonText": "[[title]]:<strong>[[value]]</strong>",
                    "color": "#92D1C8",
                    "colorSolid": "#000000",
                    "rollOverOutlineColor": "#114669"
                },
                "legend": {
                    "width": 240,
                    "marginRight": 20,
                    "marginLeft": 20,
                    "equalWidths": true,
                    "maxColumns": 2,
                    "backgroundAlpha": 0.5,
                    "backgroundColor": "#FFFFFF",
                    "borderColor": "#ffffff",
                    "borderAlpha": 1,
                    "right": 0,
                    "horizontalGap": 10,
                    "switchable": true,
                    "data": (function() {
                        var dadosArray = [];
                        for (i in arraylocais) {
                            dadosArray.push({
                                "id": "BR-" + arraylocais[i],
                                "title": arraylocais[i] + ' - ' + arraytotal[i],
                                "color": "#83c2ba"

                            })
                        }
                        return dadosArray;
                    }())
                },
                "valueLegend": {
                    "right": 10,
                    "minValue": menor_valor,
                    "maxValue": maior_valor
                },
                "zoomControl": {
                    "minZoomLevel": 0.9
                },
                "titles": 'titles',
                "listeners": [{
                        "event": "clickMapObject",
                        "method": redir
                    }],
                "titles": [{
                        "text": "Cartórios por Estado",
                        "size": 15
                    }]
            });

            map.addListener('init', function() {
                //map.legend.switchable = true;
                map.legend.addListener("clickMarker", AmCharts.myHandleLegendClick);
                map.legend.addListener("clickLabel", AmCharts.myHandleLegendClick);
            });

            AmCharts.myHandleLegendClick = function(event) {
                var id = event.dataItem.id;
                if (undefined !== event.dataItem.hidden && event.dataItem.hidden) {
                    event.dataItem.hidden = false;
                    map.showGroup(id);
                } else {
                    event.dataItem.hidden = true;
                    map.hideGroup(id);
                }
                map.legend.validateNow();
            };

            function redir(event) {
                if (event) {
                    parent.window.location.href = "listarCartorios/" + event.mapObject.id;
                    //alert(event.mapObject.id);
                }
            }
            ;
            function updateHeatmap(event) {
                var map = event.chart;
                if (map.dataGenerated)
                    return;
                if (map.dataProvider.areas.length === 0) {
                    setTimeout(updateHeatmap, 100);
                    return;

                }

                /*
                 for ( var i = 0; i < map.dataProvider.areas.length; i++ ) {
                 map.dataProvider.areas[ i ].value = Math.round( i * 1 );
                 }*/
                map.dataGenerated = true;
                map.validateNow();
            }
            ;

        </script>
        <!-- FIM Estagiarios Ativos -->

        <?php
    }

}

$oCartorio = new Cartorio();
$classe = 'Cartorio';
$oBjeto = $oCartorio;
@include_once '../application/request.php';
?>