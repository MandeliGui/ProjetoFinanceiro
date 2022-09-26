<?php
require_once "../DAO/UsuarioDAO.php";
if(isset($_POST['btn_entrar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $objdao = new UsuarioDAO();
    $ret = $objdao->ValidarLogin($email, $senha);
    
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Controle Financeiro : Acesso</h2>

                <h5>( faça seu login )</h5>
                <br />
                <?php include_once "_msg.php"; ?>
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Entre com seus dados </strong>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Seu E-mail" name="email" id="email"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Sua Senha" name="senha" id="senha"/>
                            </div>
                            <button href="index.html" onclick="return ValidarLogin()" class="btn btn-primary " name="btn_entrar">Entrar</button>
                            <hr />
                            Não tem Cadastro ? <a href="cadastro.php">clique aqui </a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>