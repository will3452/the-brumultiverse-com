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
import AvatarMain from './components/avatar/TheMain.vue';
Vue.component('chat-panel', ChatPanel);
Vue.component('avatar-main', AvatarMain);
const app = new Vue({
}).$mount('#app')
