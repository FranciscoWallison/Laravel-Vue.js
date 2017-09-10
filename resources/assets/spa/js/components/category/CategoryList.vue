<template>
	<div class="container">
		<div class="row">
			<page-title>
				<h5>Administração de categoria</h5>
			</page-title>
            <div class="card-panel z-depth-5">
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
	import {Category} from '../../services/resources';


	export default {

    	components: {    		
            'page-title': PageTitleComponent,
            'category-tree': CategoryTreeComponent
    	},
    	data(){
    		return{
    			categories:[],
                title: 'Adicionar categoria',
                modalOptionsSave: {
                    id: 'modal-category-save'
                }
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
            }
    	}
	}
	
</script>