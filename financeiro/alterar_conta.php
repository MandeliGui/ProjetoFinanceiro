<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/ContaDAO.php";
$dao = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idConta = $_POST['cod'];
    $nome = $_POST['nome'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();
    $ret = $objdao->AlterarConta($nome, $agencia, $conta, $saldo, $idConta);
    header('location: consultar_conta.php?ret=' . $ret);
} else if (isset($_POST['btn_excluir'])) {
    $idConta = $_POST['cod'];
    $ret = $dao->DeletarConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
} else {
    header('location: consultar_empresa.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<?php
include_once '_head.php';
?>

<body>
    <?php
    include_once '_topo.php';
    include_once '_menu.php';
    ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Alterar Conta</h2>
                        <h5>Nessa pagina você poderá alterar suas contas. </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_conta.php" method="post">
                    <div class="form-group" id="val_nome">

                        <label>Nome do Banco</label>
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                        <input class="form-control" placeholder="Nome do banco" name="nome" id="nome" value="<?= $dados[0]['banco_conta'] ?>" />
                    </div>
                    <div class="form-group" id="val_agencia">
                        <label>Agencia*</label>
                        <input class="form-control" placeholder="Agencia" name="agencia" onkeypress="onlynumber()" id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" />
                    </div>
                    <div class="form-group" id="val_conta">
                        <label>Numero da Conta*</label>
                        <input class="form-control" placeholder="Numero da Conta" name="conta" onkeypress="onlynumber()" id="conta" value="<?= $dados[0]['numero_conta'] ?>" />
                    </div>
                    <div class="form-group" id="val_saldo">
                        <label>Saldo</label>
                        <input readonly class="form-control" placeholder="Saldo inicial da conta" name='saldo' id="saldo" value="<?= $dados[0]['saldo_conta'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Confirma a exclusão da conta: <strong><?= $dados[0]['banco_conta'] . ' / ' . $dados[0]['agencia_conta'] . ' / ' . $dados[0]['numero_conta'] ?></strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btn_excluir">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>