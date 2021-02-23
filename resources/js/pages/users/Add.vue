<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Tambah Data Aset</h1>
      </div>
      <div class="card-body">
        <form
          method="post"
          enctype="multipart/form-data"
          @submit.prevent="submit"
        >
          <div class="form-group">
            <label for="nama">Nama Pengguna</label>
            <input
              type="text"
              class="form-control"
              v-model="form.nama"
              placeholder="Nama Pengguna"
            />
            <div v-if="errors.nama" class="mt-2 text-danger">
              {{ errors.nama[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="merk">Email</label>
            <input
              type="email"
              class="form-control"
              placeholder="Email@mail.com"
              v-model="form.email"
              :class="{ 'is-invalid': errors.email }"
            />
            <div v-if="errors.email" class="mt-2 text-danger">
              {{ errors.email[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="merk">Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="form.password"
              maxlength="16"
              :class="{ 'is-invalid': errors.password }"
            />
            <div v-if="errors.password" class="mt-2 text-danger">
              {{ errors.password[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="merk">Konfirmasi Password</label>
            <input
              type="password"
              maxlength="16"
              class="form-control"
              placeholder="Konfirmasi Password"
              v-model="form.confirm"
              :class="{ 'is-invalid': this.errors_confirm }"
            />
            <div v-if="this.errors_confirm" class="mt-2 text-danger">
              {{ this.errors_confirm }}
            </div>
          </div>

          <div class="form-group">
            <label for="divisi">Divisi</label>
            <select
              class="form-control"
              v-model="form.divisi"
              placeholder="Divisi"
            >
              <option value="IT Support">IT Support</option>
              <option value="Produksi">Produksi</option>
              <option value="Human Resource">Human Resource</option>
              <option value="Finance">Finance</option>
            </select>
          </div>

          <div class="form-group">
            <button class="btn bg-teal btn-sm btn-flat" type="submit">
              <i class="fa fa-save"></i> Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        nama: null,
        email: null,
        password: null,
        confirm: null,
        divisi: "IT Support",
      },

      errors: [],
      errors_confirm: null,
    };
  },

  methods: {
    async submit() {
      if (this.form.password != this.form.confirm) {
        this.$toasted.show("Password dan password konfirmasi tidak cocok", {
          type: "error",
          duration: 3000,
        }),
          (this.errors_confirm = "Password konfirmasi tidak cocok");
      } else {
        console.log(this.form);
        try {
          let uri = "/api/users/store";
          let response = await axios.post(uri, this.form);
          if (response.status == 200) {
            this.form.nama = null;
            this.form.email = null;
            this.form.password = null;
            this.form.confirm = null;
            this.form.divisi = "IT Support";
            this.errors = []
            this.errors_confirm = null

            this.$toasted.show(response.data.message, {
                type: "success",
                duration: 3000,
            });
          }
        } catch (e) {
            console.log(e.response.data.errors);
            this.errors = e.response.data.errors;

            this.$toasted.show("Something went wrong...", {
            type: "error",
            duration: 3000,
            });
        }
      }
    },
  },
};
</script>

<style>
</style>