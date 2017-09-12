<template>
	<div >
        <div class="card-panel">
            <category-tree :categories="categories"></category-tree>
        </div>
            
            <category-save  :modal-options="modalOptionsSave" 
                            :category.sync="categorySave" 
                            :cp-options="cpOptions"
                            @save-category="saveCategory">
                <span slot="title">{{ title }} de Receitas</span>
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

           <!--  <div class="fixed-action-btn">
                <button class="btn-floating btn-large" @click="modalNew(null)">
                    <i class="large material-icons">add</i>
                </button>
            </div> -->
		</div>
	</div>
</template>
<script>
    import {CategoryService} from '../../services/category-nsm';
    import categoryMixin from '../../mixins/category-mixin';


	export default {
        mixins: [categoryMixin],
        methods: {
            resource(){
                return new CategoryService('revenue');
            }
        }
    }
	
</script>