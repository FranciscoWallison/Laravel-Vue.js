<template src="../_form.html"></template>

<script type="text/javascript">
	import billPayMixin from '../../../mixins/bill-mixin';
	import store from '../../../store/store';

	export default {
		mixins: [billPayMixin],
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
			namespace(){
				return 'billPay';
			},
			title(){
				return 'Editar Pagamento';
			},
			getBill(){
				let bill = store.getters[`${this.namespace}/billByIndex`](this.index);
				this.bill = {
					id: bill.id,
					date_due: bill.date_due,
					name: bill.name,
					value: bill.value,
					done: bill.done
				};
			}
		}
	}
</script>