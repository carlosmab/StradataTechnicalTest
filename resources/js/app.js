import Vue from 'vue';
import router from './router';
import App from './components/App';
import VueLocalStorage from 'vue-localstorage'

require('./bootstrap');

Vue.use(VueLocalStorage)

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});

