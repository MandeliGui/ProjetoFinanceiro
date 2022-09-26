<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/MovimentoDAO.php";
require_once "../DAO/CategoriaDAO.php";
require_once "../DAO/EmpresaDAO.php";
require_once "../DAO/ContaDAO.php";

$dao_cat = new CategoriaDAO();  
$dao_emp = new EmpresaDAO();
$dao_cont = new ContaDAO();

if (isset($_POST['btn_gravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objdao = new MovimentoDAO();
    $ret = $objdao->RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
    
}


$categoria = $dao_cat->ConsultarCategoria();
$empresa = $dao_emp->ConsultarEmpresa('','');
$conta = $dao_cont->ConsultarConta();

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
                        
                        <h2>Realizar Lançamento</h2>
                        <h5>Nessa pagina voce poderá realizar os lançamentos de entrada e saida. </h5>

                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="col-md-6">
                        <form action="realizar_movimento.php" method="post">
                            <div class="form-group" id="val_tipo">
                                <label>Tipo de Movimento*</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="">Selecione</option>
                                    <option value="1">Entrada</option>
                                    <option value="2">Saida</option>
                                </select>
                            </div>
                            <div class="form-group" id="val_data">
                                <label>Data*</label>
                                <input type="date" class="form-control" name="data" id="data" />
                            </div>
                            <div class="form-group" id="val_valor">
                                <label>Valor*</label>
                                <input type="text" onkeypress="return onlynumber()" class="form-control" placeholder="Valor R$" name="valor" id="valor" />
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="val_categoria">
                            <label>Categoria*</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach ($categoria as $item) { ?>
                                    <option value="<?= $item['id_categoria'] ?>">
                                        <?= $item['nome_categoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="val_empresa">
                            <label>Empresa*</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach ($empresa as $item) { ?>
                                    <option value="<?= $item['id_empresa'] ?>">
                                        <?= $item['nome_empresa'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="val_conta">
                            <label>Conta*</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach ($conta as $item) { ?>
                                    <option value="<?= $item['id_conta'] ?>">
                                        <?= $item['banco_conta'] . ', Agencia: ' . $item['agencia_conta'] . ' / ' . $item['numero_conta'] . ' - R$ ' . $item['saldo_conta'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações (opicional)</label>
                            <textarea class="form-control" rows="3" name="obs" id="obs"></textarea>
                        </div>
                        <button type="submit" onclick="return ValidarMovimento()" class="btn btn-success" name="btn_gravar">Gravar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>