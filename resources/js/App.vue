<template>
  <div>
    <!-- <div class="wrapper"> -->
    <app-header v-if="isAuth" />

    <router-view></router-view>

    <app-footer v-if="isAuth" />
  </div>
</template>
<script>
import { mapState, mapGetters, } from "vuex";
import Header from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";

export default {
  computed: {
    ...mapState(["token"]),
    ...mapGetters(["isAuth"]),
  },
  components: {
    "app-header": Header,
    "app-footer": Footer,
  },
};
</script>