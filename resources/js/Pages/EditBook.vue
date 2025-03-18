<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Textarea from '@/Components/Textarea.vue';
import TextInput from '@/Components/TextInput.vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';



const book = usePage().props.book;

const genres = ref([
    { value: 1, name: 'Ação' },
    { value: 2, name: 'Aventura' },
    { value: 3, name: 'Comédia' },
    { value: 4, name: 'Drama' },
    { value: 5, name: 'Fantasia' },
    { value: 6, name: 'Ficção Científica' },
    { value: 7, name: 'Romance' },
    { value: 8, name: 'Terror'  }
    
])


const form = useForm({
    title: book?.title ?? '',
    author: book?.author ?? '',
    isbn: book?.isbn ?? '',
    year: book?.year ?? '',
    genre: book?.genre ?? '',
    image: book?.image ?? '',
    description: book?.description ?? '',
    quantity: book?.quantity ?? '',
});
 
const submit = () => {

    if (route().current() == 'edit-book') {
        form.put(route('update-book', book.id), {
            onFinish: () => {
                form.reset('title', 'author', 'isbn', 'year', 'genre', 'description');
            },
        });
        return;
    }

    form.post(route('new-book'), {
        onFinish: () => {
            form.reset('title', 'author', 'isbn', 'year', 'genre', 'description');
        },
    });
};

</script>

<template>

    <Head title="Adicioar Livro" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-4">
                    <form class="space-y-8 divide-y divide-gray-200" @submit.prevent="submit">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="title" value="Titulo" />

                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                                    required autofocus />

                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="author" value="Autor" />
                                <TextInput id="author" type="text" class="mt-1 block w-full" v-model="form.author"
                                    required autofocus />

                            </div>

                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="genre" value="Genero" />

                                <SelectInput 
                                    id="genre" 
                                    v-model="form.genre" 
                                    :values="genres" 
                                    class="mt-1 block w-full"
                                    required 
                                />

                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="isbne" value="ISBN" />
                                <TextInput id="isbne" type="text" class="mt-1 block w-full" v-model="form.isbn"
                                    required autofocus />

                            </div>

                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="year" value="Ano" />

                                <TextInput id="year" v-model="form.year" class="mt-1 block w-full"
                                    required />

                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="quantity" value="Quantidade disponivels" />

                                <TextInput id="quantity" v-model="form.quantity" class="mt-1 block w-full"
                                    required />

                            </div>

                        </div>
                        <div class="grid grid-cols-1 gap-6">
                            

                            <div class="relative z-0 w-full mb-5 group">
                                <InputLabel for="description" value="Descrição" />

                                <Textarea id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" required autofocus />

                            </div>

                        </div>
                        <PrimaryButton 
                            class="mt-4"
                            :disabled="form.processing"
                            :class="{ 'opacity-25': form.processing }"
                            >
                            Adicionar Livro
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>