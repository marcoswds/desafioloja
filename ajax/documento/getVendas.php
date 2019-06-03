<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Documento.php');

$objDocumento = new Documento();
$arrVendas = $objDocumento->getVendas();

echo json_encode($arrVendas);