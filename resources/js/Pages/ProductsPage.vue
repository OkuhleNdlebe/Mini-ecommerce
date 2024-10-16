<template>
    <div>
      <!-- <h1>Our Product Catalog</h1> -->
      <product-list></product-list>
    </div>
  </template>
  
  <script>
  import ProductList from '@/Components/ProductList.vue';
  
  export default {
    components: {
      ProductList,
    },
  };
  </script>
  