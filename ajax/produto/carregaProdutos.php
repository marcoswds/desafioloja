<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Produto.php');

$objProduto = new Produto();
$arrProdutos = $objProduto->getProdutos();

echo json_encode($arrProdutos);
