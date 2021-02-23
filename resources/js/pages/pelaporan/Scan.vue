<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporkan Kerusakan Aset</h1>
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
                <h1 class="card-title">Scan QR Kode Aset</h1>
              </div>
              <div class="card-body">
                <qrcode-stream @decode="onDecode"></qrcode-stream>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
// import
import Breadcrumb from "../../components/Breadcrumb.vue";

export default {
  name: "ScanPelaporan",
  components: {
    breadcrumb: Breadcrumb,
  },

  methods: {
    onDecode(decodedString) {
      this.$toasted.show(decodedString, {
            type: "success",
            duration: 3000,
          });
    },
  },
};
</script>

<style>
</style>