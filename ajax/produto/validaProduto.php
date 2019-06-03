<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Produto.php');

$ds_post          = file_get_contents("php://input");
$arrFiltros       = json_decode($ds_post, true);

$objProduto = new Produto();
$arrProdutos = $objProduto->getProdutos($arrFiltros);

if($arrProdutos == null){
   $arrProdutos = array();
}

echo json_encode($arrProdutos);