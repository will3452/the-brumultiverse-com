<template>
    <a class="shadow-lg mt-4 block bg-white shadow h-60 relative mr-4 w-48"
    :style="{
                'background': cover ? `url('/storage/${cover}')` : '#999',
                'background-size':'cover',
                'background-position':'center',
            }"
    style="">
        <div class="absolute w-full p-2 bg-purple-900 text-white text-center font-semibold bottom-0 text-xs">
            {{title}}
        </div>
    </a>
</template>

<script>
    export default {
        props: [
            'title',
            'cover',
        ],
        data() {
            return {
                currentZoom:1,
            }
        },
        methods: {
            mouseOverHandler() {
                this.currentZoom = 1.2;
            },
            mouseLeaveHandler() {
                this.currentZoom = 1;
            }
        },
    }
</script>
