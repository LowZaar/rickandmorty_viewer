<script setup lang="ts">
import { Character } from '@/types/index';
import { Link } from '@inertiajs/vue3';
import Card from './ui/card/Card.vue';
import CardContent from './ui/card/CardContent.vue';
import CardDescription from './ui/card/CardDescription.vue';
import CardHeader from './ui/card/CardHeader.vue';
import CardTitle from './ui/card/CardTitle.vue';

interface Props {
    character: Character;
}

defineProps<Props>();
</script>

<template>
    <Card class="rounded-xl">
        <CardHeader class="text-center">
            <Link :href="character.url">
                <img class="rounded-xl" :src="character.image" />
            </Link>

            <CardTitle class="text-xl">
                <Link :href="character.url">
                    {{ character.name }}
                </Link>
            </CardTitle>
            <CardDescription class="flex flex-col gap-2">
                <p>{{ character.gender }} ({{ character.status }})</p>
                <Link class="truncate" :href="character.location.url"> Current Location: {{ character.location.name }} </Link>
                <Link class="truncate" :href="character.origin.url">Origin: {{ character.location.name }}</Link>
            </CardDescription>
        </CardHeader>
        <CardContent class="">
            <slot />
        </CardContent>
    </Card>
</template>
