import auth from './auth';
import bankAccount from './bank-account';
import Vuex from 'vuex';

export default new Vuex.Store({
	modules: {
		auth,
		bankAccount

	}
});
