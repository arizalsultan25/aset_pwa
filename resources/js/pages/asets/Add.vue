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
            <label for="nama_aset">Nama Aset</label>
            <input
              type="text"
              class="form-control"
              v-model="form.nama_aset"
              placeholder="Nama Aset"
            />
            <div v-if="errors.nama_aset" class="mt-2 text-danger">
              {{ errors.nama_aset[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="jenis">Jenis Aset</label>
            <select
              class="form-control"
              v-model="form.jenis"
              placeholder="Jenis Aset"
            >
              <option value="Kendaraan">Kendaraan</option>
              <option value="Furniture">Furniture</option>
              <option value="Elektronik">Elektronik</option>
              <option value="Dokumen">Dokumen</option>
            </select>
          </div>

          <div class="form-group">
            <label for="merk">Merk</label>
            <input
              type="text"
              class="form-control"
              placeholder="Merk"
              v-model="form.merk"
              :class="{ 'is-invalid': errors.merk }"
            />
            <div v-if="errors.merk" class="mt-2 text-danger">
              {{ errors.merk[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea
              class="form-control"
              rows="3"
              placeholder="Deskripsi aset"
              v-model="form.deskripsi"
            ></textarea>
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
            <label for="gambar">Gambar Aset</label>
            <div class="custom-file">
              <input
                type="file"
                class="custom-file-input"
                id="gambar"
                @change="change"
              />
              <label class="custom-file-label" for="gambar">{{
                nama_file
              }}</label>
            </div>
            <div v-if="errors.gambar" class="mt-2 text-danger">
              {{ errors.gambar[0] }}
            </div>
          </div>

          <div class="form-group">
            <button class="btn bg-teal btn-sm btn-flat" type="submit">
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
  name: "AddAset",
  data() {
    return {
      // form
      form: {
        nama_aset: "",
        jenis: "Elektronik",
        merk: "",
        deskripsi: "",
        divisi: "IT Support",
        gambar: null,
      },

      errors: [],

      nama_file: "Pilih gambar aset",
    };
  },
  methods: {
    // ...mapActions("aset", ["submitAset"]), //PANGGIL ACTIONS submitAset
    // submit() {
    //   //KETIKA TOMBOL DITEKAN MAKA FUNGSI INI AKAN DIJALANKAN
    //   //DIMANA FUNGSI INI TELAH DIBUAT PADA SESI SEBELUMNYA
    //   this.submitAset().then(() => {
    //     //APABILA BERHASIL MAKA AKAN DI-DIRECT KE HALAMAN /Asets
    //     this.$router.push({ name: "asets.data" });
    //   });
    // },

    change: function (e) {
      e.preventDefault();
      var fileReader = new FileReader();

      fileReader.readAsDataURL(e.target.files[0]);
      console.log(e.target.files[0].name);
      this.nama_file = e.target.files[0].name;

      fileReader.onload = (e) => {
        this.form.gambar = e.target.result;
        // this.nama_file = e.target.name
        // console.log(this.form.gambar)
      };
    },

    async submit() {
      try {
        let uri = "/api/asets/store";
        let response = await axios.post(uri, this.form);
        if (response.status == 200) {
          this.form.nama_aset = "";
          this.form.jenis = "Elektronik";
          this.form.merk = "";
          this.form.deskripsi = "";
          this.form.divisi = "IT Support";
          this.form.gambar = null;
          (this.nama_file = "Pilih gambar aset"), (this.errors = []);
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

      // console.log(this.form)
    },
  },
};
</script>

<style>
</style>