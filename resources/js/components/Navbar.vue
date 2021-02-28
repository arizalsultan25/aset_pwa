<template>
  <div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-teal">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <router-link to="/" class="nav-link">Home</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="javascript:void(0)" @click="logout" class="nav-link"
            >Logout</a
          >
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside
      class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-olive"
    >
      <!-- Brand Logo -->
      <router-link to="/" class="brand-link">
        <img
          :src="'/dist/img/AdminLTELogo.png'"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">SMA</span>
      </router-link>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              :src="'/dist/img/user2-160x160.jpg'"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <router-link  :to="{ name: 'profile' }" class="d-block">{{ $store.state.data.name }}</router-link>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="/" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt text-teal"></i>
                <p>Dashboard</p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 0">
              <router-link :to="{ name: 'asets.data' }" class="nav-link">
                <i class="nav-icon fas fa-boxes text-teal"></i>
                <p>
                  Data Aset
                  <span class="right badge badge-danger">New</span>
                </p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 0">
              <router-link :to="{ name: 'jadwal.data' }" class="nav-link">
                <i class="nav-icon far fa-calendar-alt text-teal"></i>
                <p>
                  Jadwal Pemindaian Aset
                </p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 1">
              <router-link :to="{ name: 'property.data' }" class="nav-link">
                <i class="nav-icon fas fa-boxes text-teal"></i>
                <p>
                  Aset
                </p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 1">
              <router-link :to="{ name: 'scan' }" class="nav-link">
                <i class="nav-icon fas fa-qrcode text-teal"></i>
                <p>Scan Aset</p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 0">
              <router-link :to="{ name: 'pelaporan' }" class="nav-link">
                <i class="nav-icon fas fa-archive text-teal"></i>
                <p>Pelaporan Aset</p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 1">
              <router-link :to="{ name: 'pelaporan.scan' }" class="nav-link">
                <i class="nav-icon fas fa-qrcode text-teal"></i>
                <p>Lapor Kerusakan Aset</p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 1">
              <router-link :to="{ name: 'pelaporan.divisi' }" class="nav-link">
                <i class="nav-icon fas fa-scroll text-teal"></i>
                <p>Laporan Kerusakan Aset</p>
              </router-link>
            </li>

            <li class="nav-item" v-if="$store.state.data.role == 0">
              <router-link :to="{ name: 'users.data' }" class="nav-link">
                <i class="nav-icon fas fa-users text-teal"></i>
                <p>User</p>
              </router-link>
            </li>

            <li class="nav-header">ACCOUNT</li>
            <li class="nav-item">
              <router-link :to="{ name: 'profile' }" class="nav-link">
                <i class="nav-icon fas fa-user text-teal"></i>
                <p>Profil</p>
              </router-link>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" @click="logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt text-teal"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

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
