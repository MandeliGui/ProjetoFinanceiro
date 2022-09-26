<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';
$objdao = new CategoriaDAO;
$categorias = $objdao->ConsultarCategoria();

if (isset($_GET['filtro']) && $_GET['filtro'] != '') {
    $filtro = $_GET['filtro'];
    $filtros = $objdao->FiltrarCategoria($filtro);
}
else if (isset($_POST['btn_pesquisar'])) {
    $filtro = $_POST['filtro'];
    $filtros = $objdao->FiltrarCategoria($filtro);
}

if (isset($filtros) && count($filtros) == 0) {
    $ret = 5;
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Consultar Categorias</h2>
                        <h5>Nessa pagina voce pode consultar as categorias cadastradas. </h5>
                        <form action="consultar_categoria.php" method="post">
                            <div class="form-group input-group">
                                <input id="pesquisa" type="text" class="form-control" placeholder="Filtrar Categoria" onkeyup="FiltrarCategoria(this.value)" name="filtro" value="<?= isset($filtro) ? $filtro : '' ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="btn_pesquisar"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php if (isset($filtros) && count($filtros) == 0) {
                } else {  ?>
                    <hr />
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Categorias Cadastradas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Categorias</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (isset($filtros)) {

                                            for ($i = 0; $i < count($filtros); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $filtros[$i]['nome_categoria'] ?></td>
                                                    <td>
                                                        <a href='alterar_categoria.php?cod=<?= $categorias[$i]['id_categoria'] ?>' class='btn btn-warning btn-sm'>Editar</a>
                                                    </td>

                                                </tr>
                                            <?php }
                                        } else {
                                            for ($i = 0; $i < count($categorias); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $categorias[$i]['nome_categoria'] ?></td>
                                                    <td>
                                                        <a href='alterar_categoria.php?cod=<?= $categorias[$i]['id_categoria'] ?>' class='btn btn-warning btn-sm'>Editar</a>
                                                    </td>
                                                </tr>
                                    <?php }
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

</body>

</html>