<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $objdao = new EmpresaDAO();
    $ret = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <h2>Nova Empresa</h2>
                        <h5>Nessa pagina voce poderá cadastrar todas as empresas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group" id="val_nome">
                        <label>Nome da Empresa*</label>
                        <input class="form-control" placeholder="Nome da empresa..." name="nome" id="nome"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" placeholder="Telefone da empresa (opcional)" name="telefone" id="telefone"/>
                    </div>
                    <div class="form-group">
                        <label>Endereço da Empresa</label>
                        <input class="form-control" placeholder="Endereço da empresa (opcional)" name="endereco" id="endereco"/>
                    </div>
                    <button type="submit" onclick="return ValidarEmpresa()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>