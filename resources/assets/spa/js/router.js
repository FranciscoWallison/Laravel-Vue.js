import AppComponent from './components/App.vue';
import routerMap from './router.map';
import VueRouter from 'vue-router';

const router  = new VueRouter();

router.map(routerMap);

router.start({
	components: {
		'app' : AppComponent
	}
}, 'body');