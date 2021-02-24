import $axios from '../api.js'

const state = () => ({
    users: [], //UNTUK MENAMPUNG DATA USERS
    page: 1, //PAGE AKTIF
    id: '', //NANTI AKAN DIGUNAKAN UNTUK EDIT DATA

    authenticated : [], //MENAMPUNG DATA USER YANG SAAT INI LOGIN
})

const mutations = {
    //MEMASUKKAN DATA YANG DITERIMA KE DALAM STATE KURIR
    ASSIGN_DATA(state, payload) {
        state.users = payload
    },
    //MENGUBAH STATE PAGE
    SET_PAGE(state, payload) {
        state.page = payload
    },
    //MENGUBAH STATE ID
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },
    ASSIGN_USER_AUTH(state, payload){
        state.authenticated = payload
    },
}

const actions = {
    //FUNGSI INI AKAN MELAKUKAN REQUEST KE SERVER UNTUK MENGAMBILD ATA
    getUsers({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            //DENGAN MENGGUNAKAN AXIOS METHOD GET
            $axios.get(`/users?page=${state.page}&q=${search}`)
            .then((response) => {
                //KEMUDIAN DI COMMIT UNTUK MELAKUKAN PERUBAHA STATE
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
    },

    // FUNGSI ADD USERS
    //FUNGSI UNTUK MENAMBAHKAN DATA BARU
    submitUser({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            //MENGIRIMKAN PERMINTAAN KE SERVER DAN MELAMPIRKAN DATA YANG AKAN DISIMPAN
            //DARI STATE User
            $axios.post(`/users/store`, state.user)
                .then((response) => {
                    //APABILA BERHASIL KITA MELAKUKAN REQUEST LAGI
                    //UNTUK MENGAMBIL DATA TERBARU
                    dispatch('getUsers').then(() => {
                        resolve(response.data)
                    })
                })
                .catch((error) => {
                    //APABILA TERJADI ERROR VALIDASI
                    //DIMANA LARAVEL MENGGUNAKAN CODE 422
                    if (error.response.status == 422) {
                        //MAKA LIST ERROR AKAN DIASSIGN KE STATE ERRORS
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })
        })
    },

    //MENGHAPUS DATA 
    removeUser({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID User DI URL
            $axios.delete(`/users/${payload}`)
            .then((response) => {
                //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                dispatch('getUsers').then(() => resolve())
            })
        })
    },

    //MENGAMBIL DATA USER YANG SEDANG LOGIN
    getUserLogin({ commit }) {
        return new Promise((resolve, reject) => {
            $axios.get(`user-authenticated`)
            .then((response) => {
                //SIMPAN DATA USER TERSEBUT
                commit('ASSIGN_USER_AUTH', response.data.data)
                resolve(response.data)
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