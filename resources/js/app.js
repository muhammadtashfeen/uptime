import Vue from 'vue';
import Axios from 'axios';
import Routes from './routes';
import VueRouter from 'vue-router';
import Server from './components/server/Server';
import ServerDetails from './components/server/ServerDetails';
import Servers from './components/server/Servers';
import NewServer from './components/server/NewServer';

/**
 * Global vars
 */
window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const eventHub = new Vue()

/**
 * Register components and vue router
 */
Vue.use(VueRouter);
Vue.component('server', Server);
Vue.component('server-details', ServerDetails);
Vue.component('servers', Servers);
Vue.component('new-server', NewServer);
Vue.mixin({
    data: function () {
        return {
            eventHub: eventHub
        }
    }
})


/**
 * init
 */
const app = new Vue({
    el: '#app',
    router: new VueRouter(Routes),
});
