<script setup lang="ts">
import { onMounted, ref } from 'vue';

const data = defineProps<{
    text: string;
    id: string;
}>(); 

</script>


<template>
    <div class="relative group inline-block">
      <slot></slot>
      <div
        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-max bg-gray-800 text-white text-xs px-3 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity"
      >
        {{ data.text }}
        <div
          class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-800"
        ></div>
      </div>
    </div>
  </template>

<!-- <template>

    <div class="relative group inline-block">
        
        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-32 bg-gray-800 text-white text-sm p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
            {{ data.text }}
        </div>
    </div>


    <div :id="id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 tooltip">
        {{ data.text }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template> -->