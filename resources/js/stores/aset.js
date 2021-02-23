import $axios from '../api.js'

const state = () => ({
    asets: [], //UNTUK MENAMPUNG DATA asetS YANG DIDAPATKAN DARI DATABASE

    //UNTUK MENAMPUNG VALUE DARI FORM INPUTAN NANTINYA
    //STATE INI AKAN DIGUNAKAN PADA FORM ADD aset YANG AKAN DIBAHAS KEMUDIAN
    aset: {
        nama_aset: '',
        jenis: '',
        merk: '',
        deskripsi: '',
        divisi: '',
        status: '',
        qr: '',
        gambar: '',
    },
    page: 1 //UNTUK MENCATAT PAGE PAGINATE YANG SEDANG DIAKSES
})

const mutations = {
    //MEMASUKKAN DATA KE STATE asetS
    ASSIGN_DATA(state, payload) {
        state.asets = payload
    },
    //MENGUBAH DATA STATE PAGE
    SET_PAGE(state, payload) {
        state.page = payload
    },
    //MENGUBAH DATA STATE aset
    ASSIGN_FORM(state, payload) {
        state.aset = {
            nama_aset: payload.nama_aset,
            jenis: payload.jenis,
            merk: payload.merk,
            deskripsi: payload.deskripsi,
            divisi: payload.divisi,
            status: payload.status,
            qr: payload.qr,
            gambar: payload.gambar,
        }
    },
    //ME-RESET STATE aset MENJADI KOSONG
    CLEAR_FORM(state) {
        state.aset = {
            nama_aset: '',
            jenis: '',
            merk: '',
            deskripsi: '',
            divisi: '',
            status: '',
            qr: '',
            gambar: '',
        }
    }
}

const actions = {
    //FUNGSI INI UNTUK MELAKUKAN REQUEST DATA aset DARI SERVER
    getAsets({ commit, state }, payload) {
        //MENGECEK PAYLOAD ADA ATAU TIDAK
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //REQUEST DATA DENGAN ENDPOINT /AsetS
            $axios.get(`/asets?page=${state.page}&q=${search}`)
                .then((response) => {
                    //SIMPAN DATA KE STATE MELALUI MUTATIONS
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
    //FUNGSI UNTUK MENAMBAHKAN DATA BARU
    submitAset({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            //MENGIRIMKAN PERMINTAAN KE SERVER DAN MELAMPIRKAN DATA YANG AKAN DISIMPAN
            //DARI STATE Aset
            $axios.post(`/asets/store`, state.aset)
                .then((response) => {
                    //APABILA BERHASIL KITA MELAKUKAN REQUEST LAGI
                    //UNTUK MENGAMBIL DATA TERBARU
                    dispatch('getAsets').then(() => {
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
    //UNTUK MENGAMBIL SINGLE DATA DARI SERVER BERDASARKAN CODE Aset
    editAset({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE Aset DI URL
            $axios.get(`/asets/${payload}/edit`)
                .then((response) => {
                    //APABIL BERHASIL, DI ASSIGN KE FORM
                    commit('ASSIGN_FORM', response.data.data)
                    resolve(response.data)
                })
        })
    },
    //UNTUK MENGUPDATE DATA BERDASARKAN CODE YANG SEDANG DIEDIT
    updateAset({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE DIURL
            //DAN MENGIRIMKAN DATA TERBARU YANG TELAH DIEDIT
            //MELALUI STATE Aset
            $axios.put(`/asets/${payload}`, state.aset)
                .then((response) => {
                    //FORM DIBERSIHKAN
                    commit('CLEAR_FORM')
                    resolve(response.data)
                })
        })
    },
    //MENGHAPUS DATA 
    removeAset({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID Aset DI URL
            $axios.delete(`/asets/${payload}`)
                .then((response) => {
                    //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                    dispatch('getAsets').then(() => resolve())
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