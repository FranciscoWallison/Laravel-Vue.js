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
                    done: false
                }
            }
        },
        methods: {
            doneId(){
                return `done-${this._uid}`;
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
                    done: false
                }; // mande para o component
            }
        }
	}