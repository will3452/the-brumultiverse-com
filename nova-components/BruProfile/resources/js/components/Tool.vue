<template>
    <div class="relative p-8 bg-white mt-10">
        <div class="absolute h-48 w-full -top-20 left-0" style="background:url('/bru_assets/map_bg.jpg'); background-position:center; background-size:cover;">
        </div>
        <div class="flex items-center relative w-full mt-16">
            <img :src="`/storage/${currentAccount.picture}`" alt="profile image" class="block rounded-full shadow border" style="width:150px; height:150px; object-fit:cover;">
            <div class="w-6/12 pl-6">
                <h1 class="text-2xl tracking-wider py-4 font-bold">
                    {{currentAccount.penname}}
                </h1>
                <div class="flex items-center">
                    <div class="flex mr-8">
                        <the-gender-icon></the-gender-icon>
                        <span class="ml-2" >
                            {{currentAccount.gender}}
                        </span>
                    </div>
                    <div class="flex mr-8">
                        <the-location-icon></the-location-icon>
                        <span class="ml-2" >
                            {{currentAccount.country}}
                        </span>
                    </div>
                    <div class="flex mr-8">
                        <a class="ml-2 text-xs underline" :href="`/web/resources/accounts/${currentAccount.id}/edit`">
                            Update Account
                        </a>
                    </div>
                    <!-- <div class="flex mr-8">
                        <the-share-icon></the-share-icon>
                        <span class="ml-2" >
                            <input type="text">
                            <a href="">Share</a>
                        </span>
                    </div> -->
                </div>
                <div class="flex items-center mt-4">
                    <!-- <button class="px-4 py-2 shadow mr-3 font-bold text-white" style="background: #330747 !important;">
                        Follow
                    </button>
                    <button class="px-4 py-2 shadow mr-3 font-bold text-white bg-gray-900">
                        Message
                    </button> -->
                    <span class="font-bold">
                        1.5 K followers
                    </span>
                </div>
            </div>
            <div class="absolute top-0 right-0">
            <select name="" id="" v-model="accountIndex" class="border p-1">
                <option :value="index"  v-for="(account, index) in accounts" :key="account.id">{{account.penname}}</option>
            </select>
        </div>
        </div>

        <div class="mt-8">
            <div class="flex justify-center">
                <button v-on:click="selectHandler('Book')" :class="selectTab !== 'Book' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Books
                </button>
                <button v-on:click="selectHandler('AudioBook')" :class="selectTab !== 'AudioBook' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Audio Books
                </button>
                <button v-on:click="selectHandler('Film')" :class="selectTab !== 'Film' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Films
                </button>
                <button v-on:click="selectHandler('ArtScene')" :class="selectTab !== 'ArtScene' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Art Scenes
                </button>
                <button v-on:click="selectHandler('Podcast')" :class="selectTab !== 'Podcast' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Podcasts
                </button>
                <button v-on:click="selectHandler('Song')" :class="selectTab !== 'Song' ?{}:active" class=" text-xs border-b-2 border-gray-900 p-2">
                    Songs
                </button>
            </div>
            <transition name="fade">
                <the-section v-if="selectTab === 'Book'" :works="currentAccount.books"></the-section>
            </transition>
            <transition name="fade">
                <the-section v-if="selectTab === 'AudioBook'" :works="currentAccount.audio_books"></the-section>
            </transition>
            <transition name="fade">
                <the-section v-if="selectTab === 'Film'" :works="currentAccount.films"></the-section>
            </transition>
            <transition name="fade">
                <the-section v-if="selectTab === 'ArtScene'" :works="currentAccount.art_scenes"></the-section>
            </transition>
            <transition name="fade">
                <the-section v-if="selectTab === 'Podcast'" :works="currentAccount.podcasts"></the-section>
            </transition>
            <transition name="fade">
                <the-section v-if="selectTab === 'Song'" :works="currentAccount.songs"></the-section>
        </transition>
        </div>
    </div>
</template>

<script>
import TheLocationIcon from './TheLocationIcon.vue';
import TheShareIcon from './TheShareIcon.vue';
import TheGenderIcon from './TheGenderIcon.vue';
import TheSection from './TheSection.vue';
export default {
    metaInfo() {
        return {
          title: 'BruProfile',
        }
    },
    components: {
        TheLocationIcon,
        TheShareIcon,
        TheGenderIcon,
        TheSection,
    },
    computed: {
        currentAccount() {
            return this.accounts[this.accountIndex];
        },
    },
    data() {
        return {
            accounts: [],
            selectTab:'',
            active: {
                'bg-gray-900': true,
                'text-white':true,
            },
            accountIndex:0,
        }
    },
    methods: {
        selectHandler(e) {
            this.selectTab = e;
        },
        changeAccount() {

        },
    },
    mounted() {
        Nova.request().get('/nova-vendor/bru-profile/profile')
            .then(({data})=> {
                this.accounts = data.accounts;
                console.log(this.accounts);
                this.selectTab = 'Book';
            })
    },
}
</script>

<style>
.fade-enter-active{
  transition-property: opacity;
  transition-duration: .25s;
}

.fade-enter-active {
  transition-delay: .25s;
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>
