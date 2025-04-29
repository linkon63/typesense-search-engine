<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

// Props
const props = defineProps({
    products: Array,
});

// Reactive data
const query = ref('');
const products = ref(props.products);

// Search method
const search = () => {
    router.get(
        '/search',
        { q: query.value },
        {
            preserveState: true,
            onSuccess: (page) => {
                products.value = page.props.products;
            },
        },
    );
};
</script>

<template>
    <div class="h-screen bg-white text-black">
        <!-- Search Form -->
        <form @submit.prevent="search">
            <input type="text" v-model="query" placeholder="Search for products" />
            <button type="submit">Search</button>
        </form>

        <!-- Display Search Results -->
        <h2 v-if="products.length">Search Results</h2>
        <div v-for="product in products" :key="product.id" class="product">
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p><strong>Price:</strong> ${{ product.formatted_price }}</p>
        </div>

        <!-- No Results Found -->
        <div v-if="products.length === 0 && query !== ''">
            <p>No products found</p>
        </div>
    </div>
</template>

<style scoped>
/* Scoped styles specific to this component */
.product {
    margin-bottom: 20px;
}

input[type='text'] {
    padding: 8px;
    margin-right: 10px;
}

button {
    padding: 8px 12px;
}
</style>
