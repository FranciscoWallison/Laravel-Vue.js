<template>
	<div class="container">
		<div class="row">
			<page-title>
				<h5>Plano de Contas</h5>
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

            <modal :modal="modalOptionsDelete">
                <div slot="content" v-if="categoryDelete">
                    <h4>Mensagem de confirmação</h4>
                    <p><strong>Deseja excluir esta categoria?</strong></p>
                    <div class="divider"></div>
                    <p>Nome: <strong>{{ categoryDelete.name }}</strong></p>                   
                    <div class="divider"></div>
                </div>
                <div slot="footer">
                    <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action" @click="destroy()">OK</button>
                    <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                </div>
            </modal>

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
    import ModalComponent from '../../../../_default/components/Modal.vue';


	export default {

    	components: {    		
            'page-title': PageTitleComponent,
            'category-tree': CategoryTreeComponent,
            'category-save': CategorySaveComponent,
            'modal': ModalComponent,   
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
                categoryDelete: null,
                category: null,
                parent: null,
                title: '',
                modalOptionsSave: {
                    id: 'modal-category-save'
                },
                modalOptionsDelete: {
                    id: 'modal-category-delete'
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
                CategoryService.save(this.categorySave, this.parent, this.categories, this.category).then(response => {
                    if(this.categorySave.id === 0){
                        Materialize.toast('Categoria adicionada com sucesso!', 4000);
                    }else{
                        Materialize.toast('Categoria alterada com sucesso!', 4000);
                    }
                    this.resetScope();
                });

                //CategoryService.new(this.categorySave, this.parent, this.categories)
                //console.log('saveCategory');
            },
            destroy(){
                CategoryService.destroy(this.categoryDelete, this.parent, this.categories)
                    .then(response => {
                        Materialize.toast('Categoria excluída com sucesso!', 4000);
                        this.resetScope;
                    })
            },
            modalNew(category){
                this.title = "Nova Categoria";

                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: category === null ? null : category.id
                }; // mande para o component

                this.parent = category;

                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalEdit(category, parent){
                this.title = "Editar Categoria";

                this.categorySave = {
                    id: category.id,
                    name: category.name,
                    parent_id: category.parent_id
                }; // mande para o component
                this.category = category;
                this.parent = parent;

                $(`#${this.modalOptionsSave.id}`).modal('open');
            },
            modalDelete(category, parent){
                this.categoryDelete = category;
                this.parent = parent;
                $(`#${this.modalOptionsDelete.id}`).modal('open');
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
            },
            resetScope(){
                //reset o categorySave
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: 0
                }; // mande para o component

                this.categoryDelete = null;
                this.category = null;
                this.parent = null;
                this.formatCategories(); // chama novamente o nosso formatCategories para ter uma coleçao de categorias formatada
            }
    	},
        events: {
            'category-new'(category){
                this.modalNew(category);
            },
            'category-edit'(category, parent){
                this.modalEdit(category, parent);
            },
            'category-delete'(category, parent){
                this.modalDelete(category, parent);
            }
        }
	}
	
</script>