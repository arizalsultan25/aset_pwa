<template>
    <div class="pcoded-content">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                            <p class="m-b-0">Welcome to Material Able</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb" v-if="$store.state.data.role == 0">
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'home' }"> <i class="fa fa-home"></i> </router-link>
                            </li>
                            <li class="breadcrumb-item">{{ $route.meta.title }}
                            </li>
                        </ul>
                        <ul class="breadcrumb" v-else>
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'home.staf' }"> <i class="fa fa-home"></i> </router-link>
                            </li>
                            <li class="breadcrumb-item">{{ $route.meta.title }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {};

</script>

<style>
</style>
