<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
        <div>
            <div v-if="progress && ! value">
                <div style="height:5px;" class="bg-40 mb-4">
                    <div id="progress" :style="{'width':`${progress}%`}" class="bg-primary" style="height:5px;"></div>
                </div>
                <div class="loader"></div>
            </div>
            <div class="flex justify-between" v-if="! progress">
                <input type="file" @change="select">
                <button type="button" class="btn-xs btn-primary" @click="createChunks">
                    upload
                </button>
            </div>
            <div v-if="value" class="bg-success p-1 text-xs font-bold uppercase text-white">
                Your file has been uploaded!
            </div>
            <input type="hidden" name="name" :value="value">
        </div>
    </template>
  </default-field>
</template>

<script>
import { nanoid } from 'nanoid';
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import axios from 'axios';

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  watch: {
        chunks(n, o) {
            if (n.length > 0) {
                this.upload();
            }
        }
    },

data() {
    return {
        file: null,
        fileName: null,
        chunks: [],
        uploaded: 0,
        value:null,
        isLoading:false,
    };
},

computed: {
    progress() {
        if (! this.file ) return 0;
        return Math.floor((this.uploaded * 100) / this.file.size);
    },
    formData() {
        let formData = new FormData;
        formData.set('is_last', this.chunks.length === 1);
        formData.set('file', this.chunks[0], `${this.fileName}.part`);

        return formData;
    },
    config() {
        return {
            method: 'POST',
            data: this.formData,
            url: '/upload-large-file',
            headers: {
                'Content-Type': 'application/octet-stream'
            },
            onUploadProgress: event => {
                this.uploaded += event.loaded;
            }
        };
    }
},

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
        setInitialValue() {
        this.value = this.field.value || ''
        },
        changeName() {
            this.fileName = nanoid();
            let splitName = this.file.name.split('.');
            let extension = splitName[splitName.length - 1];
            this.fileName = `${this.fileName}.${extension}`;
        },
        select(event) {
            this.file = event.target.files.item(0);
            this.changeName();
            console.log(this.file);
        },
        upload() {
            axios(this.config).then(({data} )=> {
                this.value = data.file.length ? data.file : null;
                this.chunks.shift();
                this.isLoading = false;
            }).catch(error => {});
        },
        createChunks() {
            this.isLoading = true;
            let size = 875000, chunks = Math.ceil(this.file.size / size);
            console.log(this.file.size);
            for (let i = 0; i < chunks; i++) {
                this.chunks.push(this.file.slice(
                    i * size, Math.min(i * size + size, this.file.size), this.file.type
                ));
            }
        },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>


<style>
    #progress {
        transition:all 500ms;
    }
    .loader {
        border: 2px solid #999;
        border-right-color: transparent;
        width:10px;
        height:10px;
        border-radius: 50%;
        animation-name: rotate;
        animation-duration: 500ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }
    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }
</style>
