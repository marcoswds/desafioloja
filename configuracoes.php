<?php
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);
$arrDadosConexao = array();

//Conexao
$arrDadosConexao['ipConexao']           = '127.0.0.1';
$arrDadosConexao['hostConexao']         = 'root';
$arrDadosConexao['passConexao']         = '';
$arrDadosConexao['baseConexao']         = 'loja';
$arrDadosConexao['nrTentativasConexao'] = 2;

//Joga ambos na Session
$_SESSION['arrDadosConexao'] = $arrDadosConexao;

date_default_timezone_set('America/Sao_Paulo');
?>