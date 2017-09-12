<template>
<!-- <div class="container"> -->
	<div class="row">
		<ul class="category-tree">
			<li v-for="(index, o) in categories" class="category-child">
				<div class="valign-wrapper">
					<a :data-activates="dropdownId(o)" href="!#" class="category-symbol" :id="categorySymbolId(o)"
						:class="{'green-text' : o.children.data.length > 0 , 'grey-text' : !o.children.data.length }">
						<i class="material-icons">
							{{ categoryIcon(o) }}
						</i>
					</a>
					<ul :id="dropdownId(o)" class="dropdown-content">
						<li>
							<a href="#" @click.prevent="categoryNew(o)">Adicionar</a>
						</li>
						<li>
							<a href="#" @click.prevent="categoryEdit(o)">Editar</a>
						</li>
						<li>
							<a href="#" @click.prevent="categoryDelete(o)">Excluir</a>
						</li>
					</ul>
					<span class="valign">{{{ categoryText(o) }}}</span>
				</div>
				<category-tree :categories="o.children.data" :parent="o"></category-tree>	
			</li>
		</ul>
	</div>
<!-- </div> -->
</template>
<script>

	export default {
		name: 'category-tree',
		props:{
			categories: {
				type: Array,
				required: true
			},
			parent: {
				type: Object,
				required: false,
				'default'(){
					return null;
				}
			}
		},
		ready(){
			this.makeDropdown();
		},
		watch:{
			categories:{
				handler(categories){
					this.makeDropdown();
				},	
				deep: true //  assistir os subniveis
			}
		},
		methods:{
			dropdownId(category){
                return `category-tree-dropdown-${this._uid}-${category.id}`;
            },
            categorySymbolId(category){
                return `category-symbol-${this._uid}-${category.id}`;
            },
            makeDropdown(){
                 $(`a[id^=category-symbol-${this._uid}-]`).unbind('mouseenter mouseleave');
                $(`a[id^=category-symbol-${this._uid}-]`).dropdown({
                    hover: true,
                    inDuration: 300,
                    outDuration: 400,
                    belowOrigin: true
                });
            },
			categoryText(category){
				return category.children.data.length > 0 ? `<strong> ${category.name}</strong>` :  category.name;
			},
			categoryIcon(category){
				return category.children.data.length > 0 ? 'folder': 'label';
			},
			categoryNew(category){
				this.$dispatch('category-new', category);
			},
			categoryEdit(category){
				this.$dispatch('category-edit', category, this.parent);
			},
			categoryDelete(category){
				this.$dispatch('category-delete', category, this.parent);
				
			}
		}
	}
	
</script>