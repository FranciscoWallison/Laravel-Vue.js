<template>
	<ul class="category-tree">
		<li v-for="(index, o) in categories" class="category-child">
			<div class="valign-wrapper">
				<a :data-activates="dropdownId(o)" href="javascript:void(0);" class="category-symbol" 
					:class="{'green-text' : o.children.data.length > 0 , 'grey-text' : !o.children.data.length }">
					<i class="material-icons">
						{{ categoryIcon(o) }}
					</i>
				</a>
				<ul :id="dropdownId(o)" class="dropdown-content">
					<li>
						<a href="">Adicionar</a>
					</li>
					<li>
						<a href="">Editar</a>
					</li>
					<li>
						<a href="">Excluir</a>
					</li>
				</ul>
				<span class="valign">{{{ categoryText(o) }}}</span>
			</div>
			<category-tree :categories="o.children.data"></category-tree>	
		</li>
	</ul>
</template>
<script>

	export default {
		name: 'category-tree',
		props:{
			categories: {
				type: Array,
				required: true
			}
		},
		watch:{
			categories:{
				handler(categories){
				
					$('.category-child > div > a').dropdown({
						hover: true,
						inDuration: 300,
						outDuration: 400,
						belowOrigin: true
					});
				},	
				deep: true
			}
		},
		methods:{
			dropdownId(category){
				return `category-tree-dropdown-${category.id}`;
			},
			categoryText(category){
				return category.children.data.length > 0 ? `<strong> ${category.name}</strong>` :  category.name;
			},
			categoryIcon(category){
				return category.children.data.length > 0 ? 'folder': 'label';
			}
		}
	}
	
</script>