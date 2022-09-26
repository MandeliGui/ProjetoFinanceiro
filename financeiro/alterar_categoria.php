<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';
$dao = new CategoriaDAO();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
    $idCategoria = $_GET['cod'];
    $dados = $dao->DetalharCategoria($idCategoria);

    if(count($dados)==0){
        header('location: consultar_categoria.php');
    exit;
    }
}else if(isset($_POST['btn_salvar'])){
    $idCategoria = $_POST['cod'];
    $nome = $_POST['nome'];
    $ret = $dao->AlterarCategoria($nome, $idCategoria);
    header('location: consultar_categoria.php?ret=' . $ret);

}else if(isset($_POST['btn_excluir'])){
    $idCategoria = $_POST['cod'];
    $ret = $dao->DeletarCategoria($idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
}
else{
    header('location: consultar_categoria.php');
    exit;
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
                        <h2>Alterar Categoria</h2>
                        <?php include_once "_msg.php"; ?>
                        <h5>Nessa pagina voce poderá alterar suas categorias. </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_categoria.php" method="post">
                    <div class="form-group" id="val_nome">
                        <label>Categoria</label>
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                        <input class="form-control" placeholder="Nova Categoria: Ex. Conta de Luz" name="nome" id="nome" value="<?= $dados[0]['nome_categoria'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModal">Excluir</button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                        </div>
                                        <div class="modal-body">
                                        Confirma a exclusão da categoria: <strong><?=$dados[0]['nome_categoria']?></strong> ?
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