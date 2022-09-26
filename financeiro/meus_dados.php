<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once "../DAO/UsuarioDAO.php";
$nome = '';
$email = '';
$objdao = new UsuarioDAO();


if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];


    $ret = $objdao->GravarMeusDados($nome, $email);
}

$dados = $objdao->CarregarMeusDados();
/*echo '<pre>';
print_r($dados);
echo '</pre>';*/
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
                        <?php
                        include_once "_msg.php";?>
                        <h2>Meus Dados</h2>
                        <h5>Nesta página, você pode alterar seus dados. </h5>

                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="post">
                    <div class="form-group " id="val_nome">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite seu nome" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>"/>
                    </div>
                    <div class="form-group" id="val_email">
                        <label>Email</label>
                        <input class="form-control" placeholder="Digite seu Email" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>"/>
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
</body>

</html>