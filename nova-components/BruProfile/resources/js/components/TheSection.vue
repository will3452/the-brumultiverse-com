<template>
    <div>
        <div class="flex flex-wrap justify-start mt-8 ">
            <the-section-card :cover="(work.cover && work.cover.path) || (work.art_file && work.art_file.path)" :title="work.title" :key="work.id" v-for="work in works"></the-section-card>
        </div>
        <div v-if="! works.length" class=" mt-4 p-2 text-center border-r-4 font-bold text-2xl bg-gray-300 border-gray-500">
            No data found.
        </div>
    </div>
</template>

<script>
import TheSectionCard from './TheSectionCard.vue';
    export default {
        props: [
            'title',
            'works',
        ],
        components: {
            TheSectionCard,
        },
        mounted() {
        }
    }
</script>
