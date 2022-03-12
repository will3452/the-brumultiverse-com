require('./bootstrap.js')
import Vue from 'vue';
import TheInterest from './components/TheInterest.vue';
import ChatPanel from './components/chat/Panel.vue';

Vue.component('the-interest', TheInterest);
Vue.component('chat-panel', ChatPanel);
const app = new Vue({
}).$mount('#app')
