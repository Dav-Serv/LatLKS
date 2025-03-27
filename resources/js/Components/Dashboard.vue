<!-- script vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import ButtonLink from '@/Components/ButtonLink.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    name:{
        type: String,
        default: null
    },
    models:{
        type: Object,
        default: {}
    },
    level:{
        type: String,
        default: 'user',
    }
});

// Fungsi untuk memformat harga
const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR', // Format IDR (Rupiah)
    }).format(price);
};
</script>

<!-- script css -->
<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 50px;
    }

    .grid-item {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<template>
    <div  class="" >
        <div v-if="level == 'admin'" class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
                Admin [<strong>{{ name }}</strong>] Welcome to Dashboard Admin Restaurant Dava!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Ini adalah halaman Admin dan anda bisa mengelola restoran ini. <br>
                Di sini Admin bisa mengelola kategori, mengelola barang,mengelola reservasi, 
                mengelola pembelian, mengelola pembayaran, dan mengelola laporan transaksi. <br>
               <h2 class="text-center"><strong>~SELAMAT BEKERJA ADMIN RESTORAN DAVA~</strong></h2> 
            </p>
        </div>

        <div v-else-if="level == 'user'" class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
                Pelanggann [<strong>{{ name }}</strong>] Welcome to Dashboard Pelanggan Restaurant Dava!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Ini adalah halaman Admin dan anda bisa mengelola restoran ini. <br>
                Di sini Admin bisa mengelola kategori, mengelola barang,mengelola reservasi, 
                mengelola pembelian, mengelola pembayaran, dan mengelola laporan transaksi. <br>
            <h2 class="text-center"><strong>~SELAMAT BEKERJA ADMIN RESTORAN DAVA~</strong></h2> 
            </p>
        </div>

        <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
                <strong>Rekomendasi Menu Kami!</strong>
        </h1>
        <div class="grid-container bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div  v-for="item in models" :key="item.id" class="col-md-4 max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="grid-item">
                    <a href="#">
                        <img class="image rounded-t-lg" :src="`/storage/${item.image}`" alt="product-image" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ item.name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ formatPrice(item.price) }}</p>
                        <a :href="route('dashboard.show', item.id)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
