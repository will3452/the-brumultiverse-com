<template>
    <div class="flex h-screen w-screen">
        <div class="w-6/12 h-full p-4 overflow-y-auto">
            <div v-if="step == 1" class="flex flex-wrap">
                <thumbnail-vue :is-active="baseActive" :id="base.id" :src="uri + base.thumbnail" v-for="base in choices.bases" :key="base.id" @was-clicked="thumbnailHandler" type="base"/>
            </div>
            <div v-if="step == 2" class="flex flex-wrap">
                <thumbnail-vue :is-active="hairActive" :id="hair.id" :src="uri + hair.thumbnail" v-for="hair in choices.hairstyles" :key="hair.id" @was-clicked="thumbnailHandler" type="hair"/>
            </div>
            <div v-if="step == 3" class="flex flex-wrap">
                <thumbnail-vue :is-active="clothesActive" :id="clothes.id" :src="uri + clothes.thumbnail" v-for="clothes in choices.clothes" :key="clothes.id" @was-clicked="thumbnailHandler" type="hair"/>
            </div>
            <div class="flex justify-between">
                <button class="btn-student" @click="step != 1 ? step-- : step">Back</button>
                <button class="btn-student-active" @click="step++">Apply</button>
            </div>
        </div>
        <div class="w-6/12 bg-gray-200 h-full p-4 flex justify-center">
            <div style="width:420px;height:594px;" class="border-2 bg-red-200">
                <img :src="currentBaseImage" alt="" class="absolute">
                <img :src="currentHairImage" alt="" class="absolute">
                <img :src="currentClothesImage" alt="" class="absolute">
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
                hairActive:1,
                clothesActive:1,
                uri: 'https://brumultiverse.com/',
                step: 1,
                avatar:{
                    base:1,
                    hair:1,
                    clothes:1,
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
                    this.hairActive = data.hairstyles[0].id;
                    this.clothesActive = data.clothes[0].id;
                });
        },
        methods: {
            thumbnailHandler ({type, id}) {
                this.avatar[type] = id;
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
