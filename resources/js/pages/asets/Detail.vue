<template>
    <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h1 class="card-title">Detail Data Aset <strong class="text-success">{{ data.nama_aset}}</strong></h1>
      </div>
      <div class="card-body">
          <div class="form-group" v-if="data.jenis !== 'Elektronik'">
            <label>ID Aset</label>
            <input
              type="text"
              class="form-control"
              v-model="data.id"
              disabled
            />
          </div>
          <div class="form-group" v-else>
            <label>Serial Number</label>
            <input
              type="text"
              class="form-control"
              v-model="data.serial_number"
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
              <option value="Dll">dan lain lain</option>
            </select>
          </div>

          <div class="form-group">
            <label for="merk">Merk</label>
            <input
              type="text"
              class="form-control"
              placeholder="Merk"
              v-model="data.merk" disabled
            />
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea
              class="form-control"
              rows="3"
              placeholder="Deskripsi aset"
              v-model="data.deskripsi" disabled
            ></textarea>
          </div>

          <div class="form-group">
            <label for="divisi">Divisi</label>
            <select
              class="form-control"
              v-model="data.divisi"
              placeholder="Divisi" disabled
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
            /> <br>
            <qrcode :value="data.qr" :options="{ width: 200 }" class="mx-auto"></qrcode>
          </div>

          <div class="form-group">
              <label for="gambar">Gambar</label> <br>
               <img
          :src="url_gambar"
          alt="Gambar aset"
          class="img-fluid"
        />
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'


export default {
    created() {
        console.log(this.$route.params.id)
        this.getData()
    },

    methods: {
        async getData(){
            let get = await axios.get('/api/asets/'+this.$route.params.id+'/edit').then((response) => {
                let resp = response.data.data
                // console.log(resp)
                this.data = resp
                console.log(this.data)
            })

            this.url_gambar = '/gambar/asets/' + this.data.gambar
        }
    },

    data(){
        return {
            data : {
                id: '',
                nama_aset: '',
                jenis: '',
                merk: '',
                divisi: '',
                deskripsi: '',
                status: '',
                qr: 'qr',
                gambar: '',
                created_at: '',
                updated_at: '',

            },

            url_gambar : '',
        }
    },
}
</script>

<style>

</style>