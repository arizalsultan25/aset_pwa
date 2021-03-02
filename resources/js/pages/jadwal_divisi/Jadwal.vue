<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-warning">
        <h1 class="card-title">Jadwal Pemindaian Aset Hari ini</h1>
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
            :items="jadwals.data"
            :fields="fields_aksi"
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

            <template #cell(tanggal)="row">
              <p>{{ row.item.tanggal | moment("ddd, D MMM YYYY") }}</p>
            </template>

            <template #cell(actions)="row">
              <div class="btn-group" role="group" aria-label="Basic example">
                <router-link :to="{ name: 'scan.result', params: {id: row.item.id} }" class="btn bg-teal"> Lihat Detail</router-link>
              </div>
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="jadwals.data">
              <i class="fa fa-bars"></i> {{ jadwals.data.length }} item dari
              {{ jadwals.meta.total }} total data
            </p>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
              <b-pagination
                v-model="page"
                :total-rows="jadwals.meta.total"
                :per-page="jadwals.meta.per_page"
                aria-controls="jadwals"
                v-if="jadwals.data && jadwals.data.length > 0"
              ></b-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-info">
        <h1 class="card-title">Jadwal Pemindaian yang akan Datang</h1>
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
                v-model="search_future"
              />
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <b-table
            striped
            hover
            bordered
            :items="jadwals_future.data"
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

            <template #cell(tanggal)="row">
              <p>{{ row.item.tanggal | moment("ddd, D MMM YYYY") }}</p>
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="jadwals_future.data">
              <i class="fa fa-bars"></i> {{ jadwals_future.data.length }} item
              dari {{ jadwals_future.meta.total }} total data
            </p>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
              <b-pagination
                v-model="page"
                :total-rows="jadwals_future.meta.total"
                :per-page="jadwals_future.meta.per_page"
                aria-controls="jadwals"
                v-if="jadwals_future.data && jadwals_future.data.length > 0"
              ></b-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-secondary">
        <h1 class="card-title">Jadwal Pemindaian Lampau</h1>
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
                v-model="search_past"
              />
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <b-table
            striped
            hover
            bordered
            :items="jadwals_past.data"
            :fields="fields_aksi"
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

            <template #cell(tanggal)="row">
              <p>{{ row.item.tanggal | moment("ddd, D MMM YYYY") }}</p>
            </template>

            <template #cell(actions)="row">
              <div class="btn-group" role="group" aria-label="Basic example">
                <router-link :to="{ name: 'scan.result', params: {id: row.item.id} }" class="btn bg-teal"> Lihat Detail</router-link>
              </div>
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="jadwals_past.data">
              <i class="fa fa-bars"></i> {{ jadwals_past.data.length }} item
              dari {{ jadwals_past.meta.total }} total data
            </p>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
              <b-pagination
                v-model="page"
                :total-rows="jadwals_past.meta.total"
                :per-page="jadwals_past.meta.per_page"
                aria-controls="jadwals"
                v-if="jadwals_past.data && jadwals_past.data.length > 0"
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
  name: "DataJadwal",
  created() {
    //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
    this.getJadwalsDiv();
    this.getJadwalsDivFuture();
    this.getJadwalsDivPast();
  },
  data() {
    return {
      //FIELD UNTUK B-TABLE, PASTIKAN KEY NYA SESUAI DENGAN FIELD DATABASE
      //AGAR OTOMATIS DI-RENDER
      fields: [
        { key: "judul", label: "Judul Pemindaian" },
        { key: "divisi", label: "Divisi" },
        { key: "tanggal", label: "Tanggal" },
        { key: "created_at", label: "Dibuat pada" },
      ],

      fields_aksi: [
        { key: "judul", label: "Judul Pemindaian" },
        { key: "divisi", label: "Divisi" },
        { key: "tanggal", label: "Tanggal" },
        // { key: "status", label: "Status" },
        { key: "created_at", label: "Dibuat pada" },
        { key: "actions", label: "Aksi" },
      ],

      search: "",
      search_future: "",
      search_past: "",
    };
  },
  computed: {
    //MENGAMBIL DATA AsetS DARI STATE AsetS
    ...mapState("jadwal", {
      jadwals: (state) => state.jadwals,
      jadwals_future: (state) => state.jadwals_future,
      jadwals_past: (state) => state.jadwals_past,
    }),
    page: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE jadwal
        return this.$store.state.jadwal.page;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("jadwal/SET_PAGE", val);
      },
    },

    page_future: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE jadwal
        return this.$store.state.jadwal.page_future;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("jadwal/SET_PAGE_FUTURE", val);
      },
    },

    page_past: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE jadwal
        return this.$store.state.jadwal.page_past;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("jadwal/SET_PAGE_PAST", val);
      },
    },
  },
  watch: {
    page() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getJadwalsDiv();
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getJadwalsDiv(this.search);
    },

    page_past() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getJadwalsDivPast();
    },
    search_past() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getJadwalsDivPast(this.search_past);
    },

    page_future() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getJadwalsDivFuture();
    },
    search_future() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getJadwalsDivFuture(this.search_future);
    },
  },
  methods: {
    //MENGAMBIL FUNGSI DARI VUEX MODULE Jadwal
    ...mapActions("jadwal", [
      "getJadwalsDiv",
      "getJadwalsDivFuture",
      "getJadwalsDivPast",
    ]),
  },
};
</script>

<style>
</style>