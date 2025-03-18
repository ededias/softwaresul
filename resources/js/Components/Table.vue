<script setup lang="ts">
import { Book } from '@/types';
import { faBook } from '@fortawesome/free-solid-svg-icons';
import { usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import Tooltip from './Tooltip.vue';

const user = usePage().props.auth.user;

const data = defineProps<{
    books: Book[];
}>();

const emit = defineEmits(['deleteBook', 'boooking', 'deleteBoooking']); 

const deleteBook = (book: Book) => {
    emit('deleteBook', book); 
}
const boooking = (book: Book) => {
    emit('boooking', book); 
}
const deleteBoooking = (book: Book) => {
    emit('deleteBoooking', book); 
}

</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Titulo
                </th>
                <th scope="col" class="px-6 py-3">
                    Autor
                </th>
                <th scope="col" class="px-6 py-3">
                    ISBN
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Ações
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(book, index) in data.books" :key="index" class="bg-gray-50 dark:bg-gray-700">
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ index + 1 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ book.title }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ book.author }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ book.isbn }}
                </td>
                <td class="px-6 py-4 text-center     whitespace-nowrap  text-sm font-medium content-center">
                    <Tooltip v-if="user.role == 'administrator'" text="Editar Livro" id="tooltip">
                        <a :href="'edit/'+book.id" class="text-indigo-600 hover:text-indigo-900">
                            <font-awesome-icon :icon="['fa', 'pencil']" />
                        </a>
                    </Tooltip> 
                    <Tooltip v-if="user.role == 'administrator'" text="Excluir livro" id="tooltip">
                        <button @click="deleteBook(book)" class="text-red-600 hover:text-red-900 m-3">
                            <font-awesome-icon :icon="['fa', 'trash']" />
                        </button>
                    </Tooltip>
                    
                    <Tooltip v-if="book.quantity > 0" text="Reservar Livro" id="tooltip">
                        <button  @click="boooking(book)" class="text-indigo-600 hover:text-red-900 m-3">
                            <font-awesome-icon :icon="['fa', 'ticket']" />
                        </button>
                    </Tooltip>
                    <!-- && book.booking[0].book_id == book.id -->
                    <Tooltip v-if="book.booking.length > 0 && book.booking[0].book_id == book.id"  text="Cancelar Reserva" id="tooltip">  
                        <button 
                            @click="deleteBoooking(book)" class="text-indigo-600 hover:text-red-900 m-3">
                            
                                <font-awesome-icon :icon="['fa', 'ticket']" />
                                <!-- {{ book.booking[0].book_id }} -->
                            </button>
                    </Tooltip>
                   
                </td>

            </tr>
        </tbody>
    </table>
    
</template>