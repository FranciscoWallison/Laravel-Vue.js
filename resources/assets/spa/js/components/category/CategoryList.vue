<template>
	<div class="container">
		<div class="row">
			<page-title>
				<h5>Administração de categoria</h5>
			</page-title>
            <div class="card-panel z-depth-5">
                <select-material :options="options" :selected.sync="selected"></select-material>
                {{ selected }}
               <category-tree :categories="categories"></category-tree>
            </div>
            
            <category-save :modal-options="modalOptionsSave" :category.sync="categorySave" @save-category="saveCategory">
                <span slot="title">{{ title }}</span>
                <div slot="footer">
                    <button type="submit" class="btn btn-flat waves-effect green lighten-2 modal-close modal-action">OK</button>
                    <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                </div>
            </category-save>
		</div>
	</div>
</template>
<script>
	import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
	import CategoryTreeComponent from './CategoryTree.vue';
    import CategorySaveComponent from './CategorySave.vue'
	import {Category} from '../../services/resources';
    import SelectMaterialComponent from '../../../../_default/components/SelectMaterial.vue';


	export default {

    	components: {    		
            'page-title': PageTitleComponent,
            'category-tree': CategoryTreeComponent,
            'category-save': CategorySaveComponent,
            'select-material': SelectMaterialComponent,
    	},
    	data(){
    		return{
    			categories:[],
                categorySave:{
                    id: 0,
                    name: '',
                    parent_id: 0
                },
                title: 'Adicionar categoria',
                modalOptionsSave: {
                    id: 'modal-category-save'
                },
                options:{
                    data: [
                        {id: 1, text: 'Values 1'},
                        {id: 2, text: 'Values 2'},
                        {id: 3, text: 'Values 3'},
                        {id: 4, text: 'Values 4'},
                        {id: 5, text: 'Values 5'},
                    ]
                },
                selected: 4
    		}
    	},
    	created(){
    		this.getCategories();
    	},
    	methods: {
    		getCategories(){
    			Category.query().then(response => {
    				this.categories = response.data.data;
    			})
    		},
            saveCategory(){
                console.log('saveCategory');
            },
            modalNew(category){
                this.categorySave = category; // mande para o component
                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalEdit(category){
                $(`#${this.modalOptionsSave.id}`).modal('open');
            }
    	},
        events: {
            'category-new'(category){
                this.modalNew(category);
            },
            'category-edit'(category){

            }
        }
	}
	
</script>