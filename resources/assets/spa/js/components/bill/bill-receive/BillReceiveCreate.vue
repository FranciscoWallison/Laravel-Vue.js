<template src="../_form.html"></template>
<script>
    import billMixin from '../../../mixins/bill-mixin';
    import validatorOffRemoveMixim from '../../../mixins/validator-off-remove-mixin';

    export default{
        mixins: [billMixin, validatorOffRemoveMixim],
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
                return 'billReceive';
            },
            categoryNamespace(){
                return 'categoryRevenue';
            },
            title(){
                return 'Novo pagamento';
            }

        }
    }
</script>

<style type="text/css" scoped src="../_style.css">
</style>
