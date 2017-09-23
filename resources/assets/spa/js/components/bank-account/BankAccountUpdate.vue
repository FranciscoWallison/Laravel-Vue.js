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
                },
                loadingPage: true,
            };
        },
        created() {
            this.getBanks(); // no carregamento corre a função que vai atualizar a data e fazer com que os campos sejam preenchidos
            this.getBanksAccount(this.$route.params.id, this.availableIncludes);  // params id vem da querystring
        },
        methods: {
            submit(){
                this.$validator.validateAll().then(success => {
                    if(success){
                        let id = this.$route.params.id;
                        BankAccount.update({id: id},this.bankAccount).then(() => {
                            Materialize.toast('Conta bancária atualizada com sucesso!',5000);
                            this.$router.go({name: 'bank-account.list'});
                        });
                    }else{
                        Materialize.toast('Alguns campos são obrigatórios!',5000);
                    }
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
                    this.loadingPage = false;
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