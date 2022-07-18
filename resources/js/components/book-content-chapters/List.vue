<template>
    <div>
        <ul>
            <li v-for="chapter of chapters" :key="chapter.id" class="border rounded shadow-sm p-2 my-2">
             <div v-if="chapter.sq == 9999" class="font-bold">
                Epilogue
             </div>
             <div v-if="chapter.sq == -1" class="font-bold">
                Prologue
             </div>
             <div class="relative">
                <div class="absolute right-2">
                    <a @click="edit(chapter)" class="uppercase text-xs">[ Edit ]</a>
                </div>
             </div>
               <div  v-if="chapter.sq != 9999 && chapter.sq != -1">
                <div class="flex justify-between">
                    <div>
                        <span class="font-bold">
                            Chapter No.
                        </span>
                        <span>
                            {{ chapter.sq }}
                        </span>
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
