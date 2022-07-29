require('./bootstrap.js')
import 'animate.css';

import {Howl, Howler} from 'howler';
window.Howl = Howl
window.Howler = Howler

//sound effects
var mouseClick = new Howl({
    src: ['/sounds/click.wav']
});

window.mouseClick = mouseClick;


import Vue from 'vue';
import VueToastr from 'vue-toastr';
Vue.use(VueToastr)
Vue.config.productionTip = false;
import ChatPanel from './components/chat/Panel.vue';
import AvatarMain from './components/avatar/TheMain.vue';
import BookContentSetting from './components/book-content-chapters/Index.vue';
import UpdateHair from './components/avatar/UpdateHair.vue';
import UpdateDress from './components/avatar/UpdateDress.vue';
Vue.component('chat-panel', ChatPanel);
Vue.component('update-hair', UpdateHair)
Vue.component('update-dress', UpdateDress)
Vue.component('avatar-main', AvatarMain);
Vue.component('book-content-setting', BookContentSetting);
const app = new Vue({
}).$mount('#app')
