import {BankAccount} from '../services/resources';
import SearchOptions from '../services/search-options';

const state = {
	bankAccounts: [],
    bankAccountDelete: null,
    bankAccountSave: {
                    name: '',
                    bank_id: '',
                    agency: '',
                    account: '',
                    'default': false,
               },
    searchOptions: new SearchOptions('bank'),
};

const mutations = {
	updateName(state, name){
		state.bankAccountSave.name = name;
	},
	set(state, bankAccounts){
		state.bankAccounts = bankAccounts;		
	},
	setDelete(state, bankAccount){
		state.bankAccountDelete = bankAccount;
	},
	'delete'(state){
		state.bankAccounts.$remove(state.bankAccountDelete);
	},
	setOrder(state, key){
		state.searchOptions.order.key = key;

		let sort = state.searchOptions.order.sort;

		state.searchOptions.order.sort = sort == 'desc' ? 'asc' : 'desc';
	},
	setPagination(state, pagination){
		state.searchOptions.pagination = pagination;
	},
	setCurrentPage(state, currentPage){
		state.searchOptions.pagination.current_page = currentPage;
	},
	setFilter(state, filter){
		state.searchOptions.search = filter;
	}
};

const actions = {
	query(context){
		let searchOptions = context.state.searchOptions;
		return  BankAccount.query(searchOptions.createOptions()).then((response) => {
                    context.commit('set', response.data.data);  //data.data por causa do fractal
                    context.commit('setPagination', response.data.meta.pagination);
                });
	},
	queryWithSortBy(context, key){
		context.commit('setOrder', key);
		context.dispatch('query');
        
    },
    queryWithPagination(context, currentPage){
    	context.commit('setCurrentPage', currentPage);
    	context.dispatch('query'); // atualiza 
    },
    queryWithFilter(context){    	
    	context.dispatch('query'); // atualiza 
    },
    'delete'(context){
    	let id = context.state.bankAccountDelete.id;
    	return BankAccount.delete({id: id}).then((response) => {
    			context.commit('delete');
    			context.commit('setDelete', null);
    			let bankAccounts = context.state.bankAccounts;
    			let pagination = context.state.searchOptions.pagination;
                if(bankAccounts.length === 0 && pagination.current_page > 0){ // maior que 1
                    context.commit('setCurrentPage', pagination.current_page--);
                } 
                return response;
            });
    }
};

const module = {
	namespaced: true,
	state, 
	mutations, 
	actions
};

export default module;