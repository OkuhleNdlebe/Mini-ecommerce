<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard"></Head>

    <AuthenticatedLayout>
        <!-- Navigation Links -->
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>

                <!-- Nav Bar Links -->
                <nav class="flex space-x-4">
                    <Link href="/dashboard" class="text-gray-800 hover:text-gray-600 font-medium">
                        Home
                    </Link>
                    <Link href="/products" class="text-gray-800 hover:text-gray-600 font-medium">
                        Products
                    </Link>
                    <Link href="/cart" class="text-gray-800 hover:text-gray-600 font-medium">
                        Cart
                    </Link>
                </nav>
            </div>
        </template>

        <!-- Main Content -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
