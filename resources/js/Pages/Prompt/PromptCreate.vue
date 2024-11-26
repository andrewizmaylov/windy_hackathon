<template>
    <div class="bg-white min-h-screen flex justify-center items-center">
        <main class="ringed_box w-[80%] mx-auto shadow rounded-lg">
	        
            <div class="mx-auto my-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
                <h2 class="text-6xl font-semibold">Prompt Editor</h2>
						
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 text-gray-700">
                    <div class="sm:col-span-4">
                        <label for="type"
                               class="block text-sm/6 font-medium">Title</label>
                        <div class="mt-2">
                            <input type="text"
                                   name="type"
                                   id="type"
                                   autocomplete="type"
                                   v-model="form.type"
                                   class="block flex-1 w-full border rounded bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                   placeholder="" />
                        </div>
                        <InputError :message="form.errors.type"
                                    class="mt-2" />
                    </div>
							
                    <div class="col-span-full">
                        <label for="text"
                               class="block text-sm/6 font-medium text-white">Prompt</label>
                        <div class="mt-2">
                            <textarea id="text"
                                      name="text"
                                      rows="3"
                                      v-model="form.text"
                                      class="block w-full rounded-md border bg-white/5 py-1.5 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-0 sm:text-sm/6" />
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-400">Describe the task for Chat GPT</p>
                        <InputError :message="form.errors.text"
                                    class="mt-2" />
                    </div>
						
                </div>
            </div>

				
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button @click="router.get(route('promptIndex'))"
                        class="text-sm/6 font-semibold text-blue-500">Cancel</button>
                <button @click="proceedForm"
                        class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
            </div>

        </main>
    </div>
</template>
<script setup>
import {router, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    prompt: {
        type: Object,
    }
});

let form = useForm({
    method: 'POST',
    id: props?.prompt?.id ?? null,
    type: props?.prompt?.type ?? null,
    text: props?.prompt?.text ?? null,
});

function proceedForm() {
    form.post(route('promptStore'), {
        onSuccess: () => router.get(route('promptIndex')),
    });
}
</script>