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
        	// $('.datepicker').pickadate({
        	// 	format: 'dd/mm/yyyy',
        	// 	selectMonths: true,
        	// 	selectYears: 15
        	// });
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
