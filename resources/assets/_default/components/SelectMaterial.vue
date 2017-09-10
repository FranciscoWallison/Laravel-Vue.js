<template>
	<select></select>
</template>
<script>
	import 'select2';

	export default {
		props: {
			options:{
				type: Object,
				requered: true
			},
			selected: {
				//valor selecionado
				type: [String, Number],
				required: true
			}
		},
		ready(){
			let self = this;
			$(this.$el)
				//.val(this.selected)
				.select2(this.options)
				.on('change', function (){
					self.selected =  this.value
				});
			//atribuir o valor selecionado 
			$(this.$el).val(this.selected).trigger('change'); 
		},
		watch:{ //
			'options.data'(data){
				$(this.$el).select2(Object.assign({}, this.options, {data: data}));
			}
		}
	}
</script>