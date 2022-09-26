<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

if(isset($_POST['btn_gravar'])){
    $nome = $_POST['nome'];
    $objdao = new CategoriaDAO();

    $ret = $objdao->CadastrarCategoria($nome);
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
                        <h2>Nova Categoria</h2>
                        <h5>Nessa pagina voce poderá cadastrar todas as suas categorias. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                    <div class="form-group" id="val_nome">
                        <label>Nova Categoria</label>
                        <input class="form-control" placeholder="Nova Categoria: Ex. Conta de Luz" name="nome" id="nome"/>
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>