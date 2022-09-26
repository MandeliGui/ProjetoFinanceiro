<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/MovimentoDAO.php";



$tipo = '';
$parametro = '';



$objdao = new MovimentoDAO();


if (isset($_POST['btn_pesquisar'])) {
    $valor = $_POST['valor'];
    if ($valor == '') {
        $movs = 0;
    }
    $tipo = $_POST['tipo'];
    $parametro = $_POST['parametro'];
    $dataini = $_POST['dataini'];
    $datafim = $_POST['datafim'];

    $movs = $objdao->FiltrarPorValor($valor, $parametro, $tipo, $dataini, $datafim);
} else if (isset($_POST['btn_excluir'])) {
    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $valor = $_POST['valor'];
    $del_tipo = $_POST['tipo'];
    $ret = $objdao->DeletarMovimento($idMov, $idConta, $valor, $del_tipo);
}



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Consultar movimentos por valor</h2>
                        <h5>Nessa pagina voce pode consultar os movimentos bancarios. </h5>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="consultar_movimento_valor.php" method="post">
                    <div class="col-md-6" >
                        <div class="form-group" id="val_valor">
                            <label>Valor R$</label>
                            <input class="form-control" type="text" onkeypress="onlynumber()" name="valor" id="valor" placeholder="Valor R$" value="<?= isset($valor) ? $valor : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Parâmetro</label>
                            <select class="form-control" name="parametro">
                                <option value="0" <?= $parametro == 0 ? 'selected' : '' ?>>Igual</option>
                                <option value="1" <?= $parametro == 1 ? 'selected' : '' ?>>Abaixo</option>
                                <option value="2" <?= $parametro == 2 ? 'selected' : '' ?>>Acima</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo de Movimento</label>
                            <select class="form-control" name="tipo">
                                <option value="0" <?= $tipo == 0 ? 'selected' : '' ?>>Todos</option>
                                <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="val_dataini">
                            <label>Data Inicial*</label>
                            <input type="date" class="form-control" placeholder="data inicial" name="dataini" id="dataini" value="<?= isset($dataini) ? $dataini : '' ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="val_datafim">
                            <label>Data Final*</label>
                            <input type="date" class="form-control" placeholder="data final" name="datafim" id="datafim" value="<?= isset($datafim) ? $datafim : '' ?>" />
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-info" onclick="return ConsultarMovimentoValor()" name="btn_pesquisar">Pesquisar</button>

                    </center>
                </form>
                <?php if (isset($movs) && $movs != 0) { ?>
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Movimentos Realizados
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Tipo</th>
                                            <th>Valor</th>
                                            <th>Conta</th>
                                            <th>Empresa</th>
                                            <th>Ação</th>

                                        </tr>
                                    </thead>
                                    <?php if (isset($movs)) {
                                        $total = 0;
                                        for ($i = 0; $i < count($movs); $i++) {
                                            if ($movs[$i]['tipo_movimento'] == 1) {
                                                $total = $total + $movs[$i]['valor_movimento'];
                                            } else {
                                                $total = $total - $movs[$i]['valor_movimento'];
                                            } ?>

                                            <tbody>
                                                <tr class="odd gradeX">
                                                    <td><?= $movs[$i]['data_movimento'] ?></td>
                                                    <td><?= $movs[$i]['tipo_movimento'] == 1 ? "Entrada" : "Saida" ?></td>
                                                    <td style="color:<?= $movs[$i]['tipo_movimento'] == 1 ? "green" : "red" ?> ;">R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                    <td><?= $movs[$i]['banco_conta'] . ' / ' . $movs[$i]['agencia_conta'] . ' / ' . $movs[$i]['numero_conta'] ?></td>
                                                    <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                    <td>
                                                        <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?= $i ?>">Excluir</a>
                                                        <form action="consultar_movimento_valor.php" method="post">
                                                            <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                            <input type="hidden" name="idConta" value="<?= $movs[$i]['id_conta'] ?>">
                                                            <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">
                                                            <input type="hidden" name="tipo" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                            <div class="modal fade" id="myModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Confirma a exclusão do movimento? <br><br>
                                                                            <strong>Data do Movimento:</strong> <?= $movs[$i]['data_movimento'] ?> <br>
                                                                            <strong>Tipo do Movimento:</strong> <?= $movs[$i]['tipo_movimento'] == 1 ? "Entrada" : "Saida" ?> <br>
                                                                            <strong>Empresa:</strong> <?= $movs[$i]['nome_empresa'] ?> <br>
                                                                            <strong>Valor do Movimento:</strong> R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-primary" name="btn_excluir">Excluir</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php }
                                    } ?>
                                </table>
                                <center><label style="color:<?= $total > 0 ? "green" : "red" ?> ;">Total: R$ <?= isset($total) ? number_format($total, 2, ',', '.') : '--' ?></label></center>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>