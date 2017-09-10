import {Category} from './resources';

export class CategoryFormat{
	static getCategoriesFormatted(categories){
		let categoriesFormatted = this._formatCategories(categories);
		categoriesFormatted.unshift({
			id: 0,
			text: 'Nenhuma categoria',
			level: 0,
			hasChildren: false  
		});
//console.log(categoriesFormatted);
		return categoriesFormatted;
	}

	static _formatCategories(categories, categoryCollection = []){
		for(let category of categories){
			let categoryNew = {
				id: category.id,
				text: category.name,
				level: category.depth,
				hasChildren: category.children.data.length > 0 
			};
			categoryCollection.push(categoryNew);
			this._formatCategories(category.children.data, categoryCollection); //chegar ao fim da arvore
		}
		return categoryCollection;
	}
}

export class CategoryService{
	
	static save(Category, parent, categories, categoriesOriginal){
		if(category.id === 0){
			return this.new(category, parent, categories);
		}else{
			return this.edit(category, parent, categoriesOriginal);
		}
	}

	static new(category, parent, categories){

		let categoryCopy = $.extend(true, {}, category);
		if(categoryCopy.parent_id === null){
			delete categoryCopy.parent_id;//excluir para não mecher no objeto original
		}

		return Category.save(categoryCopy).then(reponse => {
			let categoryAdded = reponse.data.data;
			//verifica se é mestre ou filha
			if(categoryAdded.parent_id === null){
				categories.push(categoryAdded);
			}else{
				parent.children.data.push(categoryAdded);
			}

			return reponse;
		})
	}

	static edit(category, parent, categories, categoriesOriginal){

		let categoryCopy = $.extend(true, {}, category);
		if(categoryCopy.parent_id === null){
			delete categoryCopy.parent_id;//excluir para não mecher no objeto original
		}
		let self = this; //pega o contexto da classe
		return Category.update({id: categoryCopy.id}, categoryCopy).then(reponse => {

			let categoryUpdated = reponse.data.data;
			//verifica se é mestre ou filha
			if(categoryUpdated.parent_id === null){
				/*
				* Categoria alterada, está sem pai
				* E antes ela tinha um pai
				*/
				if(parent){
					parent.children.data.$remove(categoriesOriginal);
					categories.push(categoryUpdated);
					return reponse;
				}
			}else{
				/*
				* Categoria alterada, está tem pai
				*/
				if(parent){
					/*
					* Trocar categoria de pai
					*/
					if(parent.id != categoryUpdated.parent_id){
						parent.children.data.$remove(categoriesOriginal);
						self._addChild(categoryUpdated, categories);
						return reponse;
					}
				}else{
					/*
					* Trocar categoria mestre um filho
					* Antes a categoria era um pai
					*/
					categories.$remove(categoriesOriginal);
					self._addChild(categoryUpdated, categories);
					return reponse;
				}
			}

			/*
			* Alteração somente no nome da categoria
			* Arualiza~r as informações na arvore
			*/
			//TO::DO Criar um metodo para não deixar de ser repetitivo
			if(parent){
				let index = parent.children.data.findIndex(element => {
					return element.id == categoryUpdated.id;
				});
				parent.children.data.$set(index, categoryUpdated);
			}else{
				let index = categories.findIndex(element => {
					return element.id == categoryUpdated.id;
				});
				categories.$set(index, categoryUpdated);
			}

			return reponse;
		});
	}

	static _addChild(child, categories){
		let parent = this._findParent(child.parent_id, categories);
		parent.children.data.push(child);//adinconado filho
	}

	static _findParent(id, categories){
		for(let category of categories){
			if(id == category.id){
				return category; //
			}
			return this._findParent(id , category.children.data);
		}
	}
}