<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from  '@/Components/Table.vue';
import { Head, usePage} from '@inertiajs/vue3';
import { Book } from '@/types';
import { ref } from 'vue';
import axios from 'axios';
import { Alert } from '@/Components/Alert';
import TextInput from '@/Components/TextInput.vue';
const user = usePage().props.auth.user;
const books = ref(usePage().props.books);
const page = usePage();
const search = ref<string>('');


const deleteBooking = async (book: Book) => {
    const response = await Alert({
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, reservar!',
        icon: 'warning',
        showCancelButton: true,
        text: 'Você deseja cancelar sua reserva?',
        title: 'Tem certeza?'
    });
    if (response) {
        const response = await axios.delete(route('delete-booking', { id: book.id }), {
            data: {
                _token: page.props.csrf_token
            }
        });
        books.value = await response.data.books;
        if (response.status == 200) {
            Alert({
                icon: 'success',
                text: 'Sua reserva foi cancelada.',
                title: 'Reserva cancelada!',
                confirmButtonText: 'Ok'
            });
        }
        
        
    }
}


const boooking = async (book: Book) => {
    
    const response = await Alert({
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, reservar!',
        icon: 'warning',
        showCancelButton: true,
        text: 'Você deseja reservar este livro?',
        title: 'Tem certeza?'
    });
   
    if (response) {
        
        const response = await axios.post(route('create-booking', { id: book.id }), {
            data: {
                _token: page.props.csrf_token
            }
        });
        books.value = await response.data.books;
        if (response.status == 200) {
            Alert({
                icon: 'success',
                text: 'Seu livro foi reservado.',
                title: 'Reservado!',
                confirmButtonText: 'Ok'
            });
        }
        
        
    }
}   

const deleteBook = async (book: Book) => {
    const response = await Alert({
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, reservar!',
        icon: 'warning',
        showCancelButton: true,
        text: 'Você deseja reservar este livro?',
        title: 'Tem certeza?'
    });
    if (response) {
        const response = await axios.delete(route('delete', { id: book.id }), {
            data: {
                _token: page.props.csrf_token
            }
        });
        books.value = await response.data.books;
        if (response.status == 200) {
            Alert({
                icon: 'success',
                text: 'Seu livro foi reservado.',
                title: 'Reservado!',
                confirmButtonText: 'Ok'
            });
        }
        
        
    }
   
}

const searchBooks = async () => {
    
    const response = await axios.get(route('search-books', { search: search.value }), {
        data: {
            _token: page.props.csrf_token
        }
    });
    books.value = await response.data;
}


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div v-if="user.role == 'administrator'" class="flex justify-between mb-4">
                   <div class="flex justify-between">
                        <TextInput
                            v-model="search"
                            type="search"
                            placeholder="Pesquisar..."
                            class="w-90" />
                        <button @click="searchBooks" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buscar</button>
                   </div>
                    <a href="add-book" type="button" class="pl-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Adicionar Livro
                    </a>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <Table v-if="books && books.length > 0"
                                :books="books"
                                @delete-book="deleteBook"
                                @boooking="boooking"
                                @delete-boooking="deleteBooking"
                            />
                            <div v-else class="flex justify-center items-center h-96 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <p class="text-2xl text-gray-500">Nenhum livro encontrado</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
