<script lang="ts" setup>
import { onMounted, ref } from 'vue';
interface Select {
    value: string | number;
    name: string;
}
const model = defineModel<string | number>({ required: true });
const data = defineProps<{
    values: Select[];
}>();
const input = ref<HTMLInputElement | null>(null);

onMounted(() => { 
    console.log(model.value);
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <select name="" v-model="model" id="" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value=""></option>
        <option :value="item.value" v-for="item in data.values" :key="item.value" >{{ item.name  }}</option>
    </select>
</template>