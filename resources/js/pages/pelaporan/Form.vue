<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Laporkan Aset</h1>
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
              :value="form.nama_aset"
              placeholder="Nama Aset"
              disabled
            />
            <div v-if="errors.nama_aset" class="mt-2 text-danger">
              {{ errors.nama_aset[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="jenis">Jenis Aset</label>
            <select
              class="form-control"
              :value="form.jenis"
              placeholder="Jenis Aset"
              disabled
            >
              <option value="Kendaraan">Kendaraan</option>
              <option value="Furniture">Furniture</option>
              <option value="Elektronik">Elektronik</option>
              <option value="Dll">dan lain lain</option>
            </select>
          </div>

          <div class="form-group">
            <label for="merk">Merk</label>
            <input
              type="text"
              class="form-control"
              placeholder="Merk"
              :value="form.merk"
              disabled
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
              :value="form.deskripsi"
              disabled
            ></textarea>
          </div>

          <div class="form-group">
            <label for="divisi">Divisi</label>
            <select
              class="form-control"
              :value="form.divisi"
              placeholder="Divisi"
              disabled
            >
              <option value="IT Support">IT Support</option>
              <option value="Produksi">Produksi</option>
              <option value="Human Resource">Human Resource</option>
              <option value="Finance">Finance</option>
            </select>
          </div>
          <div class="form-group">
            <img :src="url_gambar" alt="Gambar aset" class="img-fluid" />
          </div>

          <hr />
          <h2 class="card-title">Form Pelaporan</h2>
          <br />

          <div class="form-group">
            <label>Judul Laporan</label>
            <input
              type="text"
              class="form-control"
              v-model="form.judul"
              placeholder="Judul Laporan"
            />
            <div v-if="errors.judul" class="mt-2 text-danger">
              {{ errors.judul[0] }}
            </div>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi Laporan</label>
            <textarea
              class="form-control"
              rows="3"
              placeholder="Deskripsi laporan"
              v-model="form.detail_laporan"
            ></textarea>
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
              <i class="fa fa-save"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
// import
import Breadcrumb from "../../components/Breadcrumb.vue";
import axios from "axios";

export default {
  name: "IndexAset",
  components: {
    breadcrumb: Breadcrumb,
  },

  created() {
    console.log(this.$route.params.id);
    this.getData();
  },

  methods: {
    async getData() {
      let get = await axios
        .get("/api/asets/" + this.$route.params.id + "/edit")
        .then((response) => {
          let resp = response.data.data;
          // console.log(resp)
          this.data = resp;
          console.log(this.data);
          this.form.nama_aset = this.data.nama_aset;
          this.form.jenis = this.data.jenis;
          this.form.merk = this.data.merk;
          this.form.divisi = this.data.divisi;
          this.form.deskripsi = this.data.deskripsi;
          this.form.id = this.data.id
          this.form.qr = this.data.qr

          this.url_gambar = "/gambar/asets/" + this.data.gambar;
        });
    },

    async submit() {
      try {
        let uri = "/api/laporan/store";
        let response = await axios.post(uri, this.form);
        if (response.status == 200) {
          this.form.judul = "";
          this.form.gambar = null;
          this.form.detail_laporan = "";
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
    },

    change: function (e) {
      e.preventDefault();
      var fileReader = new FileReader();

      fileReader.readAsDataURL(e.target.files[0]);
      console.log(e.target.files[0].name);
      this.nama_file = e.target.files[0].name;

      fileReader.onload = (e) => {
        this.form.gambar = e.target.result;
      };
    },
  },
  data() {
    return {
      data: "",

      form: {
        // data aset
        id: "",
        nama_aset: "",
        jenis: "",
        merk: "",
        divisi: "",
        deskripsi: "",
        qr: "",

        // form laporan
        judul: "",
        detail_laporan: "",
        gambar: null,
      },

      errors: [],
      nama_file: "Pilih gambar kerusakan aset",
      url_gambar: "",
    };
  },
};
</script>

<style>
</style>