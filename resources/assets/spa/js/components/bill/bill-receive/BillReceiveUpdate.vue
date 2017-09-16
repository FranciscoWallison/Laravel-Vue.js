<template src="../_form.html"></template>
<script>
    import billMixin from '../../../mixins/bill-mixin';
    import validatorOffRemoveMixim from '../../../mixins/validator-off-remove-mixin';
    import store from '../../../store/store';
    import Bill from '../../../models/bill'

    export default{
        mixins: [billMixin, validatorOffRemoveMixim],
        data(){
            return{
                title: 'Editar Pagamento',
            };
        },
        created(){
            let self = this;
            this.modalOptions.options = {};
            this.modalOptions.options.ready = () => {
                self.getBill();
            };
        },
        methods: {            
            categoryNamespace(){
                return 'categoryRevenue';
            },
            namespace(){
                return 'billReceive';
            },
            title(){
                return 'Editar Pagamento';
            },
            getBill(){
                this.resetScope();
                let bill = store.getters[`${this.namespace()}/billByIndex`](this.index);
                this.bill = new Bill(bill);
                let text = store.getters['bankAccount/textAutocomplete'](bill.bankAccount.data);
                this.bankAccount.text = text;
            }
        }
    }
</script>
