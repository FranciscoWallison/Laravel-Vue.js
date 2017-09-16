import {Bank} from '../services/resources';
import _ from 'lodash'; // biblioteca caraterizada pelo underscore, vai ser vir para mostrar os resultados do autocomplete    

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

const getters = {
    filterBankByName: (state) => (name) =>{ 			
	    let banks = _.filter(state.banks, (o)=>{
	        // vamos verificar se o nome existem em o.name
	       return _.includes(o.name.toLowerCase(), name.toLowerCase()); // o includes verificar se o valor existe na coleção (ver documentação do lodash)
	    });
	    return banks;
	},
    mapBanks: (state, getters) => (name) => {
		let banks = getters.filterBankByName(name);
		return banks.map((o) => {
			return {id: o.id, text: o.name};
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