<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import ButtonLink from '@/Components/ButtonLink.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    models: {
        type: Object,
        default: {}
    }
});

const form = useForm({_method: "DELETE"});

const deleteCategory = (id) => {
    if (confirm('Are you sure you want to delete this post?')) {
        form.post(route('categories.destroy', id), {
            errorBag: 'deleteCategory',
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <AppLayout title="Table">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category</h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <ButtonLink :href="route('categories.create')">Add Category</ButtonLink>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-7">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name Category</th>
                                    <th scope="col" class="px-6 py-3" width="15%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in models.data" :key="item.id" class="bg-white border-b border-gray-200">
                                    <td class="px-6 py-4">{{ item.name }}</td>
                                    <td class="px-6 py-4">
                                        <ButtonLink :href="route('categories.edit', item.id)" color="blue">Edit</ButtonLink>&nbsp;
                                        <ButtonLink @click="deleteCategory(item.id)" color="red">Delete</ButtonLink>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :links="models.links"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>