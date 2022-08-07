<template>
    <div class="flex">
        <div class="p-2 rounded md:w-1/2 w-full">
            <Adder
            v-show="! viewEdit"
            @update-list="reloadList"
            :book-id="bookId"
            :book-type="bookType"
            :book-content-id="bookContentId"
            :types="types"
            :cost-types="costTypes"
            :last-chapter-id="lastChapterId"
            />
            <Edit
            v-if="viewEdit"
            @close="closeEdit"
            :book-id="bookId"
            :book-type="bookType"
            :book-content-id="bookContentId"
            :types="types"
            :cost-types="costTypes"
            :last-chapter-id="lastChapterId"
            :chapter="chapter"
            @edit="editChapter"
            />
        </div>
        <div class=" md:w-1/2 w-full overflow-y-auto " style="height: 50vh;">
        <List @edit="editChapter" :book-id="bookId" :key="listKey"/>
        </div>
    </div>
</template>

<script>
import Adder from './Adder.vue'
import List from './List.vue'
import Edit from './Edit.vue'

export default {
    components: {
        Adder,
        List,
        Edit,
    },
    data () {
        return {
            chapter:{},
            viewEdit:false,
            listKey: Math.random()
        }
    },
    methods: {
        reloadList () {
            this.listKey = Math.random()
        },
        editChapter(chapter) {
            this.chapter = chapter
            console.log(chapter)
            this.viewEdit = true
        },
        closeEdit () {
            this.viewEdit = false
        }
    },
    props:['bookId', 'bookType', 'bookContentId', 'types', 'costTypes', 'lastChapterId'],
}
</script>
