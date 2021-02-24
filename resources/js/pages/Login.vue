<!-- HTML SECTION -->
<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <router-link :to="{ name: 'home' }"
            >Sistem Manajemen Aset</router-link
          >
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <div class="input-group mb-3">
            <input
              type="email"
              class="form-control"
              placeholder="Email"
              v-model="data.email"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="data.password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
          <p class="text-danger" v-if="errors.password">
            {{ errors.password[0] }}
          </p>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" />
                <label for="remember"> Remember Me </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button
                type="submit"
                class="btn btn-primary btn-block btn-flat"
                @click.prevent="postLogin"
              >
                Login
              </button>
            </div>
            <!-- /.col -->
          </div>

          <p class="mb-1">
            <a href="#">I forgot my password</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<!-- JAVASCRIPT SECTION -->
<script>
import { mapActions, mapMutations, mapGetters, mapState } from "vuex";
export default {
  data() {
    return {
      data: {
        email: "",
        password: "",
        remember_me: false,
      },
    };
  },
  //SEBELUM COMPONENT DI-RENDER
  created() {
    //KITA MELAKUKAN PENGECEKAN JIKA SUDAH LOGIN DIMANA VALUE isAuth BERNILAI TRUE
    if (this.isAuth) {
      //MAKA DI-DIRECT KE ROUTE DENGAN NAME home
      this.$router.push({ name: "home" });
    }
  },
  computed: {
    ...mapGetters(["isAuth"]), //MENGAMBIL GETTERS isAuth DARI VUEX
    ...mapState(["errors"]),
  },
  methods: {
    ...mapActions("auth", ["submit"]), //MENGISIASI FUNGSI submit() DARI VUEX AGAR DAPAT DIGUNAKAN PADA COMPONENT TERKAIT. submit() BERASAL DARI ACTION PADA FOLDER STORES/auth.js
    ...mapMutations(["CLEAR_ERRORS"]),

    //KETIKA TOMBOL LOGIN DITEKAN, MAKA AKAN MEMINCU METHODS postLogin()
    async postLogin() {
      //DIMANA TOMBOL INI AKAN MENJALANKAN FUNGSI submit() DENGAN MENGIRIMKAN DATA YANG DIBUTUHKAN
      await this.submit(this.data).then(() => {
        //KEMUDIAN DI CEK VALUE DARI isAuth
        //APABILA BERNILAI TRUE
        if (this.isAuth) {
          this.CLEAR_ERRORS();
          //MAKA AKAN DI-DIRECT KE ROUTE DENGAN NAME home
          this.$router.push({ name: "home" });
        }
      });
    },
  },
};
</script>
