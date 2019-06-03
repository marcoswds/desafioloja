const ADMIN = new Vue({
   el: '#admin',
   data: {
      arrProdutoNovo     : [],
      arrProdutos        : [],
      vendas_confirmadas : '0.00',
      vendas_total       : '0.00',
      money: {
         decimal: '.',
         thousands: '',
         prefix: '',
         suffix: '',
         precision: 2,
         masked: false
      }
   },

   methods: {

      getProdutos: function () {
         axios
         .get("ajax/produto/carregaProdutos.php")
         .then(response => {
            this.arrProdutos = response.data;
         });
      },

      getVendas: function () {
         axios
         .get("ajax/documento/getVendas.php")
         .then(response => {
            if (response.data.length > 0) {
               this.vendas_confirmadas = response.data[0].valor_confirmado;
               this.vendas_total = response.data[0].valor_total;
            }
         });

      },

      submitForm: function (fecha_modal = true) {

         $("#btn_criar").attr("disabled", true);

         var sn_erro = false;

         // Pega todos os elementos que tenham o atributo "required"
         var arrElementos = document.querySelectorAll('[required]') ;

         // Percorre os campos que tem o atributo "required"
         // Os que não estiverem "OK" pega o titulo e mostra ao usuario
         arrElementos.forEach(function(elemento){
            if (!elemento.validity.valid) {
               if (elemento.title != undefined) {
                  sn_erro = true;
                  M.toast({html: '<i class="material-icons left">close</i> Favor preencher o campo ' + elemento.title + '!', classes: 'red', displayLength: '3000'});
               }
            }
         });

         if (!sn_erro ) {

            var arrDados = {
               cd_produto : this.arrProdutoNovo.cd_produto
            };

            axios
            .post("ajax/produto/validaProduto.php",
             Object.assign({}, arrDados))
            .then(response => {

               var arrResposta = response.data;

               if(arrResposta.length > 0) {

                  M.toast(
                     {
                        html:'<i class="material-icons left">close</i> Já existe um produto com o mesmo código!',
                        classes: 'red',
                        displayLength: '5000'
                     }
                  );

               } else {
                  //Inclui os produtos
                  axios
                  .post("ajax/produto/incluirProduto.php",
                   Object.assign({}, this.arrProdutoNovo))
                  .then(response => {

                     if (response.data.sucesso == true) {

                        M.toast({html: 'Produto cadastrado com sucesso!', classes: 'green', displayLength: '3000'});
                        this.getProdutos();

                        if(fecha_modal){
                           this.arrProdutoNovo = {};
                           $('#modal_novo_produto').modal('close');
                        } else {
                           this.arrProdutoNovo = {};
                        }

                     } else {

                        M.toast(
                           {
                              html: '<i class="material-icons left">close</i>O sistema não conseguiu incluir um produto. Favor verificar sua conexão.',
                              classes: 'red',
                              displayLength: '5000'
                           }
                        );
                     }
                  });
               }
            });
         }

         $('#btn_criar').removeAttr("disabled");

      },

   },
   mounted () {

      $('.tabs').tabs();
      $('.modal').modal();
      $('.tooltipped').tooltip();

      // Atualiza as informações da página com a base de dados
      this.getProdutos();

      this.getVendas();

   }

})