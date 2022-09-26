<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/ContaDAO.php";

if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();
    $ret = $objdao->CadastrarConta($nome, $agencia, $conta, $saldo);
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
                        <h2>Nova Conta</h2>
                        <h5>Nessa pagina voce poderá cadastrar todas as suas contas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="post">
                    <div class="form-group" id="val_nome">
                        <label>Nome do Banco*</label>
                        <input class="form-control" placeholder="Nome do banco" name="nome" id="nome"/>
                    </div>
                    <div class="form-group" id="val_agencia">
                        <label>Agencia*</label>
                        <input class="form-control" onkeypress="onlynumber()" placeholder="Agencia" name="agencia" id="agencia"/>
                    </div>
                    <div class="form-group" id="val_conta">
                        <label>Numero da Conta*</label>
                        <input class="form-control" onkeypress="onlynumber()" placeholder="Numero da Conta" name="conta" id="conta"/>
                    </div>
                    <div class="form-group" id="val_saldo">
                        <label>Saldo inicial*</label>
                        <input class="form-control" onkeypress="onlynumber()" placeholder="Saldo inicial da conta" name="saldo" id="saldo"/>
                    </div>
                    <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>