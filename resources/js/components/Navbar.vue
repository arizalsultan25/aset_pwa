<template>
    <div>
        <!-- Navbar -->
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" style="background-color: #20C997">

                <router-link :to="{ name: 'home' }" class="logo" v-if="$store.state.data.role == 0">
                    <img :src="'/icon/logo-nav.png'" alt="navbar brand" class="navbar-brand">
                </router-link>
                <router-link :to="{ name: 'home.staf' }" class="logo" v-if="$store.state.data.role == 1">
                    <img :src="'/icon/logo-nav.png'" alt="navbar brand" class="navbar-brand">
                </router-link>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <!-- <i class="icon-menu"></i> -->
                        <i class="fa fa-bars text-white" aria-hidden="true"></i>
                    </span>
                </button>
                <button class="topbar-toggler more">
                    <!-- <i class="icon-options-vertical"></i> -->
                    <i class="fa fa-caret-down text-white" aria-hidden="true"></i>
                </button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <!-- <i class="icon-menu"></i> -->
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg bg-success-gradient">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img :src="'/img/profile.png'" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img :src="'/img/profile.png'" alt="image profile"
                                                    class="avatar-img rounded">
                                            </div>
                                            <div class="u-text">
                                                <h4>{{  $store.state.data.name }}</h4>
                                                <p class="text-muted">{{  $store.state.data.email }}</p>
                                                <router-link :to="{ name: 'profile' }"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</router-link>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img :src="'/img/profile.png'" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" aria-expanded="true">
                                <span>
                                    {{ $store.state.data.name }}
                                    <span class="user-level" v-if="$store.state.data.role == 0">Administrator</span>
                                    <span class="user-level" v-else>Staff Divisi {{ $store.state.data.divisi }}</span>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Halaman</h4>
                        </li>

                        <!-- Menu Untuk Hak akses Admin -->
                        <li class="nav-item" v-if="$store.state.data.role == 0">
                            <router-link :to="{ name : 'home' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 0">
                            <router-link :to="{ name : 'asets.data' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-boxes"></i>
                                <p>Data Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 0">
                            <router-link :to="{ name : 'jadwal.data' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <p>Jadwal Pemindaian Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 0">
                            <router-link :to="{ name : 'pelaporan' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <p>Pelaporan Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 0">
                            <router-link :to="{ name : 'users.data' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p>Pengguna</p>
                            </router-link>
                        </li>

                        <!-- Menu Untuk Hak Akses Staff Divisi -->
                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'home.staf' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'property.data' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-boxes"></i>
                                <p>Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'jadwal-scan.data' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-calendar"></i>
                                <p>Lihat Jadwal Scan Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'scan' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <p>Scan Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'pelaporan.scan' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <p>Lapor Kerusakan Aset</p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="$store.state.data.role == 1">
                            <router-link :to="{ name : 'pelaporan.divisi' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-sticky-note "></i>
                                <p>Laporan Kerusakan Aset</p>
                            </router-link>
                        </li>

                        <!-- Menu untuk semua hak akses -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Akun</h4>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{ name : 'profile' }" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <p>Profile</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0)" @click="logout" data-toggle="collapse" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Log Out</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
    </div>
</template>

<script>
    import {
        mapState,
        mapActions
    } from "vuex";

    export default {
        methods: {
            logout() {
                return new Promise((resolve, reject) => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("divisi");
                    localStorage.removeItem("name");
                    localStorage.removeItem("email");
                    localStorage.removeItem("role");
                    resolve();
                }).then(() => {
                    this.$store.state.token = localStorage.getItem("token");
                    this.$store.state.data.name = localStorage.getItem("name");
                    this.$store.state.data.divisi = localStorage.getItem("divisi");
                    this.$store.state.data.email = localStorage.getItem("email");
                    this.$store.state.data.role = localStorage.getItem("role");

                    this.$router.push("/login");
                });
            },
        },
        computed: {
            ...mapState("user", {
                authenticated: (state) => state.authenticated,
            }),
        },

        data() {
            return {
                nama: this.$store.state.data.name,
                role: "",
                email: "",
                divisi: "",
            };
        },
    };

</script>
