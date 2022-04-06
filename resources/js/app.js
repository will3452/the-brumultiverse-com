require('./bootstrap.js')
import 'animate.css';

// import {Howl, Howler} from 'howler';

// //sound effects
// var mouseClick = new Howl({
//     src: ['/sounds/click.wav']
// });

// window.mouseClick = mouseClick;


import Vue from 'vue';
import ChatPanel from './components/chat/Panel.vue';

Vue.component('the-interest', TheInterest);
Vue.component('chat-panel', ChatPanel);
const app = new Vue({
}).$mount('#app')
