export class Jwt{
	static accessToken(email, password){
		return Vue.http.post('access_token', {
			email: email,
			password: password
		});
	}
}


let User = Vue.resource('user');

export {User};

