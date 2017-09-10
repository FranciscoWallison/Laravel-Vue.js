<template>
	<div>
		<modal :modal="modalOptions">
			<div slot="content">
				<h4> 
					<slot name="title"></slot>		
				</h4>
				<form name="form" action="" method="POST" @sugmit="sugmit">
					<div class="row">
	                    <div class="input-field col s12">
	                        <label class="active">Nome</label>
	                        <input type="text" v-model="category.name" placerholder="O seu nome" />
	                    </div>
                	</div>
                	<div class="row">
	                    <div class="input-field col s12">
	                        <label class="active">Categpria Pai</label>
	                        <input type="text"  placerholder="O seu nome" />
	                    </div>
                	</div>
				</form>
			</div>
			<div slot="footer">
				<slot name="footer"></slot>
			</div>
		</modal>	
	</div>
</template>
<script>
	import ModalComponent from '../../../../_default/components/Modal.vue';

	export default {
		components:{
			'modal': ModalComponent
		},
		props:{
			category: {
				type: Object,
				required: true
			},
			modalOptions:{
				type: Object,
				required: true
			}
		},
		methods: {
			submit(){
				this.$emit('save-category');// @save-category = 
			}
		}
	}
	
</script>