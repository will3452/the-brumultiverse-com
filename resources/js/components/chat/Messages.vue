<template>
<div ref="elem" id="message-container" style="height:65vh;" class="p-2 overflow-y-auto" :class="{'blur-sm':isLoading}">
    <div v-for="message in messages" :key="message.id">
        <other-message :date="moment(message.created_at)" v-if="message.user_id != user">
            {{message.message}}
        </other-message>
        <my-message :date="moment(message.created_at)" v-if="message.user_id == user">
            {{message.message}}
        </my-message>
    </div>
</div>
</template>

<script>
import MyMessage from './MyMessage.vue';
import OtherMessage from './OtherMessage.vue';
export default {
    props:['messages', 'user'],
    components: {
        MyMessage,
        OtherMessage,
    },
    data() {
        return {
            isLoading:true,
        }
    },
    methods: {
        moment(date) {
            return window.moment(date).fromNow();
        }
    },
    mounted () {
        setTimeout(()=>{
            this.isLoading = false;
            let elem = document.getElementById('message-container');
            elem.scrollTop = elem.scrollHeight;

        }, 2000);
    }
}
</script>
