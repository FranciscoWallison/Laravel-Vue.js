<template src="../_form.html"></template>

<script type="text/javascript">
	import billPayMixin from '../../../mixins/bill-mixin';
	import store from '../../../store/store';
	import Bill from '../../../models/bill';

	export default {
		mixins: [billPayMixin],
		data(){
            return{
                title: 'Editar Pagamento',
            };
        },
		created(){
			let self = this;
			this.modalOptions.options = {},
			this.modalOptions.options.ready = () => {
				self.getBill();
			};
			this.modalOptions.options.complete = () => {
				self.resetScope();
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
			}
		}
	}
</script>