<template>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="col-md-12">
                    <h4 class="page-title">Data Pengguna</h4>
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
    name: 'IndexUser',
    components: {
        'breadcrumb' : Breadcrumb
    }

}
</script>

<style>

</style>