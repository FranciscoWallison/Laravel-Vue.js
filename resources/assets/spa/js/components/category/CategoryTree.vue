<template>
	<ul class="category-tree">
		<li v-for="(index, o) in categories" class="category-child">
			<div class="valign-wrapper">
				<a href="#" class="category-symbol green-text">
					<i class="material-icons">folder</i>
				</a>
				<span class="valign">{{ o.name }}</span>
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
		}
	}
	
</script>