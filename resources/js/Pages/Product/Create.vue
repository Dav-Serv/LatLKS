<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    title: String,
    route_url: String,
    form_type: String,
    model: Object,
    categories: Array,
});

const form = useForm({
    _method: props.form_type,
    image: props.model?.image,
    name: props.model?.name,
    category_id: props.model?.category_id,
    desc: props.model?.desc,
    stock: props.model?.stock,
    price: props.model?.price,
});

const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const createProduct = () => {
    form.post(props.route_url, {
        errorBag: 'createProduct',
        preserveScroll: true,
        onSuccess: () => true,
    });
};
</script>

<template>
    <AppLayout :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="createProduct" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" enctype="multipart/form-data">
                    <div class="mb-7">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Image</label>
                            <input
                                id="image"
                                type="file"
                                @change="handleImageUpload"
                                accept="image/*"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <div v-if="model.image">
                                <p>Gambar saat ini:</p>
                                <img :src="`/storage/${model.image}`" alt="current-image" width="150">
                            </div>
                            <p class="text-sm text-red-600" v-if="form.errors.image" v-html="form.errors.image" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Name</label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.name" v-html="form.errors.name" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Category</label>
                            <!-- <input
                                id="category_id"
                                v-model="form.category_id"
                                type="text"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            /> -->
                            <select v-model="form.category_id" id="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option v-for="item in categories" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <p class="text-sm text-red-600" v-if="form.errors.category_id" v-html="form.errors.category_id" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Description</label>
                            <input
                                id="desc"
                                v-model="form.desc"
                                type="text"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.desc" v-html="form.errors.desc" />
                        </div>
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Stock</label>
                            <input
                                id="stock"
                                v-model="form.stock"
                                type="number"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.stock" v-html="form.errors.stock" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Price</label>
                            <input
                                id="price"
                                v-model="form.price"
                                type="number"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.price" v-html="form.errors.price" />
                        </div>

                    </div>

                    <div>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            Saved.
                        </ActionMessage>

                        <ButtonLink :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" color="blue">
                            Save
                        </ButtonLink>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>