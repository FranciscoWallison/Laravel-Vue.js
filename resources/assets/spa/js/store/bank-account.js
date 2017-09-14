import {BankAccount} from '../services/resources';
import SearchOptions from '../services/search-options';
import _ from 'lodash';

const state = {
	bankAccounts: [],
	lists: [],
    bankAccountDelete: null,
    searchOptions: new SearchOptions('bank'),
};

const mutations = {
	set(state, bankAccounts){
		state.bankAccounts = bankAccounts;		
	},
	setLists(state, lists){
		state.lists = lists;
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
	lists(context){
		return BankAccount.lists().then(response => {
			context.commit('setLists', response.data.data);
		})
	},
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
    save(context, bankAccount){
    	return BankAccount.save({}, bankAccount).then((response) =>{
	       return response;
    	});
    },
    update(context,{id , bankAccount}){
		// int id , Object bankAccount
    	return BankAccount.update({id: id}, bankAccount).then((response) =>{
	       return response;
    	});
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

const getters = {
    filterBankAccountByName: (state) => (name) =>{ 			
	    let bankAccounts = _.filter(state.lists, (o)=>{	       
	       return _.includes(o.name.toLowerCase(), name.toLowerCase());
	    });
	    return bankAccounts;
	},
    mapBankAccounts: (state, getters) => (name) => {
		let bankAccounts = getters.filterBankAccountByName(name);
		return bankAccounts.map((o) => {
			return {id: o.id, text: `${o.name} - ${o.account}`};
		});
	},
};

const module = {
	namespaced: true,
	state, 
	mutations, 
	actions,
	getters
};

export default module;