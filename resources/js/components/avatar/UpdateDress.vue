<template>
    <div class="flex h-screen">
        <div class="w-6/12 h-full overflow-y-auto">
            <div class="flex flex-wrap">
            <thumbnail-vue
            :is-user-premium="isPremium"
            :is-premium="dress.for_premium"
            :is-active="false"
            :src="uri + dress.thumbnail"
            :id="dress.id"
            v-for="dress in choices.clothes"
            :key="dress.id"
            @was-clicked="thumbnailHandler"
            type="dress"
            />
            </div>
            <button class="btn-student-active fixed top-10 right-10 z-50" @click="submit" v-if="dressActive">Save</button>
        </div>
        <div v-if="modalIsActive" class="backdrop-blur backdrop-brightness-50 w-screen h-screen absolute z-50 flex justify-center items-start pt-10">
        <div class="bg-white p-4 rounded-md w-full max-w-sm">
            Hi! This option is for VIP students (premium account holders). Would you like to change your account type?
            <div class="mt-4">
                <a href="/students/register-after?step=5&redirect=closets" class="btn-student-active">Yes</a>
                <button class="btn-student" @click="modalIsActive = false">Next Time</button>
            </div>
        </div>
        </div>
        <div class="flex-col w-6/12 bg-blue-900 h-full flex items-center justify-center"  style="background:url('https://raw.githubusercontent.com/will3452/bru-assets/main/closet/base.png'); background-size:cover;background-position:center;">
            <div style="width:420px;height:594px;" class="border-2 backdrop-blur-sm">
                <img :src="currentBaseImage" alt="" class="absolute animate-pulse">
                <img :src="currentHairImage" alt="" class="absolute animate-pulse">
                <img :src="currentClothesImage" alt="" class="absolute animate-pulse">
            </div>
            <div  class="flex justify-start mt-4">

            </div>
            </div>
        </div>
    </div>
</template>

<script>
import Bus from './Bus.js'
import ThumbnailVue from './Thumbnail.vue'
export default {
    components: {
        ThumbnailVue,
    },
    props: ['currentAvatar', 'gender', 'college', 'isPremium'],
    data () {
        return {
            modalIsActive: false,
            choices: [],
            uri: 'https://brumultiverse.com/',
            dressActive:false,
        }
    },
    computed: {
        currentBaseImage () {
            return this.uri + '/storage/' + this.currentAvatar.base
        },
        currentClothesImage () {
            if (! this.choices.clothes || ! this.choices.clothes.length) {
                return '#'
            }
            if (this.currentAvatar.dress && ! this.dressActive) {
                return this.uri + '/storage/' + this.currentAvatar.dress
            }
            let path = this.choices.clothes.find((e)=>e.id == this.dressActive);
            if (path == null) {
                return '#';
            }
            return this.uri + "/storage/" + path.path;
        },
        currentHairImage () {
            return this.uri + '/storage/' + this.currentAvatar.hair
        },
    },
    methods: {
        thumbnailHandler ({type, id}) {
            if (type == 'dress') {
                this.dressActive = id;
            }
        },
        submit () {
            if ( this.dressActive) {
                window.location.href = `/students/closets/save-avatar?dress=${this.dressActive}`
            }
        }
    },
    mounted (){
        Bus.$on('trigger-modal', () => {
            this.modalIsActive = true
        })
        fetch(`${this.uri}api/avatars?gender=${this.gender}&college=${this.college}&is_premium=${this.isPremium}`)
            .then(res => res.json())
            .then(data => {
                this.choices = data
                console.log(this.choices)
            })
    }
}
</script>
