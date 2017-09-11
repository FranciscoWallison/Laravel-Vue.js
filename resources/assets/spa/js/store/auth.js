import JwtToken from '../services/jwt-token';
import LocalStorage from '../services/localStorage';
import {User} from '../services/resources';


const USER	= 'user';

const state = {
	user: LocalStorage.getObject(USER) || {name: ''},
	check: JwtToken.token != null 
};

const mutations = {
	setUser(state, user){
		state.user = user;
		if(user !== null){
			LocalStorage.setObject(USER , user);
		}else{
			LocalStorage.remove(USER);
		}
		
	},
	authenticated(state){
		state.check = true;
	},
	unauthenticated(state){
		state.check = false;
		JwtToken.token = null;
	}
};

const actions = {
	login(context, {email, password}){
		return JwtToken.accessToken(email, password).then((response) =>{
			context.commit('authenticated');
			context.dispatch('getUser');
            return response;
        });
	},
	getUser(context){
		return User.get().then((response) => {
				context.commit('setUser', response.data);
			});
	},
	clearAuth(context){
		context.commit('unauthenticated');
		context.commit('setUser', null);
	},
	logout(context){
		let afterLogout = (response) => {
			context.dispatch('clearAuth');
			return response;
		}

		return JwtToken.revokeToken()
				.then( afterLogout )
				.catch( afterLogout);
	}
}

const module = {
	namespaced: true,
	state, 
	mutations, 
	actions
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