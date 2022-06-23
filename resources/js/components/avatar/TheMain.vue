<template>
<div class="relative">
    <div v-if="modalIsActive" class="backdrop-blur backdrop-brightness-50 w-screen h-screen absolute z-50 flex justify-center items-start pt-10">
        <div class="bg-white p-4 rounded-md w-full max-w-sm">
            Hi! This option is for VIP students (premium account holders). Would you like to change your account type?
            <div class="mt-4">
                <a href="/students/register-after?step=5" class="btn-student-active">Yes</a>
                <button class="btn-student" @click="modalIsActive = false">Next Time</button>
            </div>
        </div>
    </div>
    <div class="flex h-screen w-screen">

        <div class="w-6/12 h-full p-4 overflow-y-auto bg-gray-900">
            <div v-if="step == 1" class="flex flex-wrap justify-center">
                    <thumbnail-vue :is-active="baseActive" :id="base.id" :src="uri + base.thumbnail" v-for="base in choices.bases" :key="'b' + base.id" @was-clicked="thumbnailHandler" type="base"/>
            </div>
            <div v-if="step == 2" class="flex flex-wrap justify-center">
                <thumbnail-vue
                    :is-user-premium="isPremium"
                    :is-premium="hair.for_premium"
                    :is-active="hairActive"
                    :id="hair.id"
                    :src="uri + hair.thumbnail"
                    v-for="hair in choices.hairstyles"
                    :key="hair.id"
                    @was-clicked="thumbnailHandler"
                    type="hair"
                    />
            </div>
            <div v-if="step == 3" class="flex flex-wrap justify-center">
                <thumbnail-vue
                    :is-user-premium="isPremium"
                    :is-premium="clothes.for_premium"
                    :is-active="clothesActive"
                    :id="clothes.id"
                    :src="uri + clothes.thumbnail"
                    v-for="clothes in choices.clothes"
                    :key="clothes.id"
                    @was-clicked="thumbnailHandler"
                    type="clothes"
                    />
            </div>

        </div>
        <div class="w-6/12 bg-gray-200 h-full p-4 flex justify-center flex-col items-center" style="background:url('https://raw.githubusercontent.com/will3452/bru-assets/main/closet/base.png'); background-size:cover;">
            <div style="width:420px;height:594px;" class="border-2 backdrop-blur-sm">
                <img :src="currentBaseImage" alt="" class="absolute animate-pulse">
                <img :src="currentHairImage" alt="" class="absolute animate-pulse">
                <img :src="currentClothesImage" alt="" class="absolute animate-pulse">
            </div>
            <div class="flex justify-between mt-2 w-full">
                <button class="btn-student" @click="back">Back</button>
                <button class="btn-student-active" @click="stepForward">
                    <span v-text="step == 3 ? 'Finish' : 'Next'"></span>
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Bus from './Bus';
import ThumbnailVue from "./Thumbnail.vue";
    export default {
        props: ['gender', 'isPremium', 'college', 'hasAvatar', 'userId'],
        components: {
            ThumbnailVue,
        },
        data () {
            return {
                modalIsActive:false,
                baseActive:1,
                hairActive:0,
                clothesActive:0,
                uri: 'https://brumultiverse.com/',
                step: 1,
                defaultStep: 1,
                avatar:{
                    base:1,
                    hair:0,
                    clothes:0,
                },
                choices: {},
            }
        },
        mounted() {
            Bus.$on('trigger-modal',() => {
                this.modalIsActive = true;
            })
            fetch(`${this.uri}api/avatars?gender=${this.gender}&college=${this.college}&is_premium=${this.isPremium}`)
                .then(res=>res.json())
                .then((data) =>{
                    this.choices = data;
                    console.log(this.choices)
                    this.baseActive = data.bases[0].id;
                    this.hairActive = 0;
                    this.clothesActive = 0;
                    console.log(this.baseActive, this.hairActive, this.clothesActive);
                });

                if ( this.hasAvatar) {
                    this.step = 2
                    this.defaultStep = 2
                    this.fetchAvatar()
                }
        },
        methods: {
            back () {
                if ( this.step != this.defaultStep) {
                    step--
                    return
                }
                window.history.back()
            },
            async fetchAvatar () {
                let { data } = await axios.get(`/api/user/${this.userId}/avatar-get`)
                this.avatar = data
                this.baseActive = data.base
                this.hairActive = data.hair
                this.clothesActive = data.clothes
            },
            stepForward() {
                this.step++;
                if (this.step >= 4) {
                    window.location.href=`/students/avatar-saved?base=${this.avatar.base}&hair=${this.avatar.hair}&dress=${this.avatar.clothes}`;
                }
            },
            thumbnailHandler ({type, id}) {
                this.avatar[type] = id;
                console.log(this.avatar.base, this.avatar.clothes, this.avatar.hair);
                if (type == 'base') {
                    this.baseActive = id;
                }

                if (type == 'hair') {
                    this.hairActive = id;
                }

                if (type == 'clothes') {
                    this.clothesActive = id;
                }
            }
        },
        computed: {
            currentBaseImage () {
                if (! this.choices) {
                    return '#'
                }
                let path = this.choices.bases.find((e)=>e.id == this.baseActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
            currentHairImage () {
                if (! this.choices) {
                    return '#'
                }
                let path = this.choices.hairstyles.find((e)=>e.id == this.hairActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
            currentClothesImage () {
                if (! this.choices) {
                    return '#'
                }
                let path = this.choices.clothes.find((e)=>e.id == this.clothesActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
        }
    }
</script>
