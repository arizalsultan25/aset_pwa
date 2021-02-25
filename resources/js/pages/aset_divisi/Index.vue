<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Aset Divisi {{$store.state.data.divisi}}</h1>
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
                    <router-view></router-view>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
// import
import Breadcrumb from '../../components/Breadcrumb.vue'

export default {
    name: 'IndexAsetDiv',
    components: {
        'breadcrumb' : Breadcrumb
    },
    created(){
        console.log(this.$store.state.data.divisi)
    }

}
</script>

<style>

</style>