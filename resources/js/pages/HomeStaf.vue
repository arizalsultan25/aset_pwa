<template>
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-success-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Dashboard Staf {{$store.state.data.divisi}}</h2>
                            <h5 class="text-white op-7 mb-2">Sistem Manajemen dan Pendataan Aset</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <template v-if="jadwal != ''">
                        <div class="col-md-12">
                            <div class="alert alert-info" v-for="(d, index) in jadwal">
                                <h3>{{ d.judul }}</h3>
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
                            <div class="alert alert-success">
                                <h3>Tidak ada jadwal</h3>
                                <p>
                                    Saat ini tidak tersedia jadwal pemindaian untuk divisi anda.
                                </p>
                            </div>
                        </div>
                    </template>

                </div>
                <div class="col-md-12">
                    <h4 class="page-title">Informasi Jumlah Aset</h4>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-secondary mr-3">
                                    <i class="fas fa-boxes"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1"><b>Total Aset</b></h5>
                                    <small class="text-muted">{{ data.total }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-success mr-3">
                                    <i class="fa fa-shopping-cart"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1"><b>Aset OK</b></h5>
                                    <small class="text-muted">{{ data.ok }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-danger mr-3">
                                    <i class="fa fa-users"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1"><b>Aset Rusak</b></h5>
                                    <small class="text-muted">{{ data.rusak }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <h4 class="page-title">Kategori Aset</h4>
                </div>
                <div class="row row-card-no-pd">                
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-imac text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Elektronik</p>
                                            <h4 class="card-title">{{ data.elektronik }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-desk text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Furniture</p>
                                            <h4 class="card-title">{{ data.furniture }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-delivery-truck text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Kendaraan</p>
                                            <h4 class="card-title">{{ data.kendaraan }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-file-1 text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Dokumen</p>
                                            <h4 class="card-title">{{ data.dokumen }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card full-height">
                            <div class="card-header">
                                <div class="card-title">Statistik Kondisi Aset</div>
                                <div class="card-tools">
                               
                                </div>
                            </div>
                            <div class="card-body">
                              <pie-chart
                                v-if="loaded"
                                :chartdata="datacollection"
                              />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card full-height">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Statistik Kategori Aset</div>
                                    <div class="card-tools">
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <bar-chart
                                  v-if="load_bar"
                                  :chartdata="data_bar"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.themekita.com">
                                ThemeKita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                        href="https://www.themekita.com">ThemeKita</a>
                </div>
            </div>
        </footer>
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
                        datasets: [{
                            label: "Statistik Kondisi Aset",
                            backgroundColor: [
                                "#3AEB75",
                                "#EB3A64",
                            ],

                            data: [res.jumlah.ok, res.jumlah.rusak],
                        }, ],
                    };

                    this.data_bar = {
                        labels: ["Statistik Kategori Aset"],
                        datasets: [
                        {
                            label: 'Elektronik',
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            data: [res.category.elektronik], 
                        }, 
                        {
                          label: 'Furniture', 
                          backgroundColor: "rgba(54, 162, 235, 0.2)",
                          data: [res.category.furniture],
                        },
                        {
                          label: 'Kendaraan', 
                          backgroundColor: "rgba(255, 206, 86, 0.2)",
                          data: [res.category.kendaraan],
                        },
                        {
                          label: 'Dokumen', 
                          backgroundColor: "rgba(75, 192, 192, 0.2)",
                          data: [res.category.dokumen],
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

                load_bar: false,
                data_bar: null
            };
        },
    };

</script>

<style>
</style>
