<!-- HTML SECTION -->
<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline">
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
          <p class="text-danger" v-if="errors == 'failed'">Password is wrong</p>
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
                class="
                  btn btn-primary btn-block btn-flat
                  d-flex
                  align-items-center
                "
                @click.prevent="postLogin"
              >
                Login
              </button>
            </div>
            <!-- /.col -->
          </div>

          <!-- <p class="mb-1">
            <a href="#">I forgot my password</a>
          </p> -->
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
      this.$router.push({
        name: "home",
      });
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

      console.log(this.errors);

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
            this.$router.push({
              name: "home",
            });
          } else {
            this.$router.push({
              name: "home.staf",
            });
          }
        }
      });
    },
  },
};
</script>

<style>
.login-logo,
.register-logo {
  font-size: 2.1rem;
  font-weight: 300;
  margin-bottom: 0.9rem;
  text-align: center;
}

.login-logo a,
.register-logo a {
  color: #495057;
}

.login-page,
.register-page {
  -ms-flex-align: center;
  align-items: center;
  background: #e9ecef;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  height: 100vh;
  -ms-flex-pack: center;
  justify-content: center;
}

.login-box,
.register-box {
  width: 360px;
}

@media (max-width: 576px) {
  .login-box,
  .register-box {
    margin-top: 0.5rem;
    width: 90%;
  }
}

.login-card-body,
.register-card-body {
  background: #ffffff;
  border-top: 0;
  color: #666;
  padding: 20px;
}

.login-card-body .input-group .form-control,
.register-card-body .input-group .form-control {
  border-right: 0;
}

.login-card-body .input-group .form-control:focus,
.register-card-body .input-group .form-control:focus {
  box-shadow: none;
}

.login-card-body
  .input-group
  .form-control:focus
  ~ .input-group-append
  .input-group-text,
.register-card-body
  .input-group
  .form-control:focus
  ~ .input-group-append
  .input-group-text {
  border-color: #80bdff;
}

.login-card-body .input-group .form-control.is-valid:focus,
.register-card-body .input-group .form-control.is-valid:focus {
  box-shadow: none;
}

.login-card-body
  .input-group
  .form-control.is-valid
  ~ .input-group-append
  .input-group-text,
.register-card-body
  .input-group
  .form-control.is-valid
  ~ .input-group-append
  .input-group-text {
  border-color: #28a745;
}

.login-card-body .input-group .form-control.is-invalid:focus,
.register-card-body .input-group .form-control.is-invalid:focus {
  box-shadow: none;
}

.login-card-body
  .input-group
  .form-control.is-invalid
  ~ .input-group-append
  .input-group-text,
.register-card-body
  .input-group
  .form-control.is-invalid
  ~ .input-group-append
  .input-group-text {
  border-color: #dc3545;
}

.login-card-body .input-group .input-group-text,
.register-card-body .input-group .input-group-text {
  background-color: transparent;
  border-bottom-right-radius: 0.25rem;
  border-left: 0;
  border-top-right-radius: 0.25rem;
  color: #777;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.login-box-msg,
.register-box-msg {
  margin: 0;
  padding: 0 20px 20px;
  text-align: center;
}
</style>