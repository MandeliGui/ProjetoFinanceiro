<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';
$objdao = new ContaDAO;
$conta = $objdao->ConsultarConta();
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
                        <h2>Consultar Contas</h2>
                        <h5>Nessa pagina voce pode consultar as contas cadastradas. </h5>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contas Cadastradas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Banco</th>
                                        <th>Agencia</th>
                                        <th>Conta</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    for($i = 0; $i<count($conta); $i++){
                                    
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?= $conta[$i]['banco_conta'] ?></td>
                                        <td><?= $conta[$i]['agencia_conta'] ?></td>
                                        <td><?= $conta[$i]['numero_conta'] ?></td>
                                        <td><?= $conta[$i]['saldo_conta'] ?></td>
                                        <td>
                                            <a href="alterar_conta.php?cod=<?= $conta[$i]['id_conta'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>