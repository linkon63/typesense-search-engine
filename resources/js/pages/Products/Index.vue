<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
    products: Array,
});

const form = useForm({
    name: '',
    description: '',
    price: 0,
    quantity: 0,
    sku: '',
    is_active: true,
    category_id: '',
    image_path: '',
});

const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => form.reset(),
    });
};

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        router.delete(route('products.destroy', id));
    }
};
</script>
<template>
    <div class="h-full bg-white p-6 text-black">
        <h2 class="text-xl leading-tight font-semibold text-gray-800">Create New Product</h2>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <p class="mt-1 text-xs text-red-500" v-if="form.errors.name">{{ form.errors.name }}</p>
                                </div>

                                <!-- SKU -->
                                <div>
                                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                                    <input
                                        id="sku"
                                        v-model="form.sku"
                                        type="text"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <p class="mt-1 text-xs text-red-500" v-if="form.errors.sku">{{ form.errors.sku }}</p>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input
                                        id="price"
                                        v-model="form.price"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <p class="mt-1 text-xs text-red-500" v-if="form.errors.price">{{ form.errors.price }}</p>
                                </div>

                                <!-- Quantity -->
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input
                                        id="quantity"
                                        v-model="form.quantity"
                                        type="number"
                                        min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <p class="mt-1 text-xs text-red-500" v-if="form.errors.quantity">{{ form.errors.quantity }}</p>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                    <select
                                        id="category_id"
                                        v-model="form.category_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    >
                                        <option value="">Select a category</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <p class="mt-1 text-xs text-red-500" v-if="form.errors.category_id">{{ form.errors.category_id }}</p>
                                </div>

                                <!-- Active Status -->
                                <div class="flex items-center">
                                    <input
                                        id="is_active"
                                        v-model="form.is_active"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active Product</label>
                                </div>

                                <!-- Description -->
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea
                                        id="description"
                                        v-model="form.description"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    ></textarea>
                                </div>

                                <!-- Image Upload (basic implementation) -->
                                <div class="md:col-span-2">
                                    <label for="image_path" class="block text-sm font-medium text-gray-700">Product Image URL</label>
                                    <input
                                        id="image_path"
                                        v-model="form.image_path"
                                        type="text"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <Link :href="route('products.index')" class="mr-3 rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing">Saving...</span>
                                    <span v-else>Save Product</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="mb-4 text-2xl font-bold">Products</h1>
        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Price</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id" class="border-t">
                    <td class="p-2">{{ product.name }}</td>
                    <td class="p-2">{{ product.price }}</td>
                    <td class="flex gap-2 p-2">
                        <Link :href="route('products.edit', product.id)" class="text-blue-500 hover:underline"> Edit </Link>
                        <button @click="deleteProduct(product.id)" class="text-red-500 hover:underline">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

