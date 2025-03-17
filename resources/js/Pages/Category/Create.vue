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
});

const form = useForm({
    _method: props.form_type,
    name: props.model?.name,
});

const createCategory = () => {
    form.post(props.route_url, {
        errorBag: 'createCategory',
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
                <form @submit.prevent="createCategory" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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