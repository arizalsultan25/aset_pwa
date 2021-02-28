import $axios from '../api.js'

const state = () => ({
    jadwals: [], //UNTUK MENAMPUNG DATA JadwalS YANG DIDAPATKAN DARI DATABASE

    //UNTUK MENAMPUNG VALUE DARI FORM INPUTAN NANTINYA
    //STATE INI AKAN DIGUNAKAN PADA FORM ADD Jadwal YANG AKAN DIBAHAS KEMUDIAN
    jadwal: {
        judul : '',
        divisi: '',
        tanggal: '',
    },
    page: 1 //UNTUK MENCATAT PAGE PAGINATE YANG SEDANG DIAKSES
})

const mutations = {
    //MEMASUKKAN DATA KE STATE JadwalS
    ASSIGN_DATA(state, payload) {
        state.jadwals = payload
    },
    //MENGUBAH DATA STATE PAGE
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    //FUNGSI INI UNTUK MELAKUKAN REQUEST DATA jadwal DARI SERVER
    getJadwals({ commit, state }, payload) {
        //MENGECEK PAYLOAD ADA ATAU TIDAK
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //REQUEST DATA DENGAN ENDPOINT /JadwalS
            $axios.get(`/jadwal?page=${state.page}&q=${search}`)
                .then((response) => {
                    //SIMPAN DATA KE STATE MELALUI MUTATIONS
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },

    //FUNGSI INI UNTUK MELAKUKAN REQUEST DATA Jadwal DARI SERVER
    getJadwalsDiv({ commit, state }, payload,) {
        //MENGECEK PAYLOAD ADA ATAU TIDAK
        let search = typeof payload != 'undefined' ? payload : ''
        // let div = this
        let div = localStorage.getItem('divisi')
        return new Promise((resolve, reject) => {
            //REQUEST DATA DENGAN ENDPOINT /JadwalS
            $axios.get(`/jadwal/${div}/data?page=${state.page}&q=${search}`)
                .then((response) => {
                    //SIMPAN DATA KE STATE MELALUI MUTATIONS
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },


    //FUNGSI UNTUK MENAMBAHKAN DATA BARU
    submitJadwal({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            //MENGIRIMKAN PERMINTAAN KE SERVER DAN MELAMPIRKAN DATA YANG AKAN DISIMPAN
            //DARI STATE Jadwal
            $axios.post(`/jadwal/store`, state.jadwal)
                .then((response) => {
                    //APABILA BERHASIL KITA MELAKUKAN REQUEST LAGI
                    //UNTUK MENGAMBIL DATA TERBARU
                    dispatch('getJadwals').then(() => {
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
    //UNTUK MENGAMBIL SINGLE DATA DARI SERVER BERDASARKAN CODE Jadwal
    editJadwal({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE Jadwal DI URL
            $axios.get(`/jadwal/${payload}/edit`)
                .then((response) => {
                    //APABIL BERHASIL, DI ASSIGN KE FORM
                    commit('ASSIGN_FORM', response.data.data)
                    resolve(response.data)
                })
        })
    },
    //UNTUK MENGUPDATE DATA BERDASARKAN CODE YANG SEDANG DIEDIT
    updateJadwal({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE DIURL
            //DAN MENGIRIMKAN DATA TERBARU YANG TELAH DIEDIT
            //MELALUI STATE Jadwal
            $axios.put(`/jadwal/${payload}`, state.jadwal)
                .then((response) => {
                    //FORM DIBERSIHKAN
                    commit('CLEAR_FORM')
                    resolve(response.data)
                })
        })
    },
    //MENGHAPUS DATA 
    removeJadwal({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID Jadwal DI URL
            $axios.delete(`/jadwal/${payload}`)
                .then((response) => {
                    //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                    dispatch('getJadwals').then(() => resolve())
                })
        })
    },

    //MENGHAPUS DATA 
    removeJadwalDiv({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID Jadwal DI URL
            $axios.delete(`/jadwal/${payload}`)
                .then((response) => {
                    //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                    dispatch('getJadwalsDiv').then(() => resolve())
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