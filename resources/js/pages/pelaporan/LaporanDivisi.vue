<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Kelola Data Pelaporan</h1>
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
            :items="laporans.data"
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

              <span class="badge badge-danger" v-else>Human Resource</span>
            </template>

            <template #cell(status)="data">
              <span
                class="badge badge-warning"
                v-if="data.item.status == 'belum ditanggapi'"
                >Belum ditanggapi</span
              >
              <span
                class="badge badge-success"
                v-else-if="data.item.status == 'diterima'"
                >Disetujui</span
              >
              <span class="badge badge-danger" v-else>Ditolak</span>
            </template>

            <template #cell(actions)="row">
                <router-link
                  :to="{ name: 'pelaporan.detail', params: { id: row.item.id } }"
                  class="btn bg-info"
                  >Lihat Detail</router-link
                >
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="laporans.data">
              <i class="fa fa-bars"></i> {{ laporans.data.length }} item dari
              {{ laporans.meta.total }} total data
            </p>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
              <b-pagination
                v-model="page"
                :total-rows="laporans.meta.total"
                :per-page="laporans.meta.per_page"
                aria-controls="laporans"
                v-if="laporans.data && laporans.data.length > 0"
              ></b-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  name: "DataLaporan",
  created() {
    //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
    this.getLaporanDiv();
  },
  data() {
    return {
      //FIELD UNTUK B-TABLE, PASTIKAN KEY NYA SESUAI DENGAN FIELD DATABASE
      //AGAR OTOMATIS DI-RENDER
      fields: [
        { key: "judul", label: "Judul Laporan" },
        { key: "nama_aset", label: "Nama Aset" },
        { key: "jenis", label: "Jenis" },
        { key: "divisi", label: "Divisi" },
        { key: "status", label: "Status" },
        { key: "qr", label: "Kode QR" },
        { key: "actions", label: "Aksi" },
      ],
      search: "",
    };
  },
  computed: {
    //MENGAMBIL DATA LaporanS DARI STATE LaporanS
    ...mapState("laporan", {
      laporans: (state) => state.laporans,
    }),
    page: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE laporan
        return this.$store.state.laporan.page;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("laporan/SET_PAGE", val);
      },
    },
  },
  watch: {
    page() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getLaporanDiv();
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getLaporanDiv(this.search);
    },
  },
  methods: {
    //MENGAMBIL FUNGSI DARI VUEX MODULE Laporan
    ...mapActions("laporan", ["getLaporanDiv"]),
    //KETIKA TOMBOL HAPUS DICLICK, MAKA AKAN MENJALANKAN METHOD INI
  },
};
</script>

<style>
</style>