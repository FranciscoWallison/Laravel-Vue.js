<template src="../_form.html"></template>
<script>
	import billPayMixin from '../../../mixins/bill-mixin';
	import validatorOffRemoveMixim from '../../../mixins/validator-off-remove-mixin';

	export default {
		mixins: [billPayMixin, validatorOffRemoveMixim],
		data(){
            return{
                title: 'Novo Pagamento',
            };
        },
        ready(){
        	this.initSelect2();
        },
		methods: {
			namespace(){
				return 'billPay';
			},
			categoryNamespace(){
				return 'categoryExpense'
			},
			title(){
				return 'Novo Pagamento';
			}
		}
	}
</script>

<style type="text/css" scoped src="../_style.css">
</style>
