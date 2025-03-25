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

const deleteUser = (id) => {
    if (confirm('Are you sure you want to delete this post?')) {
        form.post(route('user.destroy', id), {
            errorBag: 'deleteUser',
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <AppLayout title="User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User</h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <ButtonLink :href="route('user.create')">Add User</ButtonLink>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-7">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Id</th>
                                    <th scope="col" class="px-6 py-3">Name User</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Level</th>
                                    <th scope="col" class="px-6 py-3">Password</th>
                                    <th scope="col" class="px-6 py-3" width="15%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in models.data" :key="item.id" class="bg-white border-b border-gray-200">
                                    <td class="px-6 py-4">{{ item.id }}</td>
                                    <td class="px-6 py-4">{{ item.name }}</td>
                                    <td class="px-6 py-4">{{ item.email }}</td>
                                    <td class="px-6 py-4">{{ item.level }}</td>
                                    <td class="px-6 py-4 break-all text-xs">{{ item.password }}</td>
                                    <td class="px-6 py-4">
                                        <ButtonLink :href="route('user.edit', item.id)" color="blue">Edit</ButtonLink>&nbsp;
                                        <ButtonLink @click="deleteUser(item.id)" color="red">Delete</ButtonLink>
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