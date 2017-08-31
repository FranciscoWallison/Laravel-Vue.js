/*
	TO::DO 
	verificar se caso não tenha internet puchar as informações do localStorage;
*/

import Auth from './auth';
import appConfig from './appConfig';
import JwtToken from './jwt-token';


Vue.http.interceptors.push((request, next) =>{
	request.headers.set('Authorization', JwtToken.getAuthorizationHeader())
	next();
});


Vue.http.interceptors.push((request, next) => {
	next((request) => {
		if(request.status === 401){ // token expirado
			return JwtToken.refreshToken()
			.then(() => {
				return Vue.http(request);
			})
			.catch(() => {
				Auth.clearAuth();
				window.location.href = appConfig.login_url
			});
		}
	});
})
