<?php
require_once '../DAO/UtilDAO.php';

if (isset($_GET['close']) && $_GET['close'] == 1) {
    UtilDAO::Deslogar();
}


?>




<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a href="index.php"><i class="fa fa-bar-chart-o fa-3x"></i> Início</a>
            </li>


            <li>
                <a href="meus_dados.php"><i class="fa fa-user fa-3x"></i> Meus Dados</a>
            </li>



            <li>
                <a href="#"><i class="fa fa-book fa-3x"></i> Categoria<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php">Nova Categoria</a>
                    </li>
                    <li>
                        <a href="consultar_categoria.php">Consultar Categoria</a>
                    </li>
                </ul>
            <li>
                <a href="#"><i class="fa fa-building-o fa-3x"></i> Empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php">Nova Empresa</a>
                    </li>
                    <li>
                        <a href="consultar_empresa.php">Consultar Empresa</a>
                    </li>
            </li>
        </ul>
        <li>
            <a href="#"><i class="fa fa-home fa-3x"></i> Conta<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="nova_conta.php">Nova Conta</a>
                </li>
                <li>
                    <a href="consultar_conta.php">Consultar Conta</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-dollar fa-3x"></i> Movimento<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="realizar_movimento.php">Realizar Movimento</a>
                </li>
                <li>
                    <a href="consultar_movimento.php">Consultar movimento</a>
                </li>
                <li>
                    <a href="consultar_movimento_empresa.php">Consultar por empresa</a>
                </li>
                <li>
                    <a href="consultar_movimento_valor.php">Consultar por valor</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="_menu.php?close=1"><i class="fa fa-square-o fa-3x"></i> Sair</a>
        </li>
    </div>

</nav>