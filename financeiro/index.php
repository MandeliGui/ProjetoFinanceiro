<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/ContaDAO.php';

$obj = new MovimentoDAO;
$dao_conta = new ContaDAO;

$entradas = $obj->TodasEntradas();
$saidas = $obj->TodasSaidas();
$saldo = $dao_conta->ConsultarConta();
$movs = $obj->MostrarUltimosLancamentos();
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
                        <?php
                        include_once "_msg.php"; ?>
                        <h2>Página Inicial</h2>
                        <h5>Aqui voce tem um parametro geral dos seus lançamentos</h5>

                    </div>
                </div>
                <hr />
                <div class="row">

                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?= number_format($entradas[0]['total'], 2, ',', '.') ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Total de Entradas

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?= number_format($saidas[0]['total'], 2, ',', '.') ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Total de Saídas

                            </div>
                        </div>
                    </div>

                </div>


                <?php if (count($movs) > 0) { ?>
                    <hr>
                    <div class="panel panel-default col-mo-12">
                        <div class="panel-heading">
                            Ultimos movimentos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Tipo</th>
                                            <th>Categoria</th>
                                            <th>Empresa</th>
                                            <th>Conta</th>
                                            <th>Valor</th>
                                            <th>Observações</th>


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
                                                    <td><?= $movs[$i]['nome_categoria'] ?></td>
                                                    <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                    <td><?= $movs[$i]['banco_conta'] ?></td>
                                                    <td style="color:<?= $movs[$i]['tipo_movimento'] == 1 ? "green" : "red" ?> ;">R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                    <td><?= $movs[$i]['obs_movimento'] ?></td>

                                                </tr>
                                            </tbody>
                                    <?php }
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <center><label style="color:<?= $total > 0 ? "green" : "red" ?> ;">Total: R$ <?= isset($total) ? number_format($total, 2, ',', '.') : '--' ?></label></center>
                <?php } else { ?>
                    <hr>
                    <center>
                        <div class="alert alert-info">
                            Não existem movimentos realizados.
                        </div>
                    </center>
                <?php } ?>
            </div>
</body>

</html>