import PageTitleComponent from '../../../_default/components/PageTitle.vue';
import ModalComponent from '../../../_default/components/Modal.vue';
import SelectMaterialComponent from '../../../_default/components/SelectMaterial.vue';
import store from '../store/store';

export default {
        components: {
            'page-title': PageTitleComponent,
            'modal': ModalComponent,
            'select-material': SelectMaterialComponent,

        },
        props:{
            index: {
                type: Number,
                required: false,
                'default': -1,
            },
            modalOptions: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                bill: {
                    id: 0,
                    date_due: '',
                    name: '',
                    value: '',
                    done: false,
                    bank_account_id: 0
                }
            }
        },
        computed:{
            bankAccounts(){
                return store.state.bankAccount.lists;
            }
        },
        watch: {
            bankAccounts(bankAccounts){
                if(bankAccounts.length > 0){
                    this.initAutocomplete();
                }
            }
        },
        methods: {
            doneId(){
                return `done-${this._uid}`;
            },
            bankAccountTextId(){
                return `bank-account-text-${this._uid}`;
            },
            bankAccountDropdownId(){
                return `bank-account-dropdown-${this._uid}`;
            },
            initAutocomplete(){  // autocomplete configurações
                let self = this; // para poder usar o this dentro do jquery
                $(document).ready(() =>{
                    $(`#${this.bankAccountTextId()}`).materialize_autocomplete({
                        //cacheable: true,
                        limit: 10,
                        multiple:{
                            enable:false
                        },
                        dropdown: {
                            el: `#${this.bankAccountDropdownId()}`
                        },
                        getData(value, callback){
                            let mapBankAccoutns = store.getters['bankAccount/mapBankAccounts'];
                            let bankAccounts = mapBankAccoutns(value); // aqui fica a nossa subcoleção para o autoomplete
                            callback(value, bankAccounts);
                        },
                        onSelect(item){
                            self.bill.bank_account_id = item.id; // aliemta o input
                            //console.log(item);
                        },
                    });
                });
            },
            submit(){
                if (this.bill.id !== 0){
                    store.dispatch(`${this.namespace()}/edit`, {
                        bill: this.bill,
                        index: this.index
                    }).then(() => {
                        this.resetScope();
                         $('#modal-edit').modal('close');

                        Materialize.toast('Conta atualizada com sucesso!', 4000);
                       
                    });

                   
                } else {
                    store.dispatch(`${this.namespace()}/save`, this.bill).then(() => {
                        this.resetScope();
                        $('#modal-create').modal('close');  

                        Materialize.toast('Conta criada com sucesso!', 4000); 

                    });

                    
                }
                
            },          
            resetScope(){
                this.bill = {
                    id: 0,
                    date_due: '',
                    name: '',
                    value: '',
                    done: false,
                    bank_account_id: 0
                }; // mande para o component
            }
        }
	}