<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Buat Jadwal Pemindaian Aset</h1>
      </div>
      <div class="card-body">
        <form method="post" @submit.prevent="submit">
          <div class="form-group">
            <label>Judul</label>
            <input
              type="text"
              class="form-control"
              v-model="form.judul"
              placeholder="Judul Pemindaian Aet"
            />
            <div v-if="errors.judul" class="mt-2 text-danger">
              {{ errors.judul[0] }}
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
              <option value="Production">Production</option>
              <option value="Human Resource">Human Resource</option>
              <option value="Finance">Finance</option>
            </select>
          </div>

          <div class="form-group">
            <label>Tanggal Pemindaian</label>
            <input
              type="date"
              class="form-control"
              v-model="form.tanggal"
              placeholder="Tanggal Pemindaian Aset"
            />
            <div v-if="errors.tanggal" class="mt-2 text-danger">
              {{ errors.tanggal[0] }}
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-success" type="submit">
              <i class="fa fa-save"></i> Add New
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
  name: "AddJadwal",
  data() {
    return {
      // form
      form: {
        judul: "",
        tanggal: "",
        divisi: "IT Support",
      },

      errors: [],
    };
  },
  methods: {

    async submit() {
      try {
        let uri = "/api/jadwal/store";
        let response = await axios.post(uri, this.form);
        if (response.status == 200) {
          this.form.judul = "";
          this.form.tanggal = "";
          this.form.divisi = "IT Support";
          this.errors = []

          this.$toasted.show(response.data.message, {
            type: "success",
            duration: 3000,
          });

          // this.ambilAset();
          // console.log(response)
        }
      } catch (e) {
        console.log(e.response.data.errors);
        this.errors = e.response.data.errors;

        this.$toasted.show("Something went wrong...", {
          type: "error",
          duration: 3000,
        });
      }

      console.log(this.form)
    },
  },
};
</script>

<style>
</style>