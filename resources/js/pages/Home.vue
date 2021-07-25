<template>
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-success-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Dashboard Administrator</h2>
                            <h5 class="text-white op-7 mb-2">Sistem Manajemen dan Pendataan Aset</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-inner mt--5">
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
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
                    <div class="col-sm-12 col-lg-4">
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
                    <div class="col-sm-12 col-lg-4">
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

                <h4 class="page-title">Data Aset per Divisi</h4>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <i class="flaticon-laptop text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">IT Support</p>
                                            <h4 class="card-title">{{ data.it }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <i class="flaticon-graph text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Finance</p>
                                            <h4 class="card-title">{{ data.fin }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <i class="flaticon-box-3 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Production</p>
                                            <h4 class="card-title">{{ data.prod }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <i class="flaticon-users text-secondary"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Human Resource</p>
                                            <h4 class="card-title">{{ data.hr }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="page-title">Kategori Aset</h4>
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

                <div class="row" style="margin-top: 1%">
                    <div class="col-md-7 col-12">
                        <div class="card">
                            <div class="card-header bg-orange">
                                <h3 class="card-title">Statistik Aset per Divisi</h3>
                            </div>
                            <div class="card-body">
                                <bar-chart v-if="loaded" :chartdata="data_div" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-5 col-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- PIE CHART -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Statistik Kondisi Aset</h3>

                                    </div>
                                    <div class="card-body">
                                        <pie-chart v-if="loaded" :chartdata="datacollection" />
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-12">
                                <!-- PIE CHART -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Statistik Kategory Aset</h3>
                                    </div>
                                    <div class="card-body">
                                        <bar-chart v-if="load_bar" :chartdata="data_bar" />
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
                        datasets: [{
                            label: "Statistik Kondisi Aset",
                            backgroundColor: ["#3AEB75", "#EB3A64"],

                            data: [res.jumlah.ok, res.jumlah.rusak],
                        }, ],
                    };

                    this.data_div = {
                        labels: ["Statistik Aset per Divisi"],
                        datasets: [{
                                backgroundColor: "#4D84F3",
                                data: [res.divisi.it],
                                label: 'IT Support'
                            },
                            {
                                backgroundColor: "#CDF134",
                                data: [res.divisi.fin],
                                label: 'Finance'
                            },
                            {
                                backgroundColor: "#F34D84",
                                data: [res.divisi.prod],
                                label: 'Production'
                            },
                            {
                                backgroundColor: "#E834F1",
                                data: [res.divisi.hr],
                                label: 'Human Resource'
                            },
                        ],
                    };

                    this.data_bar = {
                        labels: ["Statistik Kategori Aset"],
                        datasets: [{
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

                options: null,

                jadwal: [],

                loaded: false,
                datacollection: null,
                data_div: null,

                load_bar: false,
                data_bar: null,
            };
        },
    };

</script>

<style>
</style>
