<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Scan QR Aset</h1>
          </div>
          <div class="col-sm-6">
            <breadcrumb></breadcrumb>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-teal">
                <h1 class="card-title">
                  Detail Data Aset {{ data.nama_aset }}
                </h1>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>ID Aset</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.id"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label for="nama_aset">Nama Aset</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.nama_aset"
                    placeholder="Nama Aset"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label for="jenis">Jenis Aset</label>
                  <select
                    class="form-control"
                    v-model="data.jenis"
                    placeholder="Jenis Aset"
                    disabled
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
                    v-model="data.merk"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea
                    class="form-control"
                    rows="3"
                    placeholder="Deskripsi aset"
                    v-model="data.deskripsi"
                    disabled
                  ></textarea>
                </div>

                <div class="form-group">
                  <label for="divisi">Divisi</label>
                  <select
                    class="form-control"
                    v-model="data.divisi"
                    placeholder="Divisi"
                    disabled
                  >
                    <option value="IT Support">IT Support</option>
                    <option value="Production">Production</option>
                    <option value="Human Resource">Human Resource</option>
                    <option value="Finance">Finance</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Kode QR</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.qr"
                    disabled
                  />
                  <br />
                  <qrcode
                    :value="data.qr"
                    :options="{ width: 200 }"
                    class="mx-auto"
                  ></qrcode>
                </div>

                <div class="form-group">
                  <label for="gambar">Gambar</label> <br />
                  <img :src="url_gambar" alt="Gambar aset" class="img-fluid" />
                </div>

                <template v-if="data.divisi != divisi">
                  <div class="alert alert-danger alert-dismissible">
                    <button
                      type="button"
                      class="close"
                      data-dismiss="alert"
                      aria-hidden="true"
                    >
                      ×
                    </button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Tidak dapat mengkonfirmasi pemindaian aset, aset tersebut
                    bukan properti divisi anda
                  </div>
                  <router-link
                    :to="{ name: 'scan' }"
                    class="btn btn-block btn-secondary btn-flat"
                    >Back Scan</router-link
                  >
                </template>
                <template v-else>
                  <template v-if="jadwal">
                    <button
                      type="button"
                      class="btn btn-block bg-teal btn-flat"
                      @click="submit"
                    >
                      Scan Aset
                    </button>
                    <router-link
                      :to="{ name: 'scan' }"
                      class="btn btn-block btn-secondary btn-flat"
                      >Back Scan</router-link
                    >
                  </template>
                  <template v-else>
                    <div class="alert alert-info alert-dismissible">
                      <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                      >
                        ×
                      </button>
                      <h5><i class="icon fas fa-info"></i> Alert!</h5>
                      Saat ini tidak ada jadwal pemindaian aset
                    </div>
                    <router-link
                      :to="{ name: 'scan' }"
                      class="btn btn-block btn-secondary btn-flat"
                      >Back Scan</router-link
                    >
                  </template>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import Breadcrumb from "../../components/Breadcrumb.vue";

export default {
  components: {
    breadcrumb: Breadcrumb,
  },
  created() {
    console.log(this.$route.params.id);
    this.getData();
    this.checkJadwal();
  },

  methods: {
    async getData() {
      let get = await axios
        .get("/api/asets/" + this.$route.params.id + "/edit")
        .then((response) => {
          let resp = response.data.data;
          // console.log(resp)
          this.data = resp;
          // console.log(this.data);
        });

      this.url_gambar = "/gambar/asets/" + this.data.gambar;
    },

    async checkJadwal() {
      let divisi = localStorage.getItem("divisi");
      let uri = "/api/jadwal/" + divisi + "/check";

      await axios.get(uri).then((response) => {
        this.jadwal = response.data.data[0];
        // console.log(response)
      });

      // console.log(this.jadwal);
    },

    async submit() {
      try {
        this.form.id_jadwal = this.jadwal.id;
        this.form.id_aset = this.data.id;
        let uri = "/api/scan/store";
        let response = await axios.post(uri, this.form);

        if (response.status == 200) {
          this.$toasted.show(response.data.message, {
            type: response.data.status,
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
    },
  },

  data() {
    return {
      data: {
        id: "",
        nama_aset: "",
        jenis: "",
        merk: "",
        divisi: "",
        deskripsi: "",
        status: "",
        qr: "qr",
        gambar: "",
        created_at: "",
        updated_at: "",
      },

      form: {},

      url_gambar: "",

      divisi: localStorage.getItem("divisi"),

      // check jadwal
      jadwal: null,
    };
  },
};
</script>

<style>
</style>