
require('./bootstrap');

window.Vue = require('vue').default;

import Notifications from 'vue-notification';
Vue.use(Notifications);

//import categoria from './components/Categoria.vue';
Vue.component('categorias', require('./components/Categoria.vue').default);
Vue.component('productos', require('./components/Producto.vue').default);

const app = new Vue({
    el: '#app',
});
