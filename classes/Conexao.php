<?php

/**
 * Realiza conexao com o banco de dados e consultas
 * @package classes
 */
class Conexao
{
   private static $instance = null;
   private $conexao = null;

   private function __construct(){
      $this->iniciaConexao();
   }

   // Instancia
   protected static function getInstance(){

      if( Conexao::$instance == null ){
         Conexao::$instance = new Conexao();
      }

      return Conexao::$instance;
   }

   protected function getConexao(){
      if($this->conexao == false){
         $this->iniciaConexao();
      }

      // Verifica se a conexão ainda esta ativa
      if(mysqli_ping($this->conexao) == false){
         $this->iniciaConexao();
      }

      return $this->conexao;
   }

   // Tenta iniciar a conexao com a base
   private function iniciaConexao(){

      include_once('../../configuracoes.php');

      $arrDadosConexao = $_SESSION['arrDadosConexao'];
      $tentativasConexao = 0;
      $conexaoInterna = false;

      //Aumenta time limit
      set_time_limit($tentativasConexao * 40);

      // Tenta conectar
      while ($tentativasConexao < $arrDadosConexao['nrTentativasConexao'] && $conexaoInterna == false){
         $conexaoInterna = new mysqli(
            $arrDadosConexao['ipConexao'],
            $arrDadosConexao['hostConexao'],
            $arrDadosConexao['passConexao'],
            $arrDadosConexao['baseConexao']
         );
         $tentativasConexao++;
      }

      if($conexaoInterna == false){
         echo "Nao foi possivel se conectar com a base de dados.";
         die();
      }

      $this->conexao = $conexaoInterna;
   }

   // Realiza e retorna uma consulta
   protected function realizaConsulta($consulta){
      $arrResult = null;

      //Funcao usada no array_walk_recursive
      if(function_exists('codificar') == false){
         function codificar(&$item, $key){
            if(is_string($item) == true){
               $item = utf8_encode($item);
            }
         }
      }

      $resultSet = $this->executaQuery($consulta);

      if($resultSet == false){
         return null;
      }

      //Joga os valores num array
      while ($row = mysqli_fetch_assoc($resultSet)) {
         $arrResult[] = $row;
      }

      if(is_array($arrResult) == true){
         array_walk_recursive($arrResult, 'codificar');
      }

      return $arrResult;
   }

   protected function insert($arrDados,$tabela){

      $strEnunciadoInsert = 'INSERT INTO '. $tabela . ' (';
      $strEnunciadoCampos = ' VALUES (';

      foreach ($arrDados as $key => $campo) {
         $strEnunciadoInsert .= $key . ',';
         $strEnunciadoCampos .= "'" . $campo . "',";
      }

      $strEnunciadoInsert = substr_replace($strEnunciadoInsert, ')', -1);
      $strEnunciadoCampos = substr_replace($strEnunciadoCampos, ')', -1);

      $consulta = $strEnunciadoInsert . $strEnunciadoCampos;

      $resultado = $this->executaQuery($consulta);

      if ($resultado){
         $resultado = $this->realizaConsulta("SELECT LAST_INSERT_ID() as id");
         $resultado = $resultado[0];
      }

      return $resultado;
   }

   protected function executaQuery($consulta){
      return $this->conexao->query($consulta);
   }
}
?>