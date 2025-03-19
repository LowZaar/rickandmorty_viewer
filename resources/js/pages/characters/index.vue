<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'Characters',
        href: '/characters',
    },
];
</script>

<template>
    <Head title="Characters">
    <AppLayout :breadcrumbs="breadCrumbs">
    </AppLayout>
</template>
