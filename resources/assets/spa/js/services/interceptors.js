import Auth from './auth';

Vue.http.interceptors.push((request, next) =>{
	request.headers.set('Authorization', Auth.getAuthorizationHeader())
	next();
});


Vue.http.interceptors.push((request, next) => {
	next((request) => {
		if(request.status === 401){ // token expirado
			return Auth.refreshToken().then(() => {
				return Vue.http(request);
			});
		}
	});
})
