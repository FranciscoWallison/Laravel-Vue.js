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
		methods: {
			namespace(){
				return 'billPay';
			},
			title(){
				return 'Novo Pagamento';
			}
		}
	}
</script>