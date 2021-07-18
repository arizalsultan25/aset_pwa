<template>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="col-md-12">
                    <h4 class="page-title">Data Pelaporan</h4>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
// import
import Breadcrumb from '../../components/Breadcrumb.vue'

export default {
    name: 'IndexPelaporan',
    components: {
        'breadcrumb' : Breadcrumb
    }

}
</script>

<style>

</style>