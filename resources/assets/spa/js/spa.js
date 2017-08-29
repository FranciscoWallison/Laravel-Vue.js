
require('materialize-css')
window.Vue = require('vue');


require('vue-resource');
Vue.http.options.root = "http://192.168.1.2:8000/api";


require('./router');

// window.localStorage.setItem('name', 'values');
// window.localStorage.setItem('name1', 'alterado');
// window.localStorage.removeItem('name');
// window.localStorage.clear();


// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


