<template>
    <div>
      <h2>Your Cart</h2>
      <div v-if="products.length">
        <div v-for="(product, index) in products" :key="index" class="cart-item">
          <h3>{{ product.name }}</h3>
          <p>Price: ${{ product.price }}</p>
          <p>Quantity: {{ product.quantity }}</p>
          <p>Total: ${{ product.total }}</p>
        </div>
        <h3>Total: ${{ total }}</h3>
      </div>
      <div v-else>
        <p>Your cart is empty.</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      products: {
        type: Array,
        default: () => [],
      },
      total: {
        type: Number,
        default: 0,
      },
    },
  };
  </script>
  
  <style scoped>
  .cart-item {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 8px;
  }
  </style>
  