<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Ds from '@/Components/Dashboard.vue';

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
        default: 'user'
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Ds :name="name" :models="models"  :level="level" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
