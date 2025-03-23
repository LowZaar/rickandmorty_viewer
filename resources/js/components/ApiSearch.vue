<script setup lang="ts">
import { Input } from '@/components/ui/input';
import CharacterStatus from '@/enums/CharacterStatus';
import { useForm } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';
import Button from './ui/button/Button.vue';
import Select from './ui/select/Select.vue';
import SelectContent from './ui/select/SelectContent.vue';
import SelectItem from './ui/select/SelectItem.vue';
import SelectTrigger from './ui/select/SelectTrigger.vue';
import SelectValue from './ui/select/SelectValue.vue';

interface Props {
    filters: {
        name: string;
        status: string | null;
    };
}

const props = defineProps<Props>();

const form = useForm({
    status: props.filters.status ?? null,
    name: props.filters.name ?? '',
});

const getSearchValues = () => {
    form.get('/characters');
};
</script>

<template>
    <div>
        <form @submit.prevent="getSearchValues" class="my-5 flex flex-row items-center gap-2 rounded-lg border px-2">
            <Select v-model="form.status">
                <SelectTrigger class="w-[180px] border-none">
                    <SelectValue placeholder="Status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem v-for="(value, index) of Object.values(CharacterStatus)" :value="value" :key="index">
                        {{ value }}
                    </SelectItem>
                </SelectContent>
            </Select>
            <span class="h-full w-[1px] border-white px-2"></span>
            <Input v-model="form.name" placeholder="Search" class="border-none" />

            <Button class="h-full" variant="ghost">
                <Search :size="32" />
            </Button>
        </form>
    </div>
</template>
