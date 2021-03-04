<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-warning">
        <h1 class="card-title">Ubah Data Aset</h1>
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
              <option value="Produksi">Produksi</option>
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
              <i class="fa fa-save"></i> Update
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
  name: "EditAset",
  created() {
    //SEBELUM COMPONENT DI-RENDER KITA MELAKUKAN REQUEST KESERVER
    //BERDASARKAN CODE YANG ADA DI URL
    // this.editAset(this.$route.params.id);
    console.log(this.$route.params.id);
    this.getData();
  },

  methods: {
    async getData() {
      await axios
        .get("/api/asets/" + this.$route.params.id + "/edit")
        .then((response) => {
          let resp = response.data.data;
          // console.log(resp)
          this.aset = resp;

          this.form.nama_aset = this.aset.nama_aset
          this.form.jenis = this.aset.jenis
          this.form.merk = this.aset.merk
          this.form.divisi = this.aset.divisi
          this.form.deskripsi = this.aset.deskripsi
          // console.log(this.aset);
        })
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

    async submit() {
      console.log(this.aset)
      
      try {
        let uri = `/api/asets/${this.$route.params.id}/edit`
        let response = await axios.post(uri, this.form)
        
        
        if (response.status == 200) {
          this.$toasted.show("Aset telah berhasil diupdate", {
            type: "success",
            duration: 3000,
          });
        }
      } catch (e) {
        // console.log(e.response.data.errors);
        this.errors = e.response.data.errors;

        this.$toasted.show("Something went wrong...", {
          type: "error",
          duration: 3000,
        });
      }
    },
  },

  data() {
    return {
      aset: {
        id: "",
        nama_aset: "",
        jenis: "",
        merk: "",
        divisi: "",
        deskripsi: "",
        qr: "",
        gambar: null,
      },
      
      form: {
        id: "",
        nama_aset: "",
        jenis: "",
        merk: "",
        divisi: "",
        deskripsi: "",
        qr: "",
        gambar: null,
      },


      nama_file: "Pilih gambar aset",
      errors: [],
    };
  },
};
</script>

<style>
</style>