<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    categories: Object,
});
</script>

<template>
    <section class="bg-white p-6 text-black h-screen">
        <Head title="Categories" />

        <div class="flex items-center justify-between">
            <h2 class="text-xl leading-tight font-semibold text-gray-800">Categories</h2>
            <Link :href="route('categories.create')" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"> Add Category </Link>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Parent</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="category in categories.data" :key="category.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ category.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ category.parent?.name || '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="category.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                                class="inline-flex rounded-full px-2 text-xs leading-5 font-semibold"
                                            >
                                                {{ category.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <Link :href="route('categories.edit', category.id)" class="mr-3 text-indigo-600 hover:text-indigo-900"
                                                >Edit</Link
                                            >
                                            <Link
                                                :href="route('categories.destroy', category.id)"
                                                method="delete"
                                                as="button"
                                                class="text-red-600 hover:text-red-900"
                                                >Delete</Link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- <Pagination :links="categories.links" class="mt-6" /> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
