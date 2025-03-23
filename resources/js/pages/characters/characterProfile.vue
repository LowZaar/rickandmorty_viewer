<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Character } from '@/types/index';
import { Head } from '@inertiajs/vue3';

interface Props {
    character: Character;
}

const props = defineProps<Props>();

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'Characters',
        href: '/characters',
    },
    {
        title: props.character.name,
        href: `/characters/${props.character.id}`,
    },
];

const pageTitle = `Characters - ${props.character.name}`;

console.log(props.filters);
</script>
<template>
    <Head :title="pageTitle" />
    <AppLayout :breadcrumbs="breadCrumbs">
        <section class="container mx-auto mt-5">
            <div className="grid grid-cols-3 grid-rows-2 gap-4">
                <div class="row-span-1 flex justify-center">
                    <img :src="character.image" :alt="character.name" class="rounded-xl" />
                </div>
                <div className="col-span-2 row-span-2 bg-slate-400 dark:bg-neutral-800 rounded-xl p-5">
                    <h1 class="text-3xl font-bold">{{ character.name }}</h1>
                    <p>{{ character.species }} ({{ character.status }})</p>
                    <p v-if="character.type">Type: {{ character.type }}</p>
                    <p>Seen in {{ character.episode }} episodes</p>
                    <div class="mt-5 flex flex-col gap-2">
                        <p>Gender: {{ character.gender }}</p>
                        <p>Last known location: {{ character.location.name }}</p>
                        <p>Origin: {{ character.origin.name }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
