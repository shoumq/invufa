<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { saveAs } from 'file-saver';


const title = ref(null)

const handleSubmit = () => {
    axios.post('/download_word', { title: title.value }, { responseType: 'blob' })
        .then(response => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'document.docx');
            document.body.appendChild(link);
            link.click();
        })
        .catch(error => {
            console.error(error);
        });
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="flex justify-center items-center mt-10">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-md" @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="name">
                        Название документа
                    </label>
                    <input v-model="title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="Введите название документа">
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Сгенерировать
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>