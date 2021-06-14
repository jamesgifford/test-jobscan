require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('results-component', require('./components/ResultsComponent.vue').default);

const app = new Vue({
    el: '#app',
});
