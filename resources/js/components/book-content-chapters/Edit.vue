<template>
    <div>
        <form action = "#" @submit.prevent="submit">
            <h2 class="text-center mb-5 text-xl">Edit {{title}}</h2>
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
                <div class="form-control mx-2" v-if="isChapter">
                    <label for="" class="label">
                        Chapter No.
                    </label>
                    <input required v-model="payload.sq" type="number" class="input text-black input-bordered input-sm rounded-none w-full">
                </div>
            </div>
            <div v-if="bookType != 'Platinum' && isChapter">
                <div class="form-control">
                <label for="" class="label">
                    Chapter types
                </label>
                <select required name="" v-model="payload.type" id="" class="select select-bordered select-sm text-black">
                    <option :value="t" v-for="t in types" :key="t">
                        {{t}}
                    </option>
                </select>
            </div>
            <div class="flex" v-if="isChapter">
                <div class="form-control mx-1" v-if="payload.type == 'Premium'">
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
            <div class="form-control mx-1" v-if="payload.type == 'Premium' && isChapter">
                <label for="" class="label">
                    Description
                </label>
                <textarea name="" v-model="payload.description" id="" cols="30" rows="5" class="rounded-0 border p-2"></textarea>
                <small class="text-s">
                    This description will appear with the prompt, confirming whether reader wishes to proceed to the Premium Chapter for 1 Purple Crystal. Make it as enticing as possible to lure them in.
                </small>
            </div>
            </div>
            <div class="form-control mx-1" v-if="isChapter">
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
        props:['bookId', 'bookType', 'bookContentId', 'types', 'costTypes', 'lastChapterId', 'chapter'],
        data () {
            return {
                payload: {},
                add:false,
            }
        },
        computed: {
            title () {
                if (this.payload.sq == -9999) {
                    return "Prologue"
                }

                if (this.payload.sq == 9999) {
                    return "Epilogue"
                }
                return this.payload.sq
            },
            isChapter() {
                return this.title == this.payload.sq
            }
        },
        mounted () {
            this.payload = this.chapter
        },
        methods: {
            cancel () {
                this.$emit('close')
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
                    this.$toastr.e("Please fill all inputs", "Error")
                    return
                }

                if (this.payload.sq <= 0 && this.payload.sq != -9999) {
                    this.$toastr.e("Invalid inputs", 'Error')
                    return
                }
                let response = await axios.post('/api/book-content-chapter/edit/' + this.chapter.id, this.payload)
                this.$toastr.s("Chapter has been updated!", "Success!");
                this.$emit('update-list')
                this.cancel()
            }
        }
    }
</script>

<style>
    .label {
        font-size: 10px;
    }
</style>
