<?php
require_once "../DAO/UsuarioDAO.php";
if(isset($_POST['btn_cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rsenha = $_POST['rsenha'];
    $objdao = new UsuarioDAO();
    $ret = $objdao -> CadastroUsuario($nome, $email, $senha, $rsenha);
    header('location: login.php?ret=' . $ret);
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php' ?>
                <h2> Controle Financeiro : Cadastro</h2>

                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencha todos os campos </strong>
                    </div>
                    <div class="panel-body">
                        <form action="cadastro.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Seu Nome" name="nome" id="nome"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" placeholder="Seu E-mail" name="email" id="email"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Senha (mínimo 6 caracteres)" name="senha" id="senha"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Repita a Senha" name="rsenha" id="rsenha"/>
                            </div>

                            <button name="btn_cadastrar" onclick="return ValidarCadastro()" class="btn btn-success ">Cadastrar</button>
                            <hr />
                            Já tem cadastro ? <a href="login.php">Entre aqui</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>