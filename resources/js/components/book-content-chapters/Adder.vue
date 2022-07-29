<template>
    <div>
        <button class="btn btn-primary btn-sm" v-show="! add" @click="add = ! add">
            Set New Chapter
        </button>
        <form action = "#"  v-if="add" @submit.prevent="submit">
            <h2 class="text-center mb-5 text-xl uppercase">Add New </h2>
            <div class="flex">
                <div class="form-control">
                    <label for="" class="label">Type</label>
                    <select required name="" v-model="type" id="" class="select select-bordered select-sm text-black">
                    <option value="">--</option>
                    <option :value="t" v-for="t in typeOptions" :key="t">
                        {{t}}
                    </option>
                </select>
                </div>
            </div>
            <div class="flex" >
                <div class="form-control">
                    <label for="" class="label">
                        Initial page
                    </label>
                    <input required v-model="payload.start_page" type="number" class="input text-black input-bordered input-sm rounded-none w-full">
                </div>
                <div class="form-control mx-2">
                    <label for="" class="label">
                        Last page
                    </label>
                    <input required v-model="payload.end_page" type="number" class="input text-black input-bordered input-sm rounded-none w-full">
                </div>
                <div class="form-control mx-2" v-if="type == 'chapter'">
                    <label for="" class="label">
                        Chapter No.
                    </label>
                    <input required v-model="payload.sq" type="number" class="input text-black input-bordered input-sm rounded-none w-full">
                </div>
            </div>
            <div v-if="bookType != 'Platinum' && type == 'chapter'">
                <div class="form-control">
                <label for="" class="label">
                    Chapter types
                </label>
                <select required name="" v-model="payload.type" v-if="type == 'chapter'" id="" class="select select-bordered select-sm text-black">
                    <option :value="t" v-for="t in types" :key="t">
                        {{t}}
                    </option>
                </select>
            </div>
            <div class="flex">
                <div class="form-control mx-1" v-if="payload.type == 'Premium' && type == 'chapter'">
                    <label for="" class="label">
                        Age restriction
                    </label>
                    <input required type="number" v-model="payload.age_restriction" class="input text-black input-bordered input-sm rounded-none"/>
                </div>
                <div class="form-control mx-1" v-if="payload.type != 'Regular' && payload.type != 'Premium' && payload.type != 'Special'">
                    <label for="" class="label">
                        Cost
                    </label>
                    <input required type="number" v-model="payload.cost" class="input text-black input-bordered input-sm rounded-none"/>
                </div>
            </div>
            <div class="form-control mx-1" v-if="payload.type == 'Premium' && type == 'chapter'">
                <label for="" class="label">
                    Description
                </label>
                <textarea required name="" v-model="payload.description" id="" cols="30" rows="5" class="rounded-0 border p-2"></textarea>
                <small class="text-s">
                    This description will appear with the prompt, confirming whether reader wishes to proceed to the Premium Chapter for 1 Purple Crystal. Make it as enticing as possible to lure them in.
                </small>
            </div>
            </div>
            <div class="form-control mx-1" v-if="type == 'chapter'">
                <label for="" class="label">
                    Author's note
                </label>
                <textarea  name="" v-model="payload.authors_note" id="" cols="30" rows="5" class="rounded-0 border p-2"></textarea>
            </div>
            <button type="button" class="btn btn-sm btn-secondary mr-2" @click="cancel">Cancel</button>
            <button class="btn btn-primary btn-sm mt-2">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:['bookId', 'bookType', 'bookContentId', 'types', 'costTypes', 'lastChapterId'],
        data () {
            return {
                type:'chapter',
                payload: {},
                chapters: [],
                add:false,
            }
        },
        watch: {
            type (newVal, oldVal) {
                if (newVal != 'chapter') {
                    this.payload.type = 'Regular' // default
                    this.payload.cost = 0
                    this.payload.description = `${newVal} of book`
                    this.payload.sq = newVal == 'prologue' ? -9999 : 9999;
                }
            }
        },
        computed: {
            typeOptions() {
                let def = ['chapter', 'prologue', 'epilogue'];
                let remove = []
                this.chapters.forEach(e => {
                    if (e.sq == -9999) {
                        remove.push('prologue')
                    }

                    if (e.sq == 9999) {
                        remove.push('epilogue')
                    }
                })
                return def.filter( e => ((!remove.includes(e) )));
            }
        },
        mounted () {
            axios.get('/api/book-content-chapter/' + this.bookId)
                .then(res => this.chapters = res.data)

            this.payload.book_id = this.bookId
            this.payload.book_content_id = this.bookContentId

            if (this.lastChapterId == null || this.lastChapterId == undefined || this.lastChapterId == 0) {
                this.payload.sq = 1
                return
            }
            this.payload.sq = Number.parseInt(this.lastChapterId) + 1

        },
        methods: {
            cancel () {
                this.add = false
                this.payload = {}
                this.$mounted() // reload
            },
            validate (payload) {
                let keys = ['start_page', 'end_page']

                for(let i of keys) {
                    if (payload[i] == null || payload[i] == undefined || payload[i] == '') {
                        return false
                    }
                }

                return true
            },
             async submit () {
                if (! this.validate(this.payload)) {
                    this.$toastr.e("Please fill inputs", "Error")
                    return
                }

                if (this.payload.sq <= 0 && this.payload.sq != -9999) {
                    this.$toastr.e("Invalid inputs.", 'Error')
                    return
                }
                let response = await axios.post('/api/book-content-chapter', this.payload)
                this.$toastr.s("New chapter hsa been added", "Success!");
                setTimeout(() => {
                    window.location.reload()
                }, 1000);
                this.$emit('update-list')
                this.cancel()
            }
        }
    }
</script>
