<template src="../_form.html"></template>
<script>
	import billPayMixin from '../../../mixins/bill-mixin';

	export default {
		mixins: [billPayMixin],
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