<template>
	<div class="row">
		<div class="container">
			<page-title>
				<h5 class="center">Plano de contas</h5>
			</page-title>	
		</div>
		<div class="container-sisfin">
			<div class="card-panel z-depth-5 center">
				<h5>Categories de Receitas</h5>
				<category-revenue v-ref:revenue></category-revenue>
				<h5>Categorias de Despesas</h5>
				<category-expense v-ref:expense></category-expense>	
			</div>
		</div>

		<div class="fixed-action-btn horizontal">
			<a class="btn-floating btn-large">
				<i class="large material-icons">add</i>
			</a>
			<ul>
				<li>
					<a class="btn-floating green" href="!#" @click.prevent="newRevenue" title="Nova Categoria de Receita">
						<i class="material-icons">attach_money</i>
					</a>
				</li>
				<li>
					<a href="!#" class="btn-floating red" @click.prevent="newExpense" title="Nova Categoria de Despesa">
						<i class="material-icons">money_off</i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</template>
<script>
	import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
    import CategoryRevenue from './CategoryRevenue.vue'
    import CategoryExpense from './CategoryExpense.vue'
    export default{
        components: {
            'page-title': PageTitleComponent,
            'category-revenue': CategoryRevenue,
            'category-expense': CategoryExpense,
        },
		methods: {
			newRevenue(){
				this.$refs.revenue.modalNew(null);
			},
			newExpense(){
				this.$refs.expense.modalNew(null);
			}
		}
	}
</script>