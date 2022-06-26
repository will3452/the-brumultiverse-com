<template>
    <div class="flex h-screen">
        <div class="w-6/12 h-full flex overflow-hidden flex-wrap overflow-y-auto items-center">
            <thumbnail-vue
            v-if="! hair.for_premium"
            :is-user-premium="isPremium"
            :is-premium="hair.for_premium"
            :is-active="false"
            :src="uri + hair.thumbnail"
            :id="hair.id"
            v-for="hair in choices.hairstyles"
            :key="hair.id"
            @was-clicked="thumbnailHandler"
            type="hair"
            />
        </div>
        <div class="flex-col w-6/12 bg-blue-900 h-full flex items-center justify-center"  style="background:url('https://raw.githubusercontent.com/will3452/bru-assets/main/closet/base.png'); background-size:cover;background-position:center;">
            <div style="width:420px;height:594px;" class="border-2 backdrop-blur-sm">
                <img :src="currentBaseImage" alt="" class="absolute animate-pulse">
                <img :src="currentHairImage" alt="" class="absolute animate-pulse">
                <img :src="currentClothesImage" alt="" class="absolute animate-pulse">
            </div>
            <div class="flex justify-start mt-4">
                <button class="btn-student-active mt-4" @click="submit" v-if="hairActive">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
import ThumbnailVue from './Thumbnail.vue'
export default {
    components: {
        ThumbnailVue,
    },
    props: ['currentAvatar', 'gender', 'college', 'isPremium'],
    data () {
        return {
            choices: [],
            uri: 'https://brumultiverse.com/',
            hairActive:false,
        }
    },
    computed: {
        currentBaseImage () {
            return this.uri + '/storage/' + this.currentAvatar.base
        },
        currentClothesImage () {
            return this.uri + '/storage/' + this.currentAvatar.dress
        },
        currentHairImage () {
            if (! this.choices.hairstyles || ! this.choices.hairstyles.length) {
                return '#'
            }
            if (this.currentAvatar.hair && ! this.hairActive) {
                return this.uri + '/storage/' + this.currentAvatar.hair
            }
            let path = this.choices.hairstyles.find((e)=>e.id == this.hairActive);
            if (path == null) {
                return '#';
            }
            return this.uri + "/storage/" + path.path;
        },
    },
    methods: {
        thumbnailHandler ({type, id}) {
            if (type == 'hair') {
                this.hairActive = id;
            }
        },
        submit () {
            if ( this.hairActive) {
                window.location.href = `/students/closets/save-avatar?hair=${this.hairActive}`
            }
        }
    },
    mounted (){
        fetch(`${this.uri}api/avatars?gender=${this.gender}&college=${this.college}&is_premium=${this.isPremium}`)
            .then(res => res.json())
            .then(data => {
                this.choices = data
                console.log(this.choices)
            })
    }
}
</script>
