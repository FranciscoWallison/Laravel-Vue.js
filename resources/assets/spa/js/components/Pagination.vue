<template>
	<div>{{ pages }}</div>
</template>

<script>
	export default{
		props: {
			currentPage: {
				type: Number,
				'default':0
			},
			perPage:{
				type: Number,
				required: true
			},
			totalRecords:{
				type: Number,
				required: true
			}
		},
		computed:{
			pages(){
				let pages =  Math.ceil( this.totalRecords / this.perPage );
				return Math.max(pages, 1);

			}
		}
	}
</script>