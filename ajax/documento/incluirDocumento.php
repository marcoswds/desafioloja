<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Documento.php');
$objDocumento = new Documento();
$arrDocumento = $objDocumento->incluirDocumento();

echo json_encode($arrDocumento);