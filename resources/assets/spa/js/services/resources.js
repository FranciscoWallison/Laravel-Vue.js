export class Jwt{
	static accessToken(email, password){
		return Vue.http.post('access_token', {
			email: email,
			password: password
		});
	}

	static logout(){
		return Vue.http.post('logout');
	}

	static refreshToken(){
		return Vue.http.post('refresh_token');
	}
}


let User = Vue.resource('user');
let Bank = Vue.resource('banks'); 
let BankAccount = Vue.resource('bank_accounts{/id}'); // com o vue resource temos todas as operações put. delete update etc
let Category = Vue.resource('categories{/id}');

export {User, BankAccount, Bank, Category};

