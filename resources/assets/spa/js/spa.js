import LocalStorage from './services/localStorage';
import appConfig from './services/appConfig';

require('materialize-css')
window.Vue = require('vue');


require('vue-resource');
Vue.http.options.root = appConfig.api_url;

require('./services/interceptors');
require('./router');


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


