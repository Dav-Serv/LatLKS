<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    title: String,
    route_url: String,
    form_type: String,
    model: Object,
});

const form = useForm({
    _method: props.form_type,
    name: props.model?.name,
    location: props.model?.location,
    limit: props.model?.limit,
    price: props.model?.price,
    status: props.model?.status ?? 'active',
});

const createTable = () => {
    form.post(props.route_url, {
        errorBag: 'createTable',
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
                <ButtonLink :href="route('tables.index')">Back</ButtonLink>
                <form @submit.prevent="createTable" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mt-4">
                    <div class="mb-7">
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
                            <label class="block font-medium text-sm text-gray-700">Location</label>
                            <textarea
                                id="location"
                                v-model="form.location"
                                type="text"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.location" v-html="form.errors.location" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Limit</label>
                            <input
                                id="limit"
                                v-model="form.limit"
                                type="number"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            />
                            <p class="text-sm text-red-600" v-if="form.errors.limit" v-html="form.errors.limit" />
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

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Status</label>
                            <select
                                id="status"
                                v-model="form.status"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <p class="text-sm text-red-600" v-if="form.errors.status" v-html="form.errors.status" />
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