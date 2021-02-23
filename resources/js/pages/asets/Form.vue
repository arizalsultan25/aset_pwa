<template>
  <div class="">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_aset">Nama Aset</label>
        <input
          type="text"
          class="form-control"
          v-model="aset.nama_aset"
          placeholder="Nama Aset"
          :class="{ 'is-invalid': errors.nama_aset }"
        />
        <div v-if="errors.nama_aset" class="mt-2 text-danger">
          {{ errors.nama_aset[0] }}
        </div>
      </div>

      <div class="form-group">
        <label for="jenis">Jenis Aset</label>
        <select
          class="form-control"
          v-model="aset.jenis"
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
          v-model="aset.merk"
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
          v-model="aset.deskripsi"
        ></textarea>
      </div>

      <div class="form-group">
        <label for="divisi">Divisi</label>
        <select class="form-control" v-model="aset.divisi" placeholder="Divisi">
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
          <label class="custom-file-label" for="gambar">{{ nama_file }}</label>
        </div>
        <div v-if="errors.gambar" class="mt-2 text-danger">
          {{ errors.gambar[0] }}
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "FormAsets",


  computed: {
    ...mapState(["errors"]), //MENGAMBIL STATE ERRORS
    ...mapState("aset", {
      aset: (state) => state.aset, //MENGAMBIL STATE aset
    }),
  },


  methods: {
    ...mapMutations("aset", ["CLEAR_FORM"]), //PANGGIL MUTATIONS CLEAR_FORM
  
    change : function(e){
      e.preventDefault()
      var fileReader = new FileReader()

      this.nama_file = e.target.files[0].name
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
      state.aset.gambar = e.target.result
      console.log(this.state.aset)
      }
    },
  //KETIKA PAGE INI DITINGGALKAN MAKA
  destroyed() {
    //FORM DI BERSIHKAN
    this.CLEAR_FORM();
  },
  },

  data() {
    return {
      // form
      asetaaa: {
        nama_aset: "",
        jenis: "Elektronik",
        merk: "",
        deskripsi: "",
        divisi: "IT Support",
        gambar: null,
      },

      nama_file : 'Pilih gambar aset',
    };
  },
};
</script>

<style>
</style>