import {Bank} from '../services/resources';

const state = {
	banks: []
};

const mutations = {
	set(state, banks){
		state.banks = banks;		
	}
};

const actions = {
	query(context){		
		return  Bank.query({}).then((response) => {
                    context.commit('set', response.data.data);  //data.data por causa do fractal                   
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