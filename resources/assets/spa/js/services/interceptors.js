/*
	TO::DO 
	verificar se caso não tenha internet puchar as informações do localStorage;
*/

import store from '../store/store';
import appConfig from './appConfig';
import JwtToken from './jwt-token';


Vue.http.interceptors.push((request, next) =>{
	request.headers.set('Authorization', JwtToken.getAuthorizationHeader())
	next();
});

let logout = ()=>{
    store.dispatch('clearAuth');
    window.location.href = appConfig.login_url;
};


Vue.http.interceptors.push((request, next) => {
	next((request) => {

		switch(request.status) {
            case 401:    // token expirado
                return JwtToken.refreshToken()
                    .then(() => {
                        return Vue.http(request);
                    })
                    .catch(() => {
                        logout();
                    });
                break;
            default:
                if(request.data &&
                    request.data.hasOwnProperty('error') &&
                    request.data.error.includes('subscription')){
                    logout();
                }
        }
	});
})
