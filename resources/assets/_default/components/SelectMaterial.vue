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
				validator(value){
					return typeof value == 'string' || typeof value == 'number' || typeof value === null;  
				}
				//valor selecionado
				// type: [String, Number],
				// required: true
			}
		},
		ready(){
			let self = this;
			$(this.$el)
				//.val(this.selected)
				.select2(this.options)
				.on('change', function (){
//console.log(this.value , parseInt(this.value, 10), 'aqui');
					//verifica se parente id é egual a null
					if(parseInt(this.value, 10)  !== 0 ){
						self.selected =  this.value;
					}
					
				});
			//atribuir o valor selecionado 
			$(this.$el).val(this.selected !== null ? this.selected: 0 ).trigger('change'); 
		},
		watch:{ //
			'options.data'(data){
				$(this.$el).select2(Object.assign({}, this.options, {data: data}));
			},
			'selected'(selected){
				if(selected != $(this.$el).val()){
					$(this.$el).val(selected !== null ? selected: 0).trigger('change');
				}
			}
		}
	}
</script>