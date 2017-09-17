import Vuex from 'vuex';
//importando os modolos
import auth from './auth';
import bankAccount from './bank-account';
import bank from './bank';
import cashFlow from './cash-flow';
import categoryModule from './category'; //garanti a nova instancia
import billModule from './bill'; //garanti a nova instancia

import {CategoryExpense, CategoryRevenue} from '../services/resources';
import {BillPay, BillReceive} from '../services/resources';

let categoryRevenue = categoryModule(), categoryExpense = categoryModule();
categoryRevenue.state.resource =  CategoryRevenue;
categoryExpense.state.resource =  CategoryExpense;

let billPay = billModule(), billReceive = billModule();
billPay.state.resource = BillPay;
billReceive.state.resource = BillReceive;

export default new Vuex.Store({
	modules: {
		auth,
		bankAccount,
		bank,
		categoryRevenue, 
		categoryExpense,
		billPay,
		billReceive,
		cashFlow

	}
});
