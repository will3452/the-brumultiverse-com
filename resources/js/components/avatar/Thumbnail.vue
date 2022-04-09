<template>
    <img @click="clickHandler" :class="{'animate-pulse border-purple-500 bg-purple-300':active}" class="m-3 w-24 h-32 shadow border-2 rounded-md bg-white" :src="src"/>
</template>

<script>
    import Bus from './Bus.js';
    export default {
        props: ['src', 'isActive', 'id', 'type'],
        data () {
            return {
                active:false,
            }
        },
        mounted() {
            this.active = this.isActive == this.id;
            Bus.$on('change', ({type, id})=>{
                if (type == this.type && this.id != id) {
                    this.active = false;
                }
            })
        },
        methods: {
            clickHandler () {
                this.$emit('was-clicked', {type:this.type, id: this.id});
                Bus.$emit('change', {type:this.type, id: this.id});
                this.active = true;
            }
        }
    }
</script>
