//IMPORT SECTION
import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
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

// IMPORT HALAMAN PROFILE
import Profile from './pages/profile/Index.vue'

// IMPORT HALAMAN PELAPORAN
import IndexPelaporan from './pages/pelaporan/Index.vue'
import FormPelaporan from './pages/pelaporan/Form.vue'
import ScanPelaporan from './pages/pelaporan/Scan.vue'
import Laporan from './pages/pelaporan/Laporan.vue'

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
            path: '/login',
            name: 'login',
            component: Login
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

        // Aset User
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
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true,
                title: 'Profil Pengguna'
            }
        },

        // Aset Pelaporan
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
                    path: 'add/:id',
                    name: 'pelaporan.add',
                    component: FormPelaporan,
                    meta: { title: 'Add New User' }
                }
            ]
        },

        {
            path: '/lapor-aset',
            name: 'pelaporan.scan',
            component: ScanPelaporan,
            meta: { title: 'Scan Aset' }
        }

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