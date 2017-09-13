import PageTitleComponent from '../../../_default/components/PageTitle.vue';
import ModalComponent from '../../../_default/components/Modal.vue';
import store from '../store/store';

export default {
        components: {
            'page-title': PageTitleComponent,
            'modal': ModalComponent,   
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
                        Materialize.toast('Conta atualizada com sucesso!', 4000);
                        this.resetScope;
                    });
                } else {
                    store.dispatch(`${this.namespace()}/save`. this.bill).then(() => {
                        Materialize.toast('Conta criada com sucesso!', 4000);
                        this.resetScope;
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