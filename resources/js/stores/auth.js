import $axios from '../api.js'
import axios from 'axios'

const state = () => ({

})

const mutations = {
    
}

const actions = {
    async submit({ commit }, payload) {
        localStorage.setItem('token', null) //RESET LOCAL STORAGE MENJADI NULL
        commit('SET_TOKEN', null, { root: true }) //RESET STATE TOKEN MENJADI NULL
        //KARENA MUTATIONS SET_TOKEN BERADA PADA ROOT STORES, MAKA DITAMBAHKAN PARAMETER
        //{ root: true }
      
        //KITA MENGGUNAKAN PROMISE AGAR FUNGSI SELANJUTNYA BERJALAN KETIKA FUNGSI INI SELESAI
        return new Promise((resolve, reject) => {
            //MENGIRIM REQUEST KE SERVER DENGAN URI /login 
            //DAN PAYLOAD ADALAH DATA YANG DIKIRIMKAN DARI COMPONENT LOGIN.VUE
            $axios.post('/login', payload)
            .then((response) => {
                //KEMUDIAN JIKA RESPONNYA SUKSES
                if (response.data.status == 'success') {
                    //MAKA LOCAL STORAGE DAN STATE TOKEN AKAN DISET MENGGUNAKAN
                    //API DARI SERVER RESPONSE
                    localStorage.setItem('token', response.data.data)
                    let token = response.data.data
                    let uri = '/api/user-authenticated/'+token

                    axios.get(uri).then((resp) => {
                        localStorage.setItem('name', resp.data.data.name)
                        localStorage.setItem('email', resp.data.data.email)
                        localStorage.setItem('role', resp.data.data.role)
                        localStorage.setItem('divisi', resp.data.data.divisi)
                    })



                    commit('SET_TOKEN', response.data.data, { root: true })
                } else {
                    commit('SET_ERRORS', { invalid: 'Email/Password Salah' }, { root: true })
                }
                //JANGAN LUPA UNTUK MELAKUKAN RESOLVE AGAR DIANGGAP SELESAI
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}