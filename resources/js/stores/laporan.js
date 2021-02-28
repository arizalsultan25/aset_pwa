import $axios from '../api.js'

const state = () => ({
    laporans: [], //UNTUK MENAMPUNG DATA asetS YANG DIDAPATKAN DARI DATABASE

    //UNTUK MENAMPUNG VALUE DARI FORM INPUTAN NANTINYA
    //STATE INI AKAN DIGUNAKAN PADA FORM ADD aset YANG AKAN DIBAHAS KEMUDIAN
    laporan: {
        judul : '',
        nama_aset: '',
        jenis: '',
        divisi: '',
        status: '',
        qr: '',
        gambar: '',
        keterangan: '',
        detail : ''
    },
    page: 1 //UNTUK MENCATAT PAGE PAGINATE YANG SEDANG DIAKSES
})

const mutations = {
    //MEMASUKKAN DATA KE STATE laporanS
    ASSIGN_DATA(state, payload) {
        state.laporans = payload
    },
    //MENGUBAH DATA STATE PAGE
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    //FUNGSI INI UNTUK MELAKUKAN REQUEST DATA laporan DARI SERVER
    getLaporans({ commit, state }, payload) {
        //MENGECEK PAYLOAD ADA ATAU TIDAK
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //REQUEST DATA DENGAN ENDPOINT /AsetS
            $axios.get(`/laporan?page=${state.page}&q=${search}`)
                .then((response) => {
                    //SIMPAN DATA KE STATE MELALUI MUTATIONS
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },

    //FUNGSI INI UNTUK MELAKUKAN REQUEST DATA aset DARI SERVER
    getLaporanDiv({ commit, state }, payload,) {
        //MENGECEK PAYLOAD ADA ATAU TIDAK
        let search = typeof payload != 'undefined' ? payload : ''
        // let div = this
        let div = localStorage.getItem('divisi')
        return new Promise((resolve, reject) => {
            //REQUEST DATA DENGAN ENDPOINT /AsetS
            $axios.get(`/laporan/${div}/data?page=${state.page}&q=${search}`)
                .then((response) => {
                    //SIMPAN DATA KE STATE MELALUI MUTATIONS
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },


    //FUNGSI UNTUK MENAMBAHKAN DATA BARU
    submitLaporan({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            //MENGIRIMKAN PERMINTAAN KE SERVER DAN MELAMPIRKAN DATA YANG AKAN DISIMPAN
            //DARI STATE laporan
            $axios.post(`/laporan/store`, state.laporan)
                .then((response) => {
                    //APABILA BERHASIL KITA MELAKUKAN REQUEST LAGI
                    //UNTUK MENGAMBIL DATA TERBARU
                    dispatch('getLaporans').then(() => {
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
    //UNTUK MENGAMBIL SINGLE DATA DARI SERVER BERDASARKAN CODE Laporan
    editLaporan({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE Laporan DI URL
            $axios.get(`/laporan/${payload}/edit`)
                .then((response) => {
                    //APABIL BERHASIL, DI ASSIGN KE FORM
                    commit('ASSIGN_FORM', response.data.data)
                    resolve(response.data)
                })
        })
    },
    //UNTUK MENGUPDATE DATA BERDASARKAN CODE YANG SEDANG DIEDIT
    updateLaporan({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            //MELAKUKAN REQUEST DENGAN MENGIRIMKAN CODE DIURL
            //DAN MENGIRIMKAN DATA TERBARU YANG TELAH DIEDIT
            //MELALUI STATE Laporan
            $axios.put(`/laporan/${payload}`, state.laporan)
                .then((response) => {
                    //FORM DIBERSIHKAN
                    commit('CLEAR_FORM')
                    resolve(response.data)
                })
        })
    },
    //MENGHAPUS DATA 
    removeLaporan({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID Laporan DI URL
            $axios.delete(`/laporan/${payload}`)
                .then((response) => {
                    //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                    dispatch('getLaporans').then(() => resolve())
                })
        })
    },

    //MENGHAPUS DATA 
    removeLaporanDiv({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGHAPUS DATA
            //DENGAN METHOD DELETE DAN ID Laporan DI URL
            $axios.delete(`/laporan/${payload}`)
                .then((response) => {
                    //APABILA BERHASIL, FETCH DATA TERBARU DARI SERVER
                    dispatch('getLaporanDiv').then(() => resolve())
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