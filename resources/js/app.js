import Vue from 'vue';
import Axios from 'axios';
import Routes from './routes';
import VueRouter from 'vue-router';
import Server from './components/server/Server';
import Servers from './components/server/Servers';
import NewServer from './components/server/NewServer';

window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


/**
 * Register components and vue router
 */

Vue.use(VueRouter);
Vue.component('server', Server);
Vue.component('servers', Servers);
Vue.component('new-server', NewServer);

/**
 * init
 */
const app = new Vue({
    el: '#app',
    router: new VueRouter(Routes),
});
