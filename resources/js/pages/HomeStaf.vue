<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Staf {{$store.state.data.divisi}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Home</router-link> /
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <h5 class="mt-4 mb-2">Jadwal Pemindaian Aset</h5>
        <div class="row">
          <template v-if="jadwal != ''">
            <div class="col-md-12">
              <div class="callout callout-info" v-for="(d, index) in jadwal">
                <h5>{{ d.judul }}</h5>

                <p>
                  Terdapat jadwal pemindaian aset untuk tanggal :
                  <span class="badge badge-danger">
                    {{ d.tanggal | moment("ddd, D MMM YYYY") }}
                  </span>
                </p>
              </div>
            </div>
          </template>
          <template v-else>
            <div class="col-md-12">
              <div class="callout callout-success">
                <h5>Tidak ada jadwal</h5>

                <p>
                  Saat ini tidak tersedia jadwal pemindaian untuk divisi anda.
                </p>
              </div>
            </div>
          </template>
        </div>

        <h5 class="mt-4 mb-2">Informasi Jumlah Aset</h5>
        <div class="row">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"
                ><i class="fas fa-boxes"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Aset</span>
                <span class="info-box-number">{{ data.total }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"
                ><i class="fas fa-check"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Aset OK</span>
                <span class="info-box-number">{{ data.ok }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"
                ><i class="fas fa-times"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Aset Rusak</span>
                <span class="info-box-number">{{ data.rusak }}</span>
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
                <h3>{{ data.elektronik }}</h3>

                <p>Elektronik</p>
              </div>
              <div class="icon">
                <i class="fas fa-tv"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ data.furniture }}</h3>

                <p>Furniture</p>
              </div>
              <div class="icon">
                <i class="fas fa-couch"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ data.kendaraan }}</h3>

                <p>Kendaraan</p>
              </div>
              <div class="icon">
                <i class="fas fa-shuttle-van"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ data.dokumen }}</h3>

                <p>Dokumen</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row" style="margin-top: 1%">
          <div class="col-md-5">
            <!-- PIE CHART -->
            <div class="card">
              <div class="card-header bg-teal">
                <h3 class="card-title">Statistik Kondisi Aset</h3>

                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <pie-chart
                  v-if="loaded"
                  :chartdata="datacollection"
                  :options="options"
                />
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-7">
            <!-- PIE CHART -->
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Statistik Kategory Aset</h3>

                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <bar-chart
                  v-if="load_bar"
                  :chartdata="data_bar"
                  :options="options"
                />
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import PieChart from "../components/chart/pie.vue";
import BarChart from '../components/chart/bar.vue'

export default {
  created() {
    this.getData(), this.getJadwal();
  },
  components: {
    PieChart,
    BarChart
  },

  methods: {
    async getData() {
      let divisi = localStorage.getItem("divisi");
      let uri = "/api/asets/" + divisi + "/home";

      await axios.get(uri).then((response) => {
        let res = response.data;

        this.data.total = res.jumlah.total;
        this.data.ok = res.jumlah.ok;
        this.data.rusak = res.jumlah.rusak;

        this.data.elektronik = res.category.elektronik;
        this.data.kendaraan = res.category.kendaraan;
        this.data.furniture = res.category.furniture;
        this.data.dokumen = res.category.dokumen;
      });
    },

    async getJadwal() {
      let divisi = localStorage.getItem("divisi");
      let uri = "/api/jadwal/" + divisi + "/next";

      await axios.get(uri).then((response) => {
        let res = response.data;
        // console.log(res)
        this.jadwal = res.data;
      });
    },
  },

  async mounted() {
    this.loaded = false;
    this.load_bar = false
    try {
      let divisi = localStorage.getItem("divisi");
      let uri = "/api/asets/" + divisi + "/home";

      await axios.get(uri).then((response) => {
        let res = response.data;

        this.datacollection = {
          labels: ["Aset OK", "Aset Rusak"],
          datasets: [
            {
              label: "Statistik Kondisi Aset",
              backgroundColor: [
                "#3AEB75",
                "#EB3A64",
              ],

              data: [res.jumlah.ok, res.jumlah.rusak],
            },
          ],
        };

        this.data_bar = {
          labels: ["Elektronik", "Furniture", "Kendaraan", "Dokumen"],
          datasets: [
            {
              labels: ["Elektronik", "Furniture", "Kendaraan", "Dokumen"],
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],

              data: [res.category.elektronik, res.category.furniture, res.category.kendaraan, res.category.dokumen],
            },
          ],
        };
      });
      this.loaded = true;
      this.load_bar = true
    } catch (e) {
      console.error(e);
    }
  },

  data() {
    return {
      data: {
        total: 0,
        ok: 0,
        rusak: 0,

        elektronik: "",
        dokumen: "",
        furnitur: "",
        kendaraan: "",
      },

      jadwal: [],

      loaded: false,
      datacollection: null,

      load_bar : false,
      data_bar : null
    };
  },
};
</script>

<style>
</style>