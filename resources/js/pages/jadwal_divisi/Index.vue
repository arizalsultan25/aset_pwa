<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Jadwal Pemindaian</h1>
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
    name: 'IndexAset',
    components: {
        'breadcrumb' : Breadcrumb
    }

}
</script>

<style>

</style>