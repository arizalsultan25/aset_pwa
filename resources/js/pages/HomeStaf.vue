<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Staf</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dahshboard">Home</router-link>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <h5 class="mt-4 mb-2">Informasi Jumlah Aset</h5>
        <div class="row">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"
                ><i class="far fa-envelope"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Aset</span>
                <span class="info-box-number">{{data.total}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"
                ><i class="far fa-flag"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Aset OK</span>
                <span class="info-box-number">{{data.ok}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"
                ><i class="far fa-star"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Aset Rusak</span>
                <span class="info-box-number">{{data.rusak}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        <h5 class="mt-4 mb-2">Kategori Aset</h5>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{data.elektronik}}</h3>

                <p>Elektronik</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{data.furniture}}</h3>

                <p>Furniture</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{data.kendaraan}}</h3>

                <p>Kendaraan</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{data.dokumen}}</h3>

                <p>Dokumen</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row" style="margin-top: 1%">
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exclamation-triangle"></i>
                  Alerts
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Danger alert preview. This alert is dismissable. A wonderful
                  serenity has taken possession of my entire soul, like these
                  sweet mornings of spring which I enjoy with my whole heart.
                </div>
                <div class="alert alert-info alert-dismissible">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Info alert preview. This alert is dismissable.
                </div>
                <div class="alert alert-warning alert-dismissible">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <h5>
                    <i class="icon fas fa-exclamation-triangle"></i> Alert!
                  </h5>
                  Warning alert preview. This alert is dismissable.
                </div>
                <div class="alert alert-success alert-dismissible">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Success alert preview. This alert is dismissable.
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Callouts
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-danger">
                  <h5>I am a danger callout!</h5>

                  <p>
                    There is a problem that we need to fix. A wonderful serenity
                    has taken possession of my entire soul, like these sweet
                    mornings of spring which I enjoy with my whole heart.
                  </p>
                </div>
                <div class="callout callout-info">
                  <h5>I am an info callout!</h5>

                  <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                  <h5>I am a warning callout!</h5>

                  <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                  <h5>I am a success callout!</h5>
                  <p>This is a green callout.</p>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    created() {
      this.getData()
    },

    methods: {
      async getData(){
        let divisi = localStorage.getItem('divisi')
        let uri = '/api/asets/'+divisi+'/home'

        await axios.get(uri).then((response) => {
          let res = response.data

          this.data.total = res.jumlah.total
          this.data.ok = res.jumlah.ok
          this.data.rusak = res.jumlah.rusak

          this.data.elektronik = res.category.elektronik
          this.data.kendaraan = res.category.kendaraan
          this.data.furniture = res.category.furniture
          this.data.dokumen = res.category.dokumen

        })
      }
    },

    data(){
      return {
        data : {
          total : '',
          ok : '',
          rusak : '',

          elektronik : '',
          dokumen : '',
          furnitur : '',
          kendaraan : '',
        },
      }
    }
};
</script>

<style>
</style>