<template>
	<ul>
		<li v-for="(index, o) in categories">
			{{ o.name }}
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