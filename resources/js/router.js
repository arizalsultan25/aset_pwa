//IMPORT SECTION
import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import HomeStaf from './pages/HomeStaf.vue'
import Login from './pages/Login.vue'
import store from './store.js'

// IMPORT ASET PAGES
import IndexAset from './pages/asets/Index.vue'
import DataAset from './pages/asets/Aset.vue'
import AddAset from './pages/asets/Add.vue'
import EditAset from './pages/asets/Edit.vue'
import DetailAset from './pages/asets/Detail.vue'

// IMPORT USER PAGES
import IndexUser from './pages/users/Index.vue'
import DataUser from './pages/users/User.vue'
import AddUser from './pages/users/Add.vue'
import EditUser from './pages/users/Edit.vue'

// IMPORT HALAMAN SCAN
import IndexScan from './pages/scan/Index.vue'
import DetailScan from './pages/scan/Detail.vue'
import HasilScan from './pages/scan/Hasil.vue'

// IMPORT HALAMAN PROFILE
import Profile from './pages/profile/Index.vue'

// IMPORT HALAMAN PELAPORAN
import IndexPelaporan from './pages/pelaporan/Index.vue'
import FormPelaporan from './pages/pelaporan/Form.vue'
import ScanPelaporan from './pages/pelaporan/Scan.vue'
import Laporan from './pages/pelaporan/Laporan.vue'
import TanggapiLaporan from './pages/pelaporan/Edit.vue'
import LaporanDivisi from './pages/pelaporan/LaporanDivisi.vue'
import DetailLaporan from './pages/pelaporan/Detail.vue'

// IMPORT HALAMAN ASET PER DIVISI
import IndexAsetDiv from './pages/aset_divisi/Index.vue'
import DataAsetDiv from './pages/aset_divisi/Aset.vue'
import AddAsetDiv from './pages/aset_divisi/Add.vue'
import EditAsetDiv from './pages/aset_divisi/Edit.vue'
import DetailAsetDiv from './pages/aset_divisi/Detail.vue'

// IMPORT HALAMAN JADWAL ASET
import IndexJadwal from './pages/jadwal/Index.vue'
import Jadwal from './pages/jadwal/Jadwal.vue'
import AddJadwal from './pages/jadwal/Add.vue'

// IMPORT HALAMAN JADWAL ASET DIVISI
import IndexJadwalDiv from './pages/jadwal_divisi/Index.vue'
import JadwalDiv from './pages/jadwal_divisi/Jadwal.vue'

// IMPORT HALAMAN OFFLINE
import OfflinePage from './pages/Offline.vue'

Vue.use(Router)

//DEFINE ROUTE
const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
            path: '/dashboard',
            name: 'home.staf',
            component: HomeStaf,
            meta: { requiresAuth: true }
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/offline',
            name: 'offline',
            component: OfflinePage
        },

        // Aset Routes
        {
            path: '/asets',
            component: IndexAset,
            children: [
                {
                    path: '',
                    name: 'asets.data',
                    component: DataAset,
                    meta: { title: 'Data Aset' }
                },
                {
                    path: 'add',
                    name: 'asets.add',
                    component: AddAset,
                    meta: { title: 'Add New Aset' }
                },
                {
                    path: 'edit/:id',
                    name: 'asets.edit',
                    component: EditAset,
                    meta: { title: 'Edit Aset' }
                },
                {
                    path: 'detail/:id',
                    name: 'asets.detail',
                    component: DetailAset,
                    meta: { title: 'Detail Aset' }
                }
            ]
        },

        // Route User
        {
            path: '/users',
            component: IndexUser,
            children: [
                {
                    path: '',
                    name: 'users.data',
                    component: DataUser,
                    meta: { title: 'Data User' }
                },
                {
                    path: 'add',
                    name: 'users.add',
                    component: AddUser,
                    meta: { title: 'Add New User' }
                },
                {
                    path: 'edit/:id',
                    name: 'users.edit',
                    component: EditUser,
                    meta: { title: 'Edit User' }
                }
            ]
        },

        {
            path: '/scan',
            name: 'scan',
            component: IndexScan,
            meta: {
                requiresAuth: true,
                title: 'Scan Asset'
            }
        },

        {
            path: '/scan-detail/:id',
            name: 'scan.detail',
            component: DetailScan,
            meta: {
                requiresAuth: true,
                title: 'Detail Aset'
            }
        },

        {
            path: '/scan-result/:id',
            name: 'scan.result',
            component: HasilScan,
            meta: {
                requiresAuth: true,
                title: 'Hasil Pemindaian Aset'
            }
        },

        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true,
                title: 'Profil Pengguna'
            }
        },

        // Route Pelaporan
        {
            path: '/pelaporan',
            component: IndexPelaporan,
            children: [
                {
                    path: '',
                    name: 'pelaporan',
                    component: Laporan,
                    meta: { title: 'Data Pelaporan' }
                },
                {
                    path: 'divisi',
                    name: 'pelaporan.divisi',
                    component: LaporanDivisi,
                    meta: { title: 'Data Pelaporan Divisi' }
                },
                {
                    path: 'detail/:id',
                    name: 'pelaporan.detail',
                    component: DetailLaporan,
                    meta: { title: 'Detail Pelaporan' }
                },
                {
                    path: 'add/:id',
                    name: 'pelaporan.add',
                    component: FormPelaporan,
                    meta: { title: 'Add New User' }
                },
                {
                    path: 'edit/:id',
                    name: 'pelaporan.edit',
                    component: TanggapiLaporan,
                    meta: { title: 'Tanggapi Laporan' }
                }
            ]
        },

        {
            path: '/lapor-aset',
            name: 'pelaporan.scan',
            component: ScanPelaporan,
            meta: { title: 'Scan Aset' }
        },

        // Route Aset Divisi
        {
            path: '/property',
            component: IndexAsetDiv,
            children: [
                {
                    path: '',
                    name: 'property.data',
                    component: DataAsetDiv,
                    meta: { title: 'Data Aset' }
                },
                {
                    path: 'add',
                    name: 'property.add',
                    component: AddAsetDiv,
                    meta: { title: 'Add New Aset' }
                },
                {
                    path: 'edit/:id',
                    name: 'property.edit',
                    component: EditAsetDiv,
                    meta: { title: 'Edit Aset' }
                },
                {
                    path: 'detail/:id',
                    name: 'property.detail',
                    component: DetailAsetDiv,
                    meta: { title: 'Detail Aset' }
                }
            ]
        },

        // Route Jadwal Aset Admin
        {
            path: '/jadwal',
            component: IndexJadwal,
            children: [
                {
                    path: '',
                    name: 'jadwal.data',
                    component: Jadwal,
                    meta: { title: 'Jadwal Pemindaian Aset' }
                },
                {
                    path: 'add',
                    name: 'jadwal.add',
                    component: AddJadwal,
                    meta: { title: 'Create Schedule' }
                },
            ]
         },

         // Route Jadwal Aset Divisi
        {
            path: '/jadwal-scan',
            component: IndexJadwalDiv,
            children: [
                {
                    path: '',
                    name: 'jadwal-scan.data',
                    component: JadwalDiv,
                    meta: { title: 'Jadwal Pemindaian Aset' }
                }
            ]
         },

    ]
});

//Navigation Guards
router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS') //hapus semua error

    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router