<template>
    <div class="flex h-screen w-screen">
        <div class="w-6/12 h-full p-4 overflow-y-auto bg-gray-900">
            <div v-if="step == 1" class="flex flex-wrap justify-center">
                    <thumbnail-vue :is-premium="true" :is-active="baseActive" :id="base.id" :src="uri + base.thumbnail" v-for="base in choices.bases" :key="'b' + base.id" @was-clicked="thumbnailHandler" type="base"/>
            </div>
            <div v-if="step == 2" class="flex flex-wrap justify-center">
                <thumbnail-vue :is-active="hairActive" :id="hair.id" :src="uri + hair.thumbnail" v-for="hair in choices.hairstyles" :key="hair.id" @was-clicked="thumbnailHandler" type="hair"/>
            </div>
            <div v-if="step == 3" class="flex flex-wrap justify-center">
                <thumbnail-vue :is-active="clothesActive" :id="clothes.id" :src="uri + clothes.thumbnail" v-for="clothes in choices.clothes" :key="clothes.id" @was-clicked="thumbnailHandler" type="clothes"/>
            </div>

        </div>
        <div class="w-6/12 bg-gray-200 h-full p-4 flex justify-center flex-col items-center" style="background:url('https://raw.githubusercontent.com/will3452/bru-assets/main/closet/base.png'); background-size:cover;">
            <div style="width:420px;height:594px;" class="border-2 backdrop-blur-sm">
                <img :src="currentBaseImage" alt="" class="absolute animate-pulse">
                <img :src="currentHairImage" alt="" class="absolute animate-pulse">
                <img :src="currentClothesImage" alt="" class="absolute animate-pulse">
            </div>
            <div class="flex justify-between mt-2 w-full">
                <button class="btn-student" @click="step != 1 ? step-- : step">Back</button>
                <button class="btn-student-active" @click="step++">
                    <span v-text="step == 3 ? 'Finish' : 'Next'"></span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import ThumbnailVue from "./Thumbnail.vue";
    export default {
        props: ['gender', 'isPremium', 'college'],
        components: {
            ThumbnailVue,
        },
        data () {
            return {
                baseActive:1,
                hairActive:0,
                clothesActive:0,
                uri: 'https://brumultiverse.com/',
                step: 1,
                avatar:{
                    base:1,
                    hair:0,
                    clothes:0,
                },
                choices: {},
            }
        },
        mounted() {
            fetch(`${this.uri}api/avatars?gender=${this.gender}&college=${this.college}&is_premium=${this.isPremium}`)
                .then(res=>res.json())
                .then((data) =>{
                    this.choices = data;
                    this.baseActive = data.bases[0].id;
                    this.hairActive = 0;
                    this.clothesActive = 0;
                    console.log(this.baseActive, this.hairActive, this.clothesActive);
                });
        },
        methods: {
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
                let path = this.choices.bases.find((e)=>e.id == this.baseActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
            currentHairImage () {
                let path = this.choices.hairstyles.find((e)=>e.id == this.hairActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
            currentClothesImage () {
                let path = this.choices.clothes.find((e)=>e.id == this.clothesActive);
                if (path == null) {
                    return '#';
                }
                return this.uri + "/storage/" + path.path;
            },
        }
    }
</script>
