<template>
    <div class="flex items-start my-1">
        <div class="avatar">
            <div class="mb-8 rounded-btn w-10 h-10">
            <img :src="avatar" class="bg-gray-900 w-10 h-10 object-fit">
            </div>
        </div>
        <div class="text-right">
            <div class="text-left bg-gray-300 p-2 px-4 mx-2 text-sm w-auto max-w-md">
                <!-- message here -->
                <slot></slot>
            </div>
            <small class="text-xs">{{date}}</small>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'avatar',
            'date',
        ]
    }
</script>
