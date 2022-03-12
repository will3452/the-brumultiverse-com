<template>
    <div>
        <chat-messages ref="con" :messages="messages" :user="user"></chat-messages>
        <chat-editor :chat-id="chat.id" :user="user" v-on:message-sent="pushMessage"></chat-editor>
    </div>
</template>

<script>
    import ChatMessages from './Messages.vue';
    import ChatEditor from './Editor.vue';

    export default {
        props:[
            'chat',
            'user',
        ],
        data() {
            return {
                messages:[],
            }
        },
        components: {
            ChatMessages,
            ChatEditor,
        },
        mounted () {
            this.messages = this.chat.messages;
        },
        methods : {
            async pushMessage(newMessage) {
                console.log(newMessage);
                await this.messages.push(newMessage);
                let elem = await document.getElementById('message-container');
                elem.scrollTop = await elem.scrollHeight;
                console.log('new message has been added!');
            }
        }
    }
</script>
