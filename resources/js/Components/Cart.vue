<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-center mb-6">Your Shopping Cart</h1>

    <!-- Loading indicator -->
    <div v-if="loading" class="text-center text-lg text-gray-600">
      Loading...
    </div>

    <!-- Display cart items -->
    <div v-if="!loading && cartItems.length" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="item in cartItems"
        :key="item.id"
        class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center"
      >
        <!-- Display item image -->
        <img :src="item.image" alt="Product Image" class="w-48 h-48 object-cover mb-4" />

        <h2 class="text-xl font-semibold mb-2 text-center">{{ item.name }}</h2>
        <p class="text-gray-600 text-sm mb-2">Quantity: {{ item.quantity }}</p>
        <p class="text-lg font-bold text-gray-800 mb-2">Price: ${{ item.price }}</p>
        <p class="text-lg font-bold text-gray-800 mb-4">Total: ${{ item.total }}</p>

        <button
          @click="removeFromCart(item.id)"
          class="mt-auto bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition duration-300"
        >
          Remove from Cart
        </button>
      </div>
    </div>

    <!-- Empty cart message -->
    <div v-if="!loading && !cartItems.length" class="text-center text-lg text-gray-600">
      Your cart is empty.
    </div>

    <!-- Total cost summary -->
    <div v-if="!loading && cartItems.length" class="text-right mt-6">
      <p class="text-xl font-bold">Total Cost: ${{ totalCost }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      cartItems: [], // Holds the cart items
      totalCost: 0,  // Holds the total cost of the cart
      loading: true, // For loading state
    };
  },
  methods: {
    // Fetch cart data from the server
    fetchCart() {
      axios
        .get('/api/cart')
        .then((response) => {
          this.cartItems = response.data.items;
          this.totalCost = response.data.totalCost;
          this.loading = false;
        })
        .catch((error) => {
          console.error('Error fetching cart:', error);
          this.loading = false;
        });
    },
    // Method to remove an item from the cart
    removeFromCart(productId) {
      axios
        .delete(`/api/cart/remove/${productId}`)
        .then(() => {
          this.cartItems = this.cartItems.filter(item => item.id !== productId);
          this.totalCost = this.cartItems.reduce((total, item) => total + item.total, 0);
        })
        .catch((error) => {
          console.error('Error removing item from cart:', error);
        });
    }
  },
  mounted() {
    this.fetchCart(); // Fetch cart items when the component is mounted
  }
};
</script>
