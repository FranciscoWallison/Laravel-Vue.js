import Vuex from 'vuex';
import auth from './auth';
import bankAccount from './bank-account';

export default new Vuex.Store({
	modules: {
		auth,
		bankAccount

	}
});
