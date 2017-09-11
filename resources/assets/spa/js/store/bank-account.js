import {BankAccount} from '../services/resources';

const state = {
	bankAccounts: [],
    bankAccountDelete: null,
};

const mutations = {
	set(state, bankAccounts){
		state.bankAccounts = bankAccounts;		
	},
	setDelete(state, bankAccount){
		state.bankAccountDelete = bankAccount;
	},
	'delete'(state){
		state.bankAccounts.$remove(state.bankAccountDelete);
	}
};

const actions = {
	query(context, {pagination, order, search}){
		return  BankAccount.query({
                    page: pagination.current_page + 1,
                    orderBy: order.key,
                    sortedBy: order.sort,
                    search: search,
                    include: 'bank'
                }).then((response) => {
                    context.commit('set', response.data.data);  //data.data por causa do fractal
                    let pagination_ = response.data.meta.pagination;
                    pagination_.current_page--;
                    pagination = pagination_;
                });
	},
}

const module = {
	state, mutations, actions
};

export default module;

/*
const afterLogin = function(response) {
	this.user.check = true;
	User.get()
		.then((response) => {
			this.user.data = response.data;
		});
} 

export default {
	user: {
		set data(value){
			if(!value){
				LocalStorage.remove(USER);
				this._data = null
				return;
			}
			this._data = value;
			LocalStorage.setObject(USER, value);
		},
		get data(){
			if(!this._data){
				this._data = LocalStorage.getObject(USER);
			}
			return this._data;
		},
		check: JwtToken.token ? true : false
	},
	login(email, password){
		return JwtToken.accessToken(email, password).then((response) =>{
			let afterLoginContext = afterLogin.bind(this);
			afterLoginContext(response);
            return response;
        });
	},
	logout(){
		let afterLogout = (response) => {
			this.clearAuth();
			return response;
		}

		return JwtToken.revokeToken()
				.then( afterLogout )
				.catch( afterLogout);
	},
	clearAuth(){		
		this.user.data = null;
		this.user.check = false
		// LocalStorage.remove(USER);
		JwtToken.token = null;
	}
}
*/