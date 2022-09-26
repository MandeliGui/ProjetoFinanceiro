<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";
$dao = new EmpresaDAO;
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idEmpresa = $_POST['cod'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $objdao = new EmpresaDAO();
    $ret = $objdao->AlterarEmpresa($nome, $telefone, $endereco, $idEmpresa);
    header('location: consultar_empresa.php?ret=' . $ret);
} else if (isset($_POST['btn_excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->DeletarEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
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
                        <h2>Alterar dados da empresa</h2>
                        <h5>Nessa pagina voce poderá alterar os dados da empresa. </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <div class="form-group" id="val_nome">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                        <label>Nome da Empresa*</label>
                        <input class="form-control" placeholder="Nova Empresa" name="nome" id="nome" value="<?= $dados[0]['nome_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" placeholder="Telefone da empresa" name="telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Endereço da empresa" name="endereco" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarEmpresa()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Confirma a exclusão da empresa: <strong><?= $dados[0]['nome_empresa'] ?></strong> ?
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