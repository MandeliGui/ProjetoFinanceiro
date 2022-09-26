<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao{
    public function ConsultarCategoria(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_categoria,nome_categoria 
                          FROM tb_categoria 
                         WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        
        return $sql->fetchAll();
    }
    
    public function DetalharCategoria($idCategoria){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_categoria, nome_categoria
                    from tb_categoria
                    where id_categoria = ?
                    and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();

    }

    public function AlterarCategoria($nome, $idCategoria){
        if(trim($nome) == '' || $idCategoria == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_categoria
                        set nome_categoria = ?
                        where id_categoria = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idCategoria);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
        echo $ex->getMessage();
            return -1;
        }
    }

    public function DeletarCategoria($idCategoria){
        if($idCategoria==''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_categoria
                        where id_categoria = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,$idCategoria);
        $sql->bindValue(2,UtilDAO::CodigoLogado());

        try{
            $sql->execute();

            return 1;
        }catch(Exception $ex){
           return 4;
        }
    }   

    public function FiltrarCategoria($filtro){
        $conexao = parent::retornaConexao();
        $comando_sql = "SELECT id_categoria, nome_categoria
                        FROM tb_categoria
                        WHERE nome_categoria LIKE ?
                        and id_usuario = ?";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, '%' . $filtro . '%');
        $sql->bindValue(2,UtilDAO::CodigoLogado());
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
        
        
    }
    
    
    
    
    
    
    public function CadastrarCategoria($nome){

        if(trim($nome)==''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_categoria (nome_categoria, id_usuario) values(?, ?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $nome);

        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }
}