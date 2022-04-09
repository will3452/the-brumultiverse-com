<template>
    <div class="flex h-screen w-screen">
        <div class="w-6/12 bg-blue-200 h-full">
            Controls here
        </div>
        <div class="w-6/12 bg-red-200 h-full">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['gender', 'isPremium', 'college'],
        data () {
            return {
                step: 1,
                avatar:{},
                choices: {},
            }
        },
        mounted() {

        }
    }
</script>
