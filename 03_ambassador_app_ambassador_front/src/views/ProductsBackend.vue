<template>
  <Products :products="products" :filters="filters" @set-filters="load" :lastPage="lastPage"/>
</template>

<script>
import Products from "./Products.vue";
import {onMounted, reactive, ref} from "vue";
import axios from "axios";

export default {
  name: "ProductsBackend",
  components: {Products},
  setup() {
    const products = ref([]);
    const filters = reactive({
      s: '',
      sort: '',
      page: 1
    });
    const lastPage = ref(0);

    const load = async (f) => {
      filters.s = f.s;
      filters.sort = f.sort;
      filters.page = f.page;

      const arr = [];

      if (filters.s) {
        arr.push(`s=${filters.s}`);
      }

      if (filters.sort) {
        arr.push(`sort=${filters.sort}`);
      }

      if (filters.page) {
        arr.push(`page=${filters.page}`);
      }

      if(localStorage.getItem('token')) {
        const {data} = await axios.get(`products/backend?${arr.join('&')}`);
        products.value = filters.page === 1 ? data.data : [...products.value, ...data.data];
        lastPage.value = data.meta.last_page;
      }
    };

    onMounted(() => load(filters));

    return {
      products,
      filters,
      lastPage,
      load
    }
  }
}
</script>
