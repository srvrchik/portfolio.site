import './bootstrap';

import Vue from 'vue';
import router from './router/index';
import store from './store/index';
import vuetify from './vuetify/index';
import i18n from './i18n/index';

Vue.config.productionTip = false;

import App from './components/App';

store.dispatch('user/getUser');


const app = new Vue({
    el: '#app',
    router,
    components: {
        app: App
    },
    i18n,
    store,
    vuetify,
});
