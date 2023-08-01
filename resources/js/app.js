require('./bootstrap');

window.Vue = require('vue');

//Vue.component('example-component', require('./components/App.vue').default);


import router from './router/index'
import App from "./components/App";
const app = new Vue({
    el: '#app',
    template:'<App/>',
    components:{App},
    router,
    mode: "no-cors"

});

