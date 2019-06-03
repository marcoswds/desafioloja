<?php
session_start();
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html>

<!-- Jquery 3.4.0 -->
<script src="visual/js/jquery-3.4.0.min.js"></script>

<!-- Vue JS 2.6.10 -->
<script src="visual/js/vue-2.6.10.min.js"></script>

<!-- Axios 0.18.0 -->
<script src="visual/js/axios-0.18.0.min.js"></script>

<!-- Estilos CSS -->
<link rel="stylesheet" href="visual/css/estilos.min.css">

<!-- Material Icons Font -->
<link href="visual/fonts/material_icons_css.css" rel="stylesheet">

<!-- Materialize CSS 1.0.0 -->
<link rel="stylesheet" href="visual/css/materialize.min.css">

<!-- Vue-the-mask -->
<script src="visual/js/vue-the-mask.js"></script>

<body class="grey lighten-4">

   <main id="vendedor" class="l-padding-20">

      <div class="row">

         <div id="cadastro" class="col s12">

            <div class="white z-depth-1">
               <div class=" l-pagina-cabecalho">
                  <h5>Venda de Produtos</h5>
                  <div class="button-box" >

                     <a class="btn-floating waves-effect white tooltipped l-border-radius-5" data-position="bottom" data-tooltip="Voltar" href="index.php">
                        <i class="material-icons black-text">arrow_back</i>
                     </a>

                  </div>
               </div>

            </div>

            <div class="white z-depth-1" >
               <div class="l-min-height-50">

                  <div class="row l-margin-top-20 l-margin-bottom-0">
                     <div class=" l-pagina-cabecalho">
                        <h5>Venda Atual: {{ id_documento }}</h5>
                     </div>

                     <div class="col s12">

                        <div class="col s7">

                           <table class="centered">
                              <thead>
                                 <tr>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                 </tr>
                              </thead>

                              <tbody>
                                 <tr v-for="produto in arrProdutos">
                                    <td>{{ produto.cd_produto }}</td>
                                    <td>{{ produto.ds_produto }}</td>
                                    <td>R$ {{ produto.vl_preco }}</td>
                                </tr>
                              </tbody>
                           </table>

                        </div>

                        <div class="col s5">
                           <!-- Código -->
                           <div class="input-field col s12">
                              <input
                                 id="cd_produto"
                                 v-model="cd_produto"
                                 type="text"
                                 maxlength="20"
                                 title="Código do Produto"
                                 required
                              >
                              <label for="cd_produto">Código do Produto</label>
                           </div>

                           <button id="btn_criar" class="btn" @click="incluirProduto()">Incluir Produto</button>

                        </div>

                     </div>

                  </div>
               </div>

               <div class="l-default l-pagina-rodape" style="">
                  <button class="btn white black-text l-border-radius-5" @click="cancelaDocumento()">Cancelar</button>

                  <button id="btn_criar" class="btn l-border-radius-5" @click="confirmaDocumento()">Confirmar</button>
               </div>

            </div>

         </div>

      </div>


   </main>

</body>

<!-- Materialize JS 1.0.0 -->
<script src="visual/js/materialize.min.js"></script>

<!-- COMPONENTES VUE -->
<script src="visual/vue/vendedor.min.vue.js"></script>

</html>