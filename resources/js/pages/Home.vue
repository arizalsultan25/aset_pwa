<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Administator</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/">Home</router-link> /
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
        </div>

        <h5 class="mt-4 mb-2">Data Aset per Divisi</h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-olive"
                ><i class="fas fa-network-wired text-dark"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">IT Support</span>
                <span class="info-box-number">{{ data.it }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-teal"
                ><i class="fas fa-wallet text-dark"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Finance</span>
                <span class="info-box-number">{{ data.fin }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-orange"
                ><i class="fas fa-truck-loading"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Production</span>
                <span class="info-box-number">{{ data.prod }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-maroon"
                ><i class="fas fa-users text-dark"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Human Resource</span>
                <span class="info-box-number">{{ data.hr }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
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
          <div class="col-md-12">
             <div class="card">
              <div class="card-header bg-orange">
                <h3 class="card-title">Statistik Aset per Divisi</h3>

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
                  v-if="loaded"
                  :chartdata="data_div"
                   height="200"
                />
              </div>
              <!-- /.card-body -->
            </div>
          </div>

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
import BarChart from "../components/chart/bar.vue";
import DonatChart from '../components/chart/donat.vue'

export default {
  created() {
    this.getData();
  },
  components: {
    PieChart,
    BarChart,
    DonatChart,
  },

  methods: {
    async getData() {
      let uri = "/api/asets/home";

      await axios.get(uri).then((response) => {
        let res = response.data;

        this.data.total = res.jumlah.total;
        this.data.ok = res.jumlah.ok;
        this.data.rusak = res.jumlah.rusak;

        this.data.elektronik = res.category.elektronik;
        this.data.kendaraan = res.category.kendaraan;
        this.data.furniture = res.category.furniture;
        this.data.dokumen = res.category.dokumen;

        this.data.it = res.divisi.it;
        this.data.fin = res.divisi.fin;
        this.data.prod = res.divisi.prod;
        this.data.hr = res.divisi.hr;
      });
    },
  },

  async mounted() {
    this.loaded = false;
    this.load_bar = false;
    try {
      let uri = "/api/asets/home";

      await axios.get(uri).then((response) => {
        let res = response.data;

        this.datacollection = {
          labels: ["Aset OK", "Aset Rusak"],
          datasets: [
            {
              label: "Statistik Kondisi Aset",
              backgroundColor: ["#3AEB75", "#EB3A64"],

              data: [res.jumlah.ok, res.jumlah.rusak],
            },
          ],
        };

        this.data_div = {
          labels: ["IT Support", "Finance", "Production", "Human Resource"],
          datasets: [
            {
              backgroundColor: ["#4D84F3", "#CDF134", "#F34D84", "#E834F1"],
              data: [res.divisi.it, res.divisi.fin, res.divisi.prod, res.divisi.hr],
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

              data: [
                res.category.elektronik,
                res.category.furniture,
                res.category.kendaraan,
                res.category.dokumen,
              ],
            },
          ],
        };
      });
      this.loaded = true;
      this.load_bar = true;
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

        it: "",
        fin: "",
        prod: "",
        hr: "",
      },

      options : null,

      jadwal: [],

      loaded: false,
      datacollection: null,
      data_div : null,

      load_bar: false,
      data_bar: null,
    };
  },
};
</script>

<style>
</style>