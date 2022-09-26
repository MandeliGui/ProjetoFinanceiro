<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao{
    public function ConsultarConta(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta 
                          FROM tb_conta 
                         WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
    public function CadastrarConta($nome, $agencia, $conta, $saldo){
        if(trim($nome) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_conta (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) values (?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$agencia);
        $sql->bindValue(3,$conta);
        $sql->bindValue(4,$saldo);
        $sql->bindValue(5,UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function DetalharConta($idConta){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta
                        from tb_conta
                        where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function AlterarConta($nome, $agencia, $numero, $saldo, $idConta){
        if(trim($nome)=='' || trim($agencia)=='' || trim($numero)=='' || $idConta==''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_conta
                        set banco_conta = ?,
                            agencia_conta = ?,
                            numero_conta = ?,
                            saldo_conta = ?
                      where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);   
        $sql->bindValue(2, $agencia);   
        $sql->bindValue(3, $numero);   
        $sql->bindValue(4, $saldo);   
        $sql->bindValue(5, $idConta);   
        $sql->bindValue(6, UtilDAO::CodigoLogado());   

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function DeletarConta($idConta){
        if($idConta==''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_conta
                        where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,$idConta);
        $sql->bindValue(2,UtilDAO::CodigoLogado());
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return 4;
        }
    }
}
