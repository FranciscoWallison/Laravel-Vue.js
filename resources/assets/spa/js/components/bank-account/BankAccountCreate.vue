<template src="./_form.html"></template>

<script>
    import {BankAccount, Bank} from '../../services/resources';
    import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
    import 'materialize-autocomplete'; //busca a nossa biblioteca de jquery autocomplete
    import _ from 'lodash' // biblioteca caraterizada pelo underscore, vai ser vir para mostrar os resultados do autocomplete
    import store from '../../store/store';


    export default{
        components:{
            'page-title': PageTitleComponent,
        },
        data(){
            return{
               title: 'Nova Conta',
               bankAccount: {
                    name: '',
                    bank_id: '',
                    agency: '',
                    account: '',
                    'default': false,
               },
                bank: {
                    name: ""
                },
                banks: [],
            };
        },
        computed:{
            bankAccount(){
                return store.state.bankAccount.bankAccountSave;
            }
        },
        created(){
           this.getBanks();
        },
        methods: {
            updateName(event){
                store.commit('updateName', event.target.value);
            },
            submit(){
                BankAccount.save({}, this.bankAccount).then( () =>{
                    Materialize.toast('Conta bancária criada com sucesso!', 4000);
                    this.$router.go({name: 'bank-account.list'});
                });
            },
            getBanks(){ // bancos para inserir no formulario menu pendente
                Bank.query({}).then((response) => {
                    this.banks = response.data.data;
                    this.initAutocomplete(); // para inicializar o autocomplete e mostrar na caixa de preenchimento
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
                            let banks = self.filterBankByName(value); // aqui fica a nossa subcoleção para o autoomplete
                            banks = banks.map((o) =>{
                                return {id: o.id, text: o.name};  // banks.map ordena o nosso objeto para o formato necessário
                            });
                            callback(value, banks);
                        },
                        onSelect(item){
                            self.bankAccount.bank_id = item.id; // aliemta o input
                            //console.log(item);
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
        },
    };
</script>