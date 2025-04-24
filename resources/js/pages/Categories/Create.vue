<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    parentCategories: Array,
});

const form = useForm({
    name: '',
    is_active: true,
    parent_id: null,
});

const submit = () => {
    form.post(route('categories.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <section class="bg-white p-6 text-black h-screen">
        <Head title="Create Category" />
    
        <h2 class="text-xl leading-tight font-semibold text-gray-800">Create New Category</h2>
    
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                </div>
    
                                <!-- Parent Category -->
                                <div>
                                    <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category (Optional)</label>
                                    <select
                                        id="parent_id"
                                        v-model="form.parent_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option :value="null">No Parent</option>
                                        <option v-for="parent in parentCategories" :key="parent.id" :value="parent.id">
                                            {{ parent.name }}
                                        </option>
                                    </select>
                                </div>
    
                                <!-- Active Status -->
                                <div class="flex items-center">
                                    <input
                                        id="is_active"
                                        v-model="form.is_active"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active Category</label>
                                </div>
                            </div>
    
                            <div class="mt-6 flex justify-end">
                                <Link :href="route('categories.index')" class="mr-3 rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing">Saving...</span>
                                    <span v-else>Save Category</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
