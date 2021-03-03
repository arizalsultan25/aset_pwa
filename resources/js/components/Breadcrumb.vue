<template>
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item">
      <router-link v-if="$store.state.data.role == 0" :to="{ name: 'home' }">Home</router-link>
      <router-link v-else :to="{ name: 'home.staf' }">Home</router-link>
    </li>
    <li class="breadcrumb-item active">{{ $route.meta.title }}</li>
  </ol>
</template>

<script>
export default {};
</script>

<style>
</style>