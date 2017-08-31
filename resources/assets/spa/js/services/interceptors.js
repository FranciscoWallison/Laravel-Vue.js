/*
	TO::DO 
	verificar se caso não tenha internet puchar as informações do localStorage;
*/

import Auth from './auth';
import appConfig from './appConfig';


Vue.http.interceptors.push((request, next) =>{
	request.headers.set('Authorization', Auth.getAuthorizationHeader())
	next();
});


Vue.http.interceptors.push((request, next) => {
	next((request) => {
		if(request.status === 401){ // token expirado
			return Auth.refreshToken()
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
