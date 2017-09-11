export default class {
	constructor(){
		this.pagination = {
			current_page: 0,
			per_page: 0,
			total: 0
		};
		this.search = '',
		this.order = {
			get key(){
				return this._key;
			},
			set key(key){
				this._key = key;
				this.sort = this.sort == 'desc' ? 'asc' : 'desc';
			},
			_key: 'id',
			sort: 'asc'
		};
		this.include = null;
	}

	get pagination(){
		return this._pagination;
	}

	set pagination(value){
		value.current_page--;
		this._pagination = value;
	}


	createOptions(){
		let options = {
			page: this.pagination.current_page + 1,
			orderBy: this.order.key,
			sortedBy: this.order.sort,
			search: this.search
		};
		if(this.include){
			options.include = this.include;
		}
		return options;
	}

}