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
import VueMoment from 'vue-moment'
import Chart from 'chart.js';


// Implementasi library pada Vue Js
Vue.use(BootstrapVue)
Vue.use(Toasted)
Vue.use(VueSimpleAlert);
Vue.component(VueQrcode.name, VueQrcode);
Vue.use(VueQrcodeReader);
Vue.use(VueMoment);

// Add Bootstrap
import 'bootstrap-vue/dist/bootstrap-vue.css'

import { mapActions, mapGetters, mapState } from 'vuex'


new Vue({
    el: '#dw',
    router,
    store,
    components: {
        App
    },
    computed: {
        ...mapGetters(['isAuth']),
        ...mapState(['token']),
        ...mapState('user', {
            user_authenticated: state => state.authenticated
        })
    },
    
})