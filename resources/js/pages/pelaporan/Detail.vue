<template>
  <div class="">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-info">
          <h1 class="card-title">Data Aset</h1>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="nama_aset">Nama Aset</label>
            <input
              type="text"
              class="form-control"
              :value="aset.nama_aset"
              placeholder="Nama Aset"
              disabled
            />
          </div>

          <div class="form-group">
            <label for="jenis">Jenis Aset</label>
            <select
              class="form-control"
              v-model="aset.jenis"
              disabled
              placeholder="Jenis Aset"
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
              disabled
              :value="aset.merk"
            />
          </div>

          <div class="form-group">
            <label for="divisi">Divisi</label>
            <select
              class="form-control"
              v-model="aset.divisi"
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
            <label>Kode QR</label>
            <input type="text" class="form-control" :value="aset.qr" disabled />
            <br />
            <qrcode
              :value="aset.qr"
              :options="{ width: 200 }"
              class="mx-auto"
            ></qrcode>
          </div>

          <div class="form-group">
            <label for="gambar">Gambar</label> <br />
            <img :src="url_gambar" alt="Gambar aset" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>

    <!-- card Tanggapan -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-warning">
          <h1 class="card-title">Data Laporan</h1>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Judul Laporan</label>
            <input
              type="text"
              class="form-control"
              v-model="aset.judul"
              placeholder="Nama Aset"
              disabled
            />
          </div>

          <div class="form-group">
            <label for="deskripsi">Detail Laporan</label>
            <textarea
              class="form-control"
              rows="3"
              placeholder="Deskripsi aset"
              v-model="aset.detail"
              disabled
            ></textarea>
          </div>

          <div class="form-group">
            <label for="gambar">Gambar Kerusakan aset</label> <br />
            <img
              :src="url_laporan"
              alt="Gambar kerusakan aset"
              class="img-fluid"
            />
          </div>

          <div class="form-group">
            <label for="jenis">Tanggapan</label>
            <select
              class="form-control"
              v-model="aset.status"
              placeholder="Tanggapan"
              disabled
            >
              <option value="belum ditanggapi">Belum Ditanggapi</option>
              <option value="ditolak">Tolak</option>
              <option value="diterima">Setuju</option>
            </select>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea
              class="form-control"
              rows="3"
              placeholder="-"
              v-model="aset.keterangan"
              disabled
            ></textarea>
          </div>

          <router-link class="btn bg-teal" :to="{ name: 'pelaporan.divisi' }" >Back</router-link>
        </div>
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
        .get("/api/laporan/" + this.$route.params.id + "/edit")
        .then((response) => {
          let resp = response.data.data[0];
          // console.log(resp)
          this.aset = resp;

          console.log(this.aset);
          this.form.id = this.aset.id;
          this.url_gambar = "/gambar/asets/" + this.aset.gambar;
          this.url_laporan = "/gambar/laporan/" + this.aset.gambar;
        });
    },
  },

  data() {
    return {
      aset: {
        qr: "qr",
      },

      url_gambar: "",
      url_laporan: "",
      errors: [],

      form: {
        status: "ditolak",
      },
    };
  },
};
</script>

<style>
</style>