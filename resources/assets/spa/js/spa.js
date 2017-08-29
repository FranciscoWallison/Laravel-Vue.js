import LocalStorage from './services/localStorage';

require('materialize-css')
window.Vue = require('vue');


require('vue-resource');
Vue.http.options.root = "http://192.168.1.2:8000/api";

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


