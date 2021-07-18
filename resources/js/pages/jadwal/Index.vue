<template>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <router-view></router-view>
                </div>
            </div>
        </div>
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