<template src="../_form.html"></template>

<script type="text/javascript">
	import billPayMixin from '../../../mixins/bill-mixin';
	import store from '../../../store/store';
	import Bill from '../../../models/bill';
	import validatorOffRemoveMixim from '../../../mixins/validator-off-remove-mixin';

	export default {
		mixins: [billPayMixin, validatorOffRemoveMixim],
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
				return 'categoryExpense';
			},
			namespace(){
				return 'billPay';
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