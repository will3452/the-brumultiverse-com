<template>
    <div>
        <div class="border shadow p-2 rounded">
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
        <List @edit="editChapter" :book-id="bookId" :key="listKey"/>
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
