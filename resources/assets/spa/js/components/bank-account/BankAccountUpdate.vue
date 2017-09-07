<template src="./_form.html"></template>

<script>
    import {BankAccount, Bank} from '../../services/resources';
    import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
    import 'materialize-autocomplete'; //busca a nossa biblioteca de jquery autocomplete
    import _ from 'lodash' // biblioteca caraterizada pelo underscore, vai ser vir para mostrar os resultados do autocomplete
 
    export default{
        components:{
            'page-title': PageTitleComponent,
        },
        data(){
            return{
               title: 'Editar Conta',
               availableIncludes: 'bank', // para ir buscar o banco associado à conta também
               bankAccount: {
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                    'default': false,
               },
               bank: {
                    name:""
               },
               banks: [],
            };
        },
        created() {
            this.getBanks(); // no carregamento corre a função que vai atualizar a data e fazer com que os campos sejam preenchidos
            this.getBanksAccount(this.$route.params.id, this.availableIncludes);  // params id vem da querystring
        },
        methods: {
            submit(){
                let id = this.$route.params.id; // pega o id da query string
                BankAccount.update({id: id}, this.bankAccount).then(()=>{  // fa o update com o id da query string guardada na variavel id
                    Materialize.toast('Conta atualizada com sucesso', 4000);
                    this.$router.go({name: 'bank-account.list'}); // redireciona para a listagem no fim
                })
            },
            getBanks(){
                Bank.query({

                }).then((response) => {

                    this.banks = response.data.data;
                    //this.initAutocomplete();
                })
            },
            getBanksAccount(id, availableIncludes){
                BankAccount.get({
                    id: id,
                    include: 'bank'
                }).then((response) => {
                    this.bankAccount = response.data.data;
                    //this.bank = response.data.data.bank.data;
                })
            },
            initAutocomplete(){  // autocomplete configurações
                let self = this; // para poder usar o this dentro do jquery
                $(document).ready(() =>{
                    $('#bank-id').materialize_autocomplete({
                        //cacheable: true,
                        limit: 10,
                        multiple:{
                            enable:false
                        },
                        dropdown: {
                            el: '#bank-id-dropdown'
                        },
                        getData: (value, callback) => {
                            let banks = self.filterBankByName(value); // aqui fica a nossa subcoleção para o autoomplete
                            banks = banks.map((o) =>{
                                return {id: o.id, text: o.name};  // banks.map ordena o nosso objeto para o formato necessário
                            });
                            callback(value, banks);
                        },
                        onSelect(item){
                            self.bankAccount.bank_id = item.id;
                            //self.bank_name = item.name;
                            //self.banks.bank_name = item.name;
                        },
                        ignoreCase:true,
                        throttling:true,
                    });
                });
            },
            filterBankByName(name){
                let banks = _.filter(this.banks, (o)=>{
                    // vamos verificar se o nome existem em o.name
                   return _.includes(o.name.toLowerCase(), name.toLowerCase()); // o includes verificar se o valor existe na coleção (ver documentação do lodash)
                });
                return banks;
            }
        }
    }
</script>