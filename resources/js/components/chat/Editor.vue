<template>
<div id="message_writer" class="fixed w-9/12 -right-2 bottom-0 border bg-white">
    <div class="relative w-full flex items-end ">
        <textarea :disabled="isLoading" id="message" v-model="newMessage" class="w-10/12 p-4 outline-2 outline-purple-900 textarea rounded-none" placeholder="Aa"></textarea>
        <button @click="sendMessage" class="btn btn-dark rounded-none w-2/12" :class="{'loading':isLoading}">send</button>
    </div>
</div>
</template>

<script>
    export default {
        props: [
            'user',
            'chatId',
        ],
        mounted() {
            console.log(this.user)
            console.log(`${this.chatId} chat id`)
        },
        data() {
            return {
                newMessage:'',
                isLoading:false,
                uri: '/messages/create/',
            }
        },
        methods: {
            sendMessage() {
                var newMessage = this.newMessage.replace(/^\s+|\s+$/gm,'');

                if (! newMessage.length) {
                    return false;
                }

                this.isLoading = true;
                let postUrl = this.uri + this.chatId;
                window.axios.post(postUrl, {message:newMessage})
                    .then(res=>{
                        this.isLoading = false;
                        this.newMessage = ''; // clear the message
                        if (res.status === 201) {
                            this.$emit('message-sent', res.data);
                        }
                    })
            }
        }
    }
</script>
