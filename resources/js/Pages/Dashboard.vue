<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />

    <div class="relative min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 overflow-hidden">
        <!-- Moving Shopping Bags Background -->
        <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center animate-moveBags" style="background-image: url('https://i.imgur.com/V5g8Ebn.png'); opacity: 0.2;"></div>

        <div class="relative flex flex-col items-center justify-center min-h-screen z-10">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:col-start-2 lg:justify-center">
                        <svg
                            class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]"
                            viewBox="0 0 62 65"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <!-- SVG Path for logo -->
                            <path
                                d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615..."
                                fill="currentColor"
                            />
                        </svg>
                    </div>

                    <!-- Login/Register Navigation -->
                    <nav v-if="canLogin" class="flex justify-end space-x-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-full px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 transition duration-300 shadow-lg"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <!-- Login Button -->
                            <Link
                                :href="route('login')"
                                class="rounded-full px-6 py-3 bg-green-500 text-white hover:bg-green-600 transition duration-300 shadow-lg"
                            >
                                Log in
                            </Link>

                            <!-- Register Button -->
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-full px-6 py-3 bg-red-500 text-white hover:bg-red-600 transition duration-300 shadow-lg"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <!-- Main Content -->
                <main class="mt-6 z-10">
                    <!-- Add to Cart Button -->
                    <div class="text-center mb-8">
                        <Link
                            href="/cart"
                            class="bg-yellow-500 text-white px-6 py-3 rounded-full hover:bg-yellow-600 transition duration-300 shadow-lg"
                        >
                            View Cart
                        </Link>
                    </div>

                    <!-- View Products Button -->
                    <div class="text-center mb-8">
                        <Link
                            href="/products"
                            class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 transition duration-300 shadow-lg"
                        >
                            View Products
                        </Link>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-16 text-center text-sm text-black dark:text-white/70 z-10">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
</template>

<!-- Styling for animation and other elements -->
<style>
@keyframes moveBags {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -200% 0;
  }
}

.animate-moveBags {
  animation: moveBags 20s linear infinite;
}
</style>
