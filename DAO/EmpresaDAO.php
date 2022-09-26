<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';


class EmpresaDAO extends Conexao
{
    public function ConsultarEmpresa($nome, $tipo)
    {
        $conexao = parent::retornaConexao();
        if ($tipo == "1") {

            $comando_sql = "SELECT id_empresa, nome_empresa,telefone_empresa, endereco_empresa
                              FROM tb_empresa
                             WHERE id_usuario = ?
                             and nome_empresa LIKE ?";
        } else if (trim($tipo) == "2") {

            $comando_sql = "SELECT id_empresa, nome_empresa,telefone_empresa, endereco_empresa
                              FROM tb_empresa
                             WHERE id_usuario = ?
                             and telefone_empresa LIKE ?";
        } else if (trim($tipo) == "3") {

            $comando_sql = "SELECT id_empresa, nome_empresa,telefone_empresa, endereco_empresa
                              FROM tb_empresa
                             WHERE id_usuario = ?
                             and endereco_empresa LIKE ?";
        } else if($tipo != '' && $nome ==''){

            $comando_sql = "SELECT id_empresa,nome_empresa, telefone_empresa, endereco_empresa
                          FROM tb_empresa 
                         WHERE id_usuario = ?
                         and endereco_empresa LIKE ?";
        }else{
            $comando_sql = "SELECT id_empresa,nome_empresa, telefone_empresa, endereco_empresa
                          FROM tb_empresa 
                         WHERE id_usuario = ?";
        }
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        if ($nome != '' && $tipo != '') {
            $sql->bindValue(2, '%' . $nome . '%');
        }else if($tipo != '' && $nome ==''){
            $sql->bindValue(2, '%' . $nome . '%');
        }
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
    public function CadastrarEmpresa($nome, $tel, $end)
    {
        if (trim($nome) == '') {
            return 0;
        }
        # 1- Verifica conexão
        $conexão = parent::retornaConexao();
        # 2- Insere o comando no banco de dados
        $comando_sql = 'INSERT INTO tb_empresa (nome_empresa, telefone_empresa, endereco_empresa, id_usuario) values (?, ?, ?, ?)';
        # 3- Faço nem ideia
        $sql = new PDOStatement();
        # 4- Prerando o comando conexão
        $sql = $conexão->prepare($comando_sql);
        # 5- Bindando os ? com os dados
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $tel);
        $sql->bindValue(3, $end);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function DetalharEmpresa($idEmpresa)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa
                        from tb_empresa
                        where id_empresa = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function AlterarEmpresa($nome, $telefone, $endereco, $idEmpresa)
    {
        if (trim($nome) == '' || $idEmpresa == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_empresa
                        set nome_empresa = ?,
                        telefone_empresa = ?,
                        endereco_empresa = ?
                        where id_empresa = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function DeletarEmpresa($idEmpresa)
    {
        if ($idEmpresa == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_empresa 
                        where id_empresa = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return 4;
        }
    }
}
