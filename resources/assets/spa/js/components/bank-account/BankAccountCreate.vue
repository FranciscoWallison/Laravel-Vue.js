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
                title: 'Nova Conta Bancária',
                bankAccount: {
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                    'default': false,
                },
                bank: {
                    name: ""
                },
            };
        },
        computed:{
            banks(){
                return store.state.bank.banks;
            }
        },
        created(){
           this.getBanks();
        },
        methods: {
            submit(){
                store.dispatch('bankAccount/save', this.bankAccount).then(() =>{
                    Materialize.toast('Conta bancária criada com sucesso!', 4000);
                    this.$router.go({name: 'bank-account.list'});
                });
            },
            getBanks(){ // bancos para inserir no formulario menu pendente
                store.dispatch('bank/query').then((response) => {
                    this.initAutocomplete(); // para inicializar o autocomplete e mostrar na caixa de preenchimento
                });
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
        },
    };
</script>