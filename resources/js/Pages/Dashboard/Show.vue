<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import { useForm } from '@inertiajs/vue3';  // Impor useForm jika diperlukan untuk form atau proses lain

// Properti untuk menerima data dari controller
const props = defineProps({
  models: {
    type: Object,  // pastikan models yang dikirim adalah objek produk
    default: () => ({})  // default objek kosong jika tidak ada data
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

<template>
  <AppLayout title="Product Details">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Product</h2>
        </template>
    <div class="container mx-auto sm:px-6 lg:px-8">
      <div class="show-page">
        <ButtonLink :href="route('dashboard')">Back</ButtonLink>
      <div class="card mt-4">
        <div class="card-body">
          <!-- Menampilkan Gambar -->
          <div v-if="models">
            <img :src="`/storage/${models.image}`" alt="product-image" class="show-image" />
          </div>
          <!-- Menampilkan Judul dan Deskripsi -->
          <div v-if="models">
            <h1>{{ models.name }}</h1>
            <p>Category:    {{ models.category?.name }}</p>
            <p>Description: {{ models.desc }}</p>
            <p>Stok:        {{ models.stock }}</p>
            <p>Harga:       {{ formatPrice(models.price) }}</p>
          </div>
          <!-- Loading state jika data belum tersedia -->
          <div v-else>
            <p>Memuat data...</p>
          </div>
        </div>
      </div>
    </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.show-page {
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
}

.card {
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* .card-header {
  padding: 15px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #ddd;
} */

.card-body {
  padding: 20px;
}

.show-image {
  width: 50%;
  height: auto;
  max-width: 600px;
  margin: 0 auto;
  display: block;
  object-fit: cover;
}

h1 {
  margin-top: 20px;
  font-size: 24px;
}

p {
  font-size: 16px;
  color: #555;
}
</style>
