<template>
	<ul class="category-tree">
		<li v-for="(index, o) in categories" class="category-child">
			<div class="valign-wrapper">
				<a href="#" class="category-symbol" 
					:class="{'green-text' : o.children.data.length > 0 , 'grey-text' : !o.children.data.length }">
					<i class="material-icons">
						{{ categoryIcon(o) }}
					</i>
				</a>
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
		methods:{
			categoryText(category){
				return category.children.data.length > 0 ? `<strong> ${category.name}</strong>` :  category.name;
			},
			categoryIcon(category){
				return category.children.data.length > 0 ? 'folder': 'label';
			}
		}
	}
	
</script>