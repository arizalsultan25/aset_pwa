<template>
  <div class="main-panel">
    <div class="content">
      <div class="page-inner">
        <div class="col-md-12">
          <h4 class="page-title">Laporkan Kerusakan Aset</h4>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-teal">
                <h1 class="card-title">Scan QR Kode Aset</h1>
              </div>
              <div class="card-body">
                <qrcode-stream @decode="onDecode"></qrcode-stream>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import
import Breadcrumb from "../../components/Breadcrumb.vue";
import axios from "axios";

export default {
  name: "ScanPelaporan",
  components: {
    breadcrumb: Breadcrumb,
  },

  methods: {
    async onDecode(decodedString) {
      try {
        let uri = "/api/asets/" + decodedString + "/edit";
        await axios.get(uri).then((response) => {
          let divisi = response.data.data.divisi;
          let div = localStorage.getItem("divisi");
          if (divisi != div) {
            this.$toasted.show("Aset tersebut bukan milik divisi anda", {
              type: "error",
              duration: 3000,
            });
          } else {
            this.$toasted.show(decodedString, {
              type: "success",
              duration: 3000,
            });

            this.$router.push({
              name: "pelaporan.add",
              params: { id: decodedString },
            });
          }
        });
      } catch (e) {
        console.log(e.response.data.errors);

        this.$toasted.show("Something went wrong...", {
          type: "error",
          duration: 3000,
        });
      }
    },
  },
};
</script>

<style>
</style>