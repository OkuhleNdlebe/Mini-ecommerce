<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-center mb-6">Our Product Catalog</h1>

    <div v-if="loading" class="text-center text-lg text-gray-600">
      Loading...
    </div>

    <div v-if="!loading && products.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="product in products"
        :key="product.id"
        class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center"
      >
        <img :src="product.image" alt="Product Image" class="w-48 h-48 object-cover mb-4" />
        <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
        <p class="text-gray-600 text-sm text-center mb-2">{{ product.description }}</p>
        <p class="text-lg font-bold text-gray-800 mb-4">${{ product.price }}</p>

        <div class="flex items-center space-x-3">
          <label for="quantity" class="font-medium">Quantity:</label>
          <input
            type="number"
            v-model="product.quantity"
            min="1"
            class="w-16 p-2 border border-gray-300 rounded-md text-center"
          />
        </div>

        <button
          @click="addToCart(product)"
          class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300"
        >
          Add to Cart
        </button>
      </div>
    </div>

    <div v-if="!loading && !products.length" class="text-center text-lg text-gray-600">
      No products available.
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      loading: true
    };
  },
  methods: {
    fetchProducts() {
      axios
        .get('/api/products')
        .then((response) => {
          this.products = response.data.map((product) => ({
            ...product,
            quantity: 1 // Add a default quantity field for each product
          }));
          this.loading = false;
        })
        .catch((error) => {
          console.error('Error fetching products:', error);
          this.loading = false;
        });
    },
    addToCart(product) {
      const payload = {
        product_id: product.id,
        quantity: product.quantity
      };

      axios
        .post('/api/cart/add', payload)
        .then((response) => {
          // Handle success - you could show a message or notification
          console.log(response.data.message);
        })
        .catch((error) => {
          // Handle error
          console.error('Error adding to cart:', error);
        });
    }
  },
  mounted() {
    this.fetchProducts(); // Fetch products when the component is mounted
  }
};
</script>
