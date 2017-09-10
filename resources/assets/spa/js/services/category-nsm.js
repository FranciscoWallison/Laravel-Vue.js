export class CategoryFormat{
	static getCategoriesFormatted(categories){
		let categoriesFormatted = this._formatCategories(categories);
		categoriesFormatted.unshift({
			id: 0,
			text: 'Nenhuma categoria',
			level: 0,
			hasChildren: false  
		});
console.log(categoriesFormatted);
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