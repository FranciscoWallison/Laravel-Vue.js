import LoginComponent from './components/Login.vue';
import AppComponent from './components/App.vue';

require('materialize-css')

window.Vue = require('vue');



Vue.component('app', require('./components/App.vue'));

let VueRouter = require('vue-router');
const router  = new VueRouter();

router.map({
	'login': {
		name: 'authe.login',
		component: LoginComponent
	}
})

router.start({
	components: {
		'app' : AppComponent
	}
}, 'body');

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


