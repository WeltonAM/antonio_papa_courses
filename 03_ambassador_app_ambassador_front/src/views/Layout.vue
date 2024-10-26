<template>
  <Nav/>

  <main>

    <Header v-if="showHeader"/>

    <div class="album py-5 bg-light">
      <div class="container">
        <router-view/>
      </div>
    </div>

  </main>
</template>

<script>
import Nav from "../components/Nav.vue";
import Header from "../components/Header.vue";
import {computed} from "vue";
import {useRoute} from "vue-router";

export default {
  name: "Layout",
  components: {Header, Nav},
  setup() {
    const route = useRoute();
    const showHeader = computed(() => route.path === '/' || route.path === '/backend');

    return {
      showHeader
    }
  }
}
</script>
