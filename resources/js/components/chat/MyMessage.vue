<template>
<div class="flex items-start my-1 justify-end">
<div class="text-left">
    <div class="bg-neutral text-white p-2 px-4 mx-2 mr-4 text-sm w-auto max-w-md">
        <slot></slot>
    </div>
    <small class="text-xs">{{date}}</small>
</div>
</div>
</template>

<script>
    export default {
        props: [
            'date',
        ]
    }
</script>
