<script setup lang="ts">
import ApiPagination from '@/components/ApiPagination.vue';
import ApiSearch from '@/components/ApiSearch.vue';
import CharacterCard from '@/components/CharacterCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'Characters',
        href: '/characters',
    },
];

const page = usePage();
const characterList = page.props.characters;
const pageFilters = page.props.filters;
const info = page.props.info;
</script>

<template>
    <Head title="Characters" />
    <AppLayout :breadcrumbs="breadCrumbs">
        <section class="container mx-auto pt-5">
            <p v-if="info">{{ info }} Characters found!</p>
            <div class="mx-auto w-1/2">
                <ApiSearch :filters="pageFilters" />
            </div>
            <div class="pagination mt-5 flex justify-center">
                <ApiPagination :links="characterList.links" />
            </div>
            <div class="mt-5 grid grid-cols-4 grid-rows-5 gap-4">
                <div v-for="character in characterList.data">
                    <CharacterCard :character="character" />
                </div>
            </div>

            <div class="pagination mt-5 flex justify-center">
                <ApiPagination :links="characterList.links" />
            </div>
        </section>
    </AppLayout>
</template>
