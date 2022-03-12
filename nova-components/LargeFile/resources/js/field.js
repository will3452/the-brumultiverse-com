import IndexField from './components/IndexField.vue';
import DetailField from './components/DetailField.vue';
import FormField from './components/FormField.vue';

Nova.booting((Vue, router, store) => {
  Vue.component('index-large-file', IndexField)
  Vue.component('detail-large-file', DetailField)
  Vue.component('form-large-file', FormField)
})
