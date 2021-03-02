<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hasil Scan QR Aset</h1>
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
                <h1 class="card-title">Data Pemindaian Aset</h1>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Judul Pemindaian Aset</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.judul"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label>Divisi</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.divisi"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label>Tanggal</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.tanggal"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label>Total Aset</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.total"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label>Jumlah aset discan</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.scan"
                    disabled
                  />
                </div>

                <div class="form-group">
                  <label>Jumlah aset belum discan</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="data.not"
                    disabled
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <h1 class="card-title">Data Aset yang discan</h1>
              </div>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-sm-6"></div>
                  <div class="col-sm-6">
                    <div class="pull-right">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Cari..."
                        v-model="search"
                      />
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <b-table
                    striped
                    hover
                    bordered
                    :items="asets.data"
                    :fields="fields"
                    show-empty
                  >
                    <template #cell(divisi)="data">
                      <span
                        class="badge badge-primary"
                        v-if="data.item.divisi == 'IT Support'"
                        >IT Support</span
                      >
                      <span
                        class="badge badge-success"
                        v-else-if="data.item.divisi == 'Production'"
                        >Production</span
                      >

                      <span
                        class="badge badge-warning"
                        v-else-if="data.item.divisi == 'Finance'"
                        >Finance</span
                      >

                      <span class="badge badge-danger" v-else
                        >Human Resource</span
                      >
                    </template>

                    <template #cell(status)="data">
                      <span
                        class="badge badge-success"
                        v-if="data.item.status == 'baik'"
                        >OK</span
                      >
                      <span class="badge badge-danger" v-else>Rusak</span>
                    </template>

                    <template #cell(actions)="row">
                      <div
                        class="btn-group"
                        role="group"
                        aria-label="Basic example"
                      >
                        <router-link
                          :to="{
                            name: 'asets.detail',
                            params: { id: row.item.qr },
                          }"
                          type="button"
                          class="btn btn-primary"
                          >Detail</router-link
                        >
                      </div>
                    </template>
                  </b-table>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <p v-if="asets.data">
                      <i class="fa fa-bars"></i> {{ asets.data.length }} item
                      dari {{ asets.meta.total }} total data
                    </p>
                  </div>
                  <div class="col-md-6">
                    <div class="pull-right">
                      <b-pagination
                        v-model="page"
                        :total-rows="asets.meta.total"
                        :per-page="asets.meta.per_page"
                        aria-controls="asets"
                        v-if="asets.data && asets.data.length > 0"
                      ></b-pagination>
                    </div>
                  </div>
                </div>
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
import { mapActions, mapState } from "vuex";

export default {
  components: {
    breadcrumb: Breadcrumb,
  },
  created() {
    // console.log(this.$route.params.id);
    this.getData();
    this.getScannedAsets(this.$route.params.id);
  },

  methods: {
    ...mapActions("aset", ["getScannedAsets"]),

    async getData() {
      let uri = "/api/scan/" + this.$route.params.id + "/detail";
      await axios.get(uri).then((response) => {
        let res = response.data;

        this.data.judul = res.data_jadwal.judul;
        this.data.divisi = res.data_jadwal.divisi;
        this.data.tanggal = res.data_jadwal.tanggal;

        this.data.total = res.jml_aset + " aset";
        this.data.scan = res.telah_discan;
        this.data.not = res.belum_discan;

        console.log(this.data);
      });
    },
  },

  data() {
    return {
      data: {
        judul: "",
        divisi: "",
        tanggal: "",
        total: "",
        scan: "",
        not: "",
      },

      //FIELD UNTUK B-TABLE, PASTIKAN KEY NYA SESUAI DENGAN FIELD DATABASE
      //AGAR OTOMATIS DI-RENDER
      fields: [
        { key: "nama_aset", label: "Nama Aset" },
        { key: "jenis", label: "Jenis" },
        { key: "merk", label: "Merk" },
        { key: "divisi", label: "Divisi" },
        { key: "status", label: "Status" },
        { key: "qr", label: "Kode QR" },
        { key: "actions", label: "Aksi" },
      ],
      search: "",
    };
  },

  computed: {
    //MENGAMBIL DATA AsetS DARI STATE AsetS
    ...mapState("aset", {
      asets: (state) => state.asets,
    }),
    page: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE aset
        return this.$store.state.aset.page;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("aset/SET_PAGE", val);
      },
    },
  },
  watch: {
    page() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getScannedAsets(this.$route.params.id);
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getScannedAsets(this.$route.params.id, this.search);
    },
  },
};
</script>

<style>
</style>