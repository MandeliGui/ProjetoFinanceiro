<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao
{

    public function CarregarMeusDados()
    {
        $conexão = parent::retornaConexao();
        $comando_sql = 'select nome_usuario,
                               email_usuario
                               from tb_usuario
                               where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexão->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '') {
            return 0;
        }
        if($this->VerificarEmailDuplicadoMeusDados($email) != 0){
            return 6;
        }


        $conexão = parent::retornaConexao();
        $comando_sql = 'update tb_usuario set nome_usuario = ?, email_usuario = ?
                        where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexão->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ValidarLogin($email, $senha)
    {
        if ($email == '' || $senha == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_usuario, nome_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        $user = $sql->fetchAll();
        
        if(count($user)==0){
            return 7;
        }

        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::CriarSesao($cod, $nome);
        header('location: index.php');
    }
    public function CadastroUsuario($nome, $email, $senha, $rsenha)
    {
        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rsenha) == '') {
            return 0;
        }
        if (strlen(trim($senha)) < 6) {
            return 2;
        }
        if ($senha != $rsenha) {
            return 3;
        }
        if($this->VerificarEmailDuplicado($email) != 0){
            return 6;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_usuario (nome_usuario, email_usuario, senha_usuario, data_cadastro) values(?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function VerificarEmailDuplicado($email){
        if(trim($email)==''){
            return 0;
        }

        

        $conexao = parent::retornaConexao();
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];

    }
    public function VerificarEmailDuplicadoMeusDados($email){
        if(trim($email)==''){
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ? and id_usuario != ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];

    }

    
}