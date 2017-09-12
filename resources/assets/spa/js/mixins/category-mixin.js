import CategoryTreeComponent from '../components/category/CategoryTree.vue';
import CategorySaveComponent from '../components/category/CategorySave.vue';
import {CategoryFormat} from '../services/category-nsm';
import ModalComponent from '../../../_default/components/Modal.vue';

export default {
    	components: {
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
                title: ''
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
            },
            modalOptionsSave(){
            	return {id: `modal-category-save-${this._uid}`};
            },
            modalOptionsDelete(){
            	return {id: `modal-category-delete-${this._uid}`};
            }
        },
    	created(){
    		this.getCategories();
    	},
    	methods: {
    		getCategories(){
    			this.resource().query().then(response => {
    				this.categories = response.data.data;
                    this.formatCategories();
    			})
    		},
            saveCategory(){
                this.resource().save(this.categorySave, this.parent, this.categories, this.category).then(response => {
                    if(this.categorySave.id === 0){
                        Materialize.toast('Categoria adicionada com sucesso!', 4000);
                    }else{
                        Materialize.toast('Categoria alterada com sucesso!', 4000);
                    }
                    this.resetScope();
                });
            },
            destroy(){
                this.resource().destroy(this.categoryDelete, this.parent, this.categories)
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
            },
            resetScope(){
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