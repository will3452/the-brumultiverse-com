<template>
    <div>
        <ul>
            <li v-for="chapter of chapters" :key="chapter.id" class="border rounded shadow-sm p-2 my-2">
                <div class="flex justify-between">
                    <div>
                        <span class="font-bold">
                            Chapter No.
                        </span>
                        <span>
                            {{ chapter.sq }}
                        </span>
                    </div>
                    <div>
                        <a @click="edit(chapter)" class="uppercase text-xs">[ Edit ]</a>
                    </div>
                </div>
                <div>
                    <span class="font-bold">
                       Chapter Type
                    </span>
                    <span>
                        {{ chapter.type }}
                    </span>
                </div>
                <div>
                    <span class="font-bold">
                       Age Restriction
                    </span>
                    <span>
                        {{ chapter.age_restriction || '--' }}
                    </span>
                </div>
                <div>
                    <span class="font-bold">
                        Page cover:
                    </span>
                    <span>
                        {{chapter.start_page}} - {{chapter.end_page}}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['bookId'],
        data () {
            return {
                chapters:[],
            }
        },
        methods: {
            edit (chapter) {
                return this.$emit('edit', chapter)
            }
        },
        mounted () {
            axios.get('/api/book-content-chapter/' + this.bookId)
                .then(res => this.chapters = res.data)
        },
    }
</script>
