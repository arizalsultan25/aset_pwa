// Base Vue
import Vue from 'vue'

// component
import router from './router.js'
import store from './store.js'
import App from './App.vue'

// Library
import BootstrapVue from 'bootstrap-vue'
import Toasted from 'vue-toasted';
import VueSimpleAlert from "vue-simple-alert";
import VueQrcode from '@chenfengyuan/vue-qrcode';
import VueQrcodeReader from "vue-qrcode-reader";
 

// Implementasi library pada Vue Js
Vue.use(BootstrapVue)
Vue.use(Toasted)
Vue.use(VueSimpleAlert);
Vue.component(VueQrcode.name, VueQrcode);
Vue.use(VueQrcodeReader);

// Add Bootstrap
import 'bootstrap-vue/dist/bootstrap-vue.css'

new Vue({
    el: '#dw',
    router,
    store,
    components: {
        App
    }
})