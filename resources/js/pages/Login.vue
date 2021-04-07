<!-- HTML SECTION -->
<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <router-link :to="{ name: 'home' }">Aset Tree</router-link>
        </div>
        <div class="card-body">
          
          <img
            :src="'/icon/Logo.png'"
            alt="Logo Aset Tree"
            class="brand-image img-circle elevation-3 mb-2 mx-auto d-block"
            width="120"
            style="opacity: 0.8"
          />
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
          <p class="text-danger" v-if="errors == 'failed'">
            Password is wrong
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
                class="btn btn-primary btn-block btn-flat d-flex align-items-center"
                @click.prevent="postLogin"
              >
                Login
                <!-- <template v-if="loading">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    style="
                      margin: auto;
                      background: none;
                      display: block;
                      shape-rendering: auto;
                    "
                    width="30px"
                    height="20px"
                    viewBox="0 0 100 100"
                    preserveAspectRatio="xMidYMid"
                  >
                    <rect x="17.5" y="30" width="15" height="40" fill="#c2dbed">
                      <animate
                        attributeName="y"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="18;30;30"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                        begin="-0.2s"
                      ></animate>
                      <animate
                        attributeName="height"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="64;40;40"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                        begin="-0.2s"
                      ></animate>
                    </rect>
                    <rect x="42.5" y="30" width="15" height="40" fill="#c1eafa">
                      <animate
                        attributeName="y"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="20.999999999999996;30;30"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                        begin="-0.1s"
                      ></animate>
                      <animate
                        attributeName="height"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="58.00000000000001;40;40"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                        begin="-0.1s"
                      ></animate>
                    </rect>
                    <rect x="67.5" y="30" width="15" height="40" fill="#82cbe9">
                      <animate
                        attributeName="y"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="20.999999999999996;30;30"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                      ></animate>
                      <animate
                        attributeName="height"
                        repeatCount="indefinite"
                        dur="1s"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        values="58.00000000000001;40;40"
                        keySplines="0 0.5 0.5 1;0 0.5 0.5 1"
                      ></animate>
                    </rect>
                  </svg>
                </template> -->
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

      loading: false,
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
      this.loading = true;

      console.log(this.errors)

      //DIMANA TOMBOL INI AKAN MENJALANKAN FUNGSI submit() DENGAN MENGIRIMKAN DATA YANG DIBUTUHKAN
      await this.submit(this.data).then(() => {
        //KEMUDIAN DI CEK VALUE DARI isAuth
        //APABILA BERNILAI TRUE
        if (this.isAuth) {
          this.CLEAR_ERRORS();
          //MAKA AKAN DI-DIRECT KE ROUTE DENGAN NAME home
          this.loading = false;

          // Redirect Home berdasarkan hak akses
          let role = localStorage.getItem("role");
          if (role == 0) {
            this.$router.push({ name: "home" });
          } else {
            this.$router.push({ name: "home.staf" });
          }
        }
      });
    },
  },
};
</script>
