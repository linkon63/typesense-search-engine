<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <!-- <link rel="preconnect" href="https://rsms.me/" /> -->
        <!-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css" /> -->
    </Head>
    <div class="h-screen bg-white p-8 text-black">
        <p>Hello world</p>
        <nav class="">
            <Link :href="route('home')" :active="route().current('home')"> Home </Link>
            <Link :href="route('products.index')" :active="route().current('products.*')"> Products </Link>
            <Link :href="route('categories.index')" :active="route().current('categories.*')"> Categories </Link>
        </nav>
    </div>

    <!-- Add these navigation items to your existing menu -->
</template>
