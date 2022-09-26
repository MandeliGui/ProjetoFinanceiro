<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';
$objdao = new EmpresaDAO;
$pesquisa = '';
$tipo = '';

if (isset($_GET['filtro']) && trim($_GET['filtro'] != '') && isset($_GET['id']) && trim($_GET['id']) != '') {
    $pesquisa = trim($_GET['filtro']);
    $tipo = $_GET['id'];
    $empresas = $objdao->ConsultarEmpresa($pesquisa, $tipo);
}

if (isset($_POST['btn_filtrar'])) {


    $pesquisa = trim($_POST['pesquisa']);
    $tipo = $_POST['filtro'];
    $empresas = $objdao->ConsultarEmpresa($pesquisa, $tipo);
} else {
    $empresas = $objdao->ConsultarEmpresa($pesquisa, $tipo);
}
if (isset($empresas) && count($empresas) == 0) {
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
                        <?php include_once '_msg.php' ?>
                        <h2>Consultar empresas</h2>
                        <h5>Nessa pagina voce pode consultar as empresas cadastradas. </h5>


                    </div>
                </div>
                <!-- /. ROW  -->
                <form action="consultar_empresa.php" method="POST">
                    <div class="form-group">
                        <label>Tipo de Filtro</label>
                        <select class="form-control" name="filtro" id="id">
                            <option value="">--Selecione--</option>
                            <option value="1" <?= $tipo == "1" ? "selected" : '' ?>>Nome</option>
                            <option value="2" <?= $tipo == "2" ? "selected" : '' ?>>Telefone</option>
                            <option value="3" <?= $tipo == "3" ? "selected" : '' ?>>Endereço</option>
                        </select>
                        <br>
                        <div class="form-group input-group col-md-6">
                            <input type="text" class="form-control" id="pesquisa" name="pesquisa" onkeyup="FiltrarEmpresa(this.value)" value="<?= isset($pesquisa) ? $pesquisa : '' ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="btn_filtrar"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    
                </form>

            </div>
            <hr />
            <div class="panel panel-default">
                <div class="panel-heading">
                    Empresas Cadastradas
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>

                                <tr>
                                    <th>Nome da Empresa</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($empresas); $i++) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?= $empresas[$i]['nome_empresa'] ?></td>
                                        <td><?= $empresas[$i]['telefone_empresa'] ?></td>
                                        <td><?= $empresas[$i]['endereco_empresa'] ?></td>
                                        <td>
                                            <a href="alterar_empresa.php?cod=<?= $empresas[$i]['id_empresa'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                        </td>
                                    </tr>
                                <?php } ?>
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