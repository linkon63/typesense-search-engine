<template>
    <div class="p-6">
        <h1 class="mb-4 text-2xl font-bold">Edit Product</h1>

        <form @submit.prevent="updateProduct" class="max-w-md space-y-4">
            <div>
                <label class="block font-semibold">Name</label>
                <input v-model="form.name" type="text" class="w-full rounded border p-2" />
                <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
            </div>

            <div>
                <label class="block font-semibold">Price</label>
                <input v-model="form.price" type="number" step="0.01" class="w-full rounded border p-2" />
                <div v-if="form.errors.price" class="text-sm text-red-500">{{ form.errors.price }}</div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Update</button>
                <Link :href="route('products.index')" class="text-gray-600 hover:underline">Cancel</Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ product: Object });

const form = useForm({
    name: props.product.name,
    price: props.product.price,
});

const updateProduct = () => {
    form.put(route('products.update', props.product.id));
};
</script>
