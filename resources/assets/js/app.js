import Vue from 'vue';

import App from './components/App';
import router from './router';

// 
var app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});