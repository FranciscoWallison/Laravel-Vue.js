import JwtToken from './jwt-token';
import LocalStorage from './localStorage';
import {User} from './resources';

const USER	= 'user';

const afterLogin = (response) => {
	User.get().then((response) => 
		LocalStorage.setObject(USER, response.data));
} 

export default {
	login(email, password){
		return JwtToken.accessToken(email, password).then((response) =>{
			afterLogin(response);
            return response;
        });
	},
	logout(){
		let afterLogout = () => {
			this.clearAuth();
		}

		return JwtToken.revokeToken()
				.then( afterLogout() )
				.catch( afterLogout() );
	},	
	user() {
		return LocalStorage.getObject(USER)
	},
	check(){
		return JwtToken.token ? true : false;
	},
	clearAuth(){		
		LocalStorage.remove(USER);
	}
}