import Vue from 'vue'
import Vuex from 'vuex'

//IMPORT MODULE SECTION
import auth from './stores/auth.js'
import aset from './stores/aset.js'
import user from './stores/user.js'
import laporan from './stores/laporan.js'
import jadwal from './stores/jadwal.js'


Vue.use(Vuex)

//DEFINE ROOT STORE VUEX
const store = new Vuex.Store({
    //SEMUA MODULE YANG DIBUAT AKAN DITEPATKAN DIDALAM BAGIAN INI DAN DIPISAHKAN DENGAN KOMA UNTUK SETIAP MODULE-NYA
    modules: {
        auth,
        aset,
        user,
        laporan,
        jadwal
    },
  	//STATE HAMPIR SERUPA DENGAN PROPERTY DATA DARI COMPONENT HANYA SAJA DAPAT DIGUNAKAN SECARA GLOBAL
    state: {
        //VARIABLE TOKEN MENGAMBIL VALUE DARI LOCAL STORAGE token
        token: localStorage.getItem('token'),
        data : {
            name : localStorage.getItem('name'),
            email : localStorage.getItem('email'),
            divisi : localStorage.getItem('divisi'),
            role : localStorage.getItem('role'),
        },
        errors: []
    },
    getters: {
        //KITA MEMBUAT SEBUAH GETTERS DENGAN NAMA isAuth
        //DIMANA GETTERS INI AKAN BERNILAI TRUE/FALSE DENGAN KONDISI BERDASARKAN
        //STATE token.
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {
        //SEBUAH MUTATIONS YANG BERFUNGSI UNTUK MEMANIPULASI VALUE DARI STATE token
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_NAME(state, payload) {
            state.data.name = payload
        },
        SET_ROLE(state, payload) {
            state.data.role = payload
        },
        SET_DIVISI(state, payload) {
            state.data.divisi = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store