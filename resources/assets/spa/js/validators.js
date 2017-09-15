import VeeValidate from 'vee-validate';
import dictPMessages from './locale/validator/pt-br';

Vue.use(VeeValidate, {
	locale: 'pt-br',
	dictionary: {
		'pt-br': {
			messages: dictPMessages
		}
	}
});