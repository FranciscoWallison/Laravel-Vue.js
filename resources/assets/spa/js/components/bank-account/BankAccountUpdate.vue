<template src="./_form.html"></template>

<script>
    import {BankAccount} from '../../services/resources';
    import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
    import 'materialize-autocomplete'; //busca a nossa biblioteca de jquery autocomplete
    import store from '../../store/store';
 
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
                }
            };
        },
        created() {
            this.getBanks(); // no carregamento corre a função que vai atualizar a data e fazer com que os campos sejam preenchidos
            this.getBanksAccount(this.$route.params.id, this.availableIncludes);  // params id vem da querystring
        },
        methods: {
            submit(){
                let id = this.$route.params.id; // pega o id da query string
                let bankAccount = this.bankAccount; // pasando os dados para store
                store.dispatch('bankAccount/update',{id, bankAccount}).then(()=>{  // fa o update com o id da query string guardada na variavel id
                    Materialize.toast('Conta atualizada com sucesso', 4000);
                    this.$router.go({name: 'bank-account.list'}); // redireciona para a listagem no fim
                });
            },
            getBanks(){
                store.dispatch('bank/query').then((response) => {
                    this.initAutocomplete(); // para inicializar o autocomplete e mostrar na caixa de preenchimento
                });
            },
            getBanksAccount(id){
                //ter o controle das atualizações dos banks das contas  
                BankAccount.get({
                    id: id,
                    include: 'bank'
                }).then((response) => {
                    this.bankAccount = response.data.data;
                    this.bank = response.data.data.bank.data; //alimentando o fomulario 
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
                        getData(value, callback){
                            let mapBanks = store.getters['bank/mapBanks'];
                            let banks = mapBanks(value); // aqui fica a nossa subcoleção para o autoomplete
                            callback(value, banks);
                        },
                        onSelect(item){
                            self.bankAccount.bank_id = item.id; // aliemta o input
                            //console.log(item);
                        },
                    });
                });
            }
        }
    }
</script>