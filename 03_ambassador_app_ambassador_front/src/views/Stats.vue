<template>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
      <tr>
        <th>Link</th>
        <th>Users</th>
        <th>Revenue</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="link in links" :key="link.id">
        <td>{{ checkoutUrl(link.code) }}</td>
        <td>{{ link.count }}</td>
        <td>{{ link.revenue }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
  name: "Stats",
  setup() {
    const links = ref([]);

    onMounted(async () => {
      const {data} = await axios.get('stats');

      links.value = data;
    });

    const checkoutUrl = (code) => `${process.env.VUE_APP_CHECKOUT_URL}/${code}`;

    return {
      links,
      checkoutUrl
    }
  }
}
</script>
