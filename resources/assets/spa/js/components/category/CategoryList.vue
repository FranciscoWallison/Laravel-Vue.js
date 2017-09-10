<template>
	<div class="container">
		<div class="row">
			<page-title>
				<h5>Administração de categoria</h5>
			</page-title>
            <div class="card-panel z-depth-5">
               <category-tree :categories="categories"></category-tree>
            </div>
            
            <category-save  :modal-options="modalOptionsSave" 
                            :category.sync="categorySave" 
                            :cp-options="cpOptions"
                            @save-category="saveCategory">
                <span slot="title">{{ title }}</span>
                <div slot="footer">
                    <button type="submit" class="btn btn-flat waves-effect green lighten-2 modal-close modal-action">OK</button>
                    <button type="button" class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                </div>
            </category-save>
            <div class="fixed-action-btn">
                <button class="btn-floating btn-large" @click="modalNew(null)">
                    <i class="large material-icons">add</i>
                </button>
            </div>
		</div>
	</div>
</template>
<script>
	import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
	import CategoryTreeComponent from './CategoryTree.vue';
    import CategorySaveComponent from './CategorySave.vue'
	import {Category} from '../../services/resources';
    import {CategoryFormat, CategoryService} from '../../services/category-nsm';


	export default {

    	components: {    		
            'page-title': PageTitleComponent,
            'category-tree': CategoryTreeComponent,
            'category-save': CategorySaveComponent,            
    	},
    	data(){
    		return{
    			categories:[],
                categoriesFormatted:[],
                categorySave:{
                    id: 0,
                    name: '',
                    parent_id: 0
                },
                parent: null,
                title: '',
                modalOptionsSave: {
                    id: 'modal-category-save'
                }                
    		}
    	},
        computed:{
            //opçoes para o campo select 2 de categoria pai
            cpOptions(){
                return {
                    data: this.categoriesFormatted,

                    templateResult(category){
                        let margin = '&nbsp'.repeat(category.level * 6);
                        let text = category.hasChildren ? `<strong>${category.text}</strong>` : category.text;
                        return `${margin}${text}`;
                    },
                    escapeMarkup(m){
                        return m;
                    }
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
                    this.formatCategories();
    			})
    		},
            saveCategory(){
                CategoryService.new(this.categorySave, this.parent, this.categories).then(response => {
                    
                });
                //console.log('saveCategory');
            },
            modalNew(category){
                this.title = "Nova Categoria";

                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: category === null ? null : category.parent_id
                }; // mande para o component
                this.parent_id = category;
                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalEdit(category){
                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            formatCategories(){
                this.categoriesFormatted = CategoryFormat.getCategoriesFormatted(this.categories);
                // for(let category of this.categories){
                //     this.categoriesFormatted.push({
                //         id: category.id,
                //         text: category.name
                //     });
                // }
                //this.categoriesFormatted = this.categories;
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