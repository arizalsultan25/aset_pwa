<template>
  <div class="main-panel">
    <div class="content">
      <div class="page-inner">
        <div class="col-md-12">
          <h4 class="page-title">Scan QR Aset</h4>
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

export default {
  name: "IndexUser",
  components: {
    breadcrumb: Breadcrumb,
  },

  methods: {
    onDecode(decodedString) {
      this.$toasted.show(decodedString, {
        type: "success",
        duration: 3000,
      });

      this.$router.push({ name: "scan.detail", params: { id: decodedString } });
    },
  },
};
</script>

<style>
</style>