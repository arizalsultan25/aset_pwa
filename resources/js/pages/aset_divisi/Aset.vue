<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Kelola Data Aset {{$store.state.data.divisi}}</h1>
      </div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <router-link
              :to="{ name: 'property.add' }"
              class="btn bg-teal btn-sm btn-flat"
            >
              <i class="fa fa-plus-circle"></i> Tambah</router-link
            > -->
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

              <span class="badge badge-danger" v-else>Human Resource</span>
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
              <div class="btn-group" role="group" aria-label="Basic example">
                <router-link :to="{ name: 'asets.detail', params: {id: row.item.qr} }" type="button" class="btn btn-primary">Detail</router-link>
                <!-- <router-link :to="{ name: 'asets.edit', params: {id: row.item.qr} }" class="btn btn-warning">Edit</router-link>
                <button type="button" class="btn btn-danger" @click="deleteAset(row.item.id)">Delete</button> -->
              </div>
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="asets.data">
              <i class="fa fa-bars"></i> {{ asets.data.length }} item dari
              {{ asets.meta.total }} total data
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
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  name: "DataAsetDiv",
  created() {
    //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
    this.getAsetsDiv();
  },
  data() {
    return {
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
      this.getAsetsDiv();
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getAsetsDiv(this.search);
    },
  },
  methods: {
    //MENGAMBIL FUNGSI DARI VUEX MODULE Aset
    ...mapActions("aset", ["getAsetsDiv", "removeAsetDiv"]),
    //KETIKA TOMBOL HAPUS DICLICK, MAKA AKAN MENJALANKAN METHOD INI
    deleteAset(id) {
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
          //MAKA FUNGSI removeAset AKAN DIJALANKAN
          this.removeAsetDiv(id);

          this.$toasted.show('Data Aset telah berhasil dihapus', {
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