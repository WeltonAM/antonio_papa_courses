<template>
  <v-app>
    <Nav />

    <div class="container-fluid">
      <div class="row">
        <Menu/>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="table-responsive">
            <router-view/>
          </div>
        </main>
      </div>
    </div>
  </v-app>
</template>

<script>
import Nav from "@/components/Nav.vue";
import Menu from "@/components/Menu.vue";
import axios from "axios";
import { defineComponent } from "vue";

export default defineComponent({
  name: "Layout",
  components: {Menu, Nav},
  async mounted() {
    const token = localStorage.getItem('token');

    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      
      try {
        const { data } = await axios.get('user');
        await this.$store.dispatch('setUser', data);
      } catch (e) {
        console.error('Erro ao obter dados do usuário:', e);
        await this.$router.push('/login');
      }
    } else {
      await this.$router.push('/login');
    }
  }
})
</script>
