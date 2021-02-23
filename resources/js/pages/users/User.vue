<template>
 <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-teal">
        <h1 class="card-title">Kelola Data Pengguna</h1>
      </div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link
              :to="{ name: 'users.add' }"
              class="btn bg-teal btn-sm btn-flat"
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
            :items="users.data"
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

            <template #cell(actions)="row">
                <button type="button" class="btn btn-danger" @click="deleteUser(row.item.id)">Delete</button>
            </template>
          </b-table>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p v-if="users.data">
              <i class="fa fa-bars"></i> {{ users.data.length }} item dari
              {{ users.meta.total }} total data
            </p>
          </div>
          <div class="col-md-6">
            <div class="pull-right">
              <b-pagination
                v-model="page"
                :total-rows="users.meta.total"
                :per-page="users.meta.per_page"
                aria-controls="users"
                v-if="users.data && users.data.length > 0"
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
    name: "DataUser",
  created() {
    //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
    this.getUsers();
  },
  data() {
    return {
      //FIELD UNTUK B-TABLE, PASTIKAN KEY NYA SESUAI DENGAN FIELD DATABASE
      //AGAR OTOMATIS DI-RENDER
      fields: [
        { key: "name", label: "Nama" },
        { key: "email", label: "Email" },
        { key: "divisi", label: "Divisi" },
        { key: "created_at", label: "Didaftarkan pada" },
        { key: "actions", label: "Aksi" },
      ],
      search: "",
    };
  },
  computed: {
    //MENGAMBIL DATA userS DARI STATE userS
    ...mapState("user", {
      users: (state) => state.users,
    }),
    page: {
      get() {
        //MENGAMBIL VALUE PAGE DARI VUEX MODULE user
        return this.$store.state.user.page;
      },
      set(val) {
        //APABILA TERJADI PERUBAHAN VALUE DARI PAGE, MAKA STATE PAGE
        //DI VUEX JUGA AKAN DIUBAH
        this.$store.commit("user/SET_PAGE", val);
      },
    },
  },
  watch: {
    page() {
      //APABILA VALUE DARI PAGE BERUBAH, MAKA AKAN MEMINTA DATA DARI SERVER
      this.getUsers();
    },
    search() {
      //APABILA VALUE DARI SEARCH BERUBAH MAKA AKAN MEMINTA DATA
      //SESUAI DENGAN DATA YANG SEDANG DICARI
      this.getUsers(this.search);
    },
  },

  methods: {
    //MENGAMBIL FUNGSI DARI VUEX MODULE User
    ...mapActions("user", ["getUsers", "removeUser"]),
    //KETIKA TOMBOL HAPUS DICLICK, MAKA AKAN MENJALANKAN METHOD INI
    deleteUser(id) {
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
          //MAKA FUNGSI removeUser AKAN DIJALANKAN
          this.removeUser(id);

          this.$toasted.show('Data User telah berhasil dihapus', {
            type: "info",
            duration: 3000,
          });
        }
      });
    },
  },
}
</script>

<style>

</style>