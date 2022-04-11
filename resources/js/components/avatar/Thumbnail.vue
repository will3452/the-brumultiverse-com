<template>
    <div class="m-3 w-24 h-32 shadow border-2 rounded-md relative overflow-hidden">
        <img @click="clickHandler" :class="{'animate-pulse border-purple-500 bg-purple-300':active}" class="w-full h-full bg-white" :src="src"/>
        <div v-if="isPremium" class="w-full absolute top-3 rotate-45 -right-7 text-center text-xs bg-purple-700 text-white">Premium</div>
    </div>
</template>

<script>
    import Bus from './Bus.js';
    export default {
        props: ['src', 'isActive', 'id', 'type', 'isPremium', 'isUserPremium'],
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
                if (this.isPremium && ! this.isUserPremium) {
                    Bus.$emit('trigger-modal');
                    return;
                }
                this.$emit('was-clicked', {type:this.type, id: this.id});
                Bus.$emit('change', {type:this.type, id: this.id});
                this.active = true;
            }
        }
    }
</script>
