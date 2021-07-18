<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-teal">
          <h1 class="card-title">Kelola Data Jadwal</h1>
        </div>
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-sm-6">
              <router-link
                :to="{ name: 'jadwal.add' }"
                class="btn btn-success"
              >
                <i class="fa fa-plus-circle"></i> Tambah</router-link
              >
            </div>
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

              <template #cell(status)="data">
                <span
                  class="badge badge-warning"
                  v-if="data.item.tanggal < Date()"
                  >asdad</span
                >
                <span class="badge badge-info" v-else>Mendatang</span>
              </template>

              <template #cell(actions)="row">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button
                    type="button"
                    class="btn btn-danger"
                    @click="deleteJadwal(row.item.id)"
                  >
                    Delete
                  </button>
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
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h1 class="card-title">Kelola Data Jadwal Lampau</h1>
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

              <template #cell(actions)="row">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <router-link
                    :to="{ name: 'scan.result', params: { id: row.item.id } }"
                    class="btn btn-info"
                  >
                    Hasil Pemindaian
                  </router-link>
                  <button
                    type="button"
                    class="btn btn-danger"
                    @click="deleteJadwal(row.item.id)"
                  >
                    Delete
                  </button>
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
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  name: "DataJadwal",
  created() {
    //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
    this.getJadwals();
    this.getJadwalsPast();
  },
  data() {
    return {
      //FIELD UNTUK B-TABLE, PASTIKAN KEY NYA SESUAI DENGAN FIELD DATABASE
      //AGAR OTOMATIS DI-RENDER
      fields: [
        {
          key: "judul",
          label: "Judul Pemindaian",
        },
        {
          key: "divisi",
          label: "Divisi",
        },
        {
          key: "tanggal",
          label: "Tanggal",
        },
        // { key: "status", label: "Status" },
        {
          key: "created_at",
          label: "Dibuat pada",
        },
        {
          key: "actions",
          label: "Aksi",
        },
      ],
      search: "",
      search_past: "",
    };
  },
  computed: {
    //MENGAMBIL DATA AsetS DARI STATE AsetS
    ...mapState("jadwal", {
      jadwals: (state) => state.jadwals,
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
      this.getJadwals();
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getJadwals(this.search);
    },
    page_past() {
      this.getJadwalsPast();
    },
    search_past() {
      this.getJadwalsPast(this.search_past);
    },
  },
  methods: {
    //MENGAMBIL FUNGSI DARI VUEX MODULE Jadwal
    ...mapActions("jadwal", ["getJadwals", "getJadwalsPast", "removeJadwal"]),
    //KETIKA TOMBOL HAPUS DICLICK, MAKA AKAN MENJALANKAN METHOD INI
    deleteJadwal(id) {
      //AKAN MENAMPILKAN JENDELA KONFIRMASI
      this.$fire({
        title: "Kamu Yakin?",
        text: "Tindakan ini akan menghapus secara permanent!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya, Lanjutkan!",
      }).then((result) => {
        //JIKA DISETUJUI
        if (result.value) {
          //MAKA FUNGSI removeJadwal AKAN DIJALANKAN
          this.removeJadwal(id);

          this.$toasted.show("Data Jadwal telah berhasil dihapus", {
            type: "info",
            duration: 3000,
          });
        }
      });
    },
  },
};
</script>

<style>
</style>
