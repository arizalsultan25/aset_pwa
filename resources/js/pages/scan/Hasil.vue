<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hasil Scan QR Aset</h1>
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
                <h1 class="card-title">
                    Hasil Pemindaian Aset
                </h1>
              </div>
              <div class="card-body">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import Breadcrumb from "../../components/Breadcrumb.vue";

export default {
  components: {
    breadcrumb: Breadcrumb,
  },
  created() {
    console.log(this.$route.params.id);
  },

  methods: {

  },

  data() {
    return {
      

      
    };
  },
};
</script>

<style>
</style>