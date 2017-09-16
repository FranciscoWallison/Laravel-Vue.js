import LoginComponent from './components/Login.vue';
import LogoutComponent from './components/Logout.vue';
import DashboardComponent from  './components/Dashboard.vue';
import BankAccountListComponent from './components/bank-account/BankAccountList.vue';
import BankAccountCreateComponent from './components/bank-account/BankAccountCreate.vue';
import BankAccountUpdateComponent from './components/bank-account/BankAccountUpdate.vue';
import PlanAccountComponent from './components/category/PlanAccount.vue';
//contas a pagar
import BillPayListComponent from './components/bill/bill-pay/BillPayList.vue';
import BillPayCreateComponent from './components/bill/bill-pay/BillPayCreate.vue';
import BillPayUpdateComponent from './components/bill/bill-pay/BillPayUpdate.vue';
//contas a reveber
import BillReceiveListComponent from './components/bill/bill-receive/BillReceiveList.vue';
import BillReceiveCreateComponent from './components/bill/bill-receive/BillReceiveCreate.vue';
import BillReceiveUpdateComponent from './components/bill/bill-receive/BillReceiveUpdate.vue';

export default{
	'login': {
		name: 'auth.login',
		component: LoginComponent,
		auth: false
	},
	'logout':{
		name: 'auth.logout',
		component: LogoutComponent,
		auth: true 
	},
	'dashboard': {
		name: 'dashboard',
		component: DashboardComponent,
		auth: true
	},
	'bank-account': {
		component: {template: "<router-view></router-view>"},
		subRoutes: {
			'/': {
				name: 'bank-account.list',
				component: BankAccountListComponent,
				auth: true
			},
			'create': {
				name: 'bank-account.created',
				component: BankAccountCreateComponent,
				auth: true
			},
			'/:id/update': {
				name: 'bank-account.update',
				component: BankAccountUpdateComponent,
				auth: true
			}
		}
	},
    'plan-account': {
        name: 'plan-account.list',
        component: PlanAccountComponent,
        auth: true
    },
    'bill-pay': {
		component: {template: "<router-view></router-view>"},
		subRoutes: {
			'/': {
				name: 'bill-pay.list',
				component: BillPayListComponent,
				auth: true
			},
			'create': {
				name: 'bill-pay.created',
				component: BillPayCreateComponent,
				auth: true
			},
			'/:id/update': {
				name: 'bill-pay.update',
				component: BillPayUpdateComponent,
				auth: true
			}
		}
	},
	'bill-receive': {
		component: {template: "<router-view></router-view>"},
		subRoutes: {
			'/': {
				name: 'bill-receive.list',
				component: BillReceiveListComponent,
				auth: true
			},
			'create': {
				name: 'bill-receive.created',
				component: BillReceiveCreateComponent,
				auth: true
			},
			'/:id/update': {
				name: 'bill-receive.update',
				component: BillReceiveUpdateComponent,
				auth: true
			}
		}
	}
}