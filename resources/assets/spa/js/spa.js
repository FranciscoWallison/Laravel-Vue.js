//import LocalStorage from './services/localStorage';
import appConfig from './services/appConfig';
//import Vuex from 'vuex';

require('materialize-css')
window.Vue = require('vue');
// window.Vue.user(Vuex);

require('vue-resource');
require('vuex');
Vue.http.options.root = appConfig.api_url;

require('./services/interceptors');
require('./router');

//Preload
document.addEventListener("DOMContentLoaded", function(){
    $('.preloader-background').delay(1700).fadeOut('slow');
    
    $('.preloader-wrapper')
        .delay(1700)
        .fadeOut();
});

/*
	LocalStorage.set('name', 'Francisco Wallison');
	console.log( LocalStorage.get('name') );
	LocalStorage.remove('name');
	LocalStorage.setObject('user', {name: 'Francisco Wallison', id: 1});
	console.log(LocalStorage.getObject('user'));
*/

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


