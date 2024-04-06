<template>
    <ul class="about__list list-reset">
        <component :is="BookItem" v-for="book in books" :key="book.id" :book="book"></component>
    </ul>
</template>

<script setup>


import BookItem from './BookItem.vue';

const props = defineProps({
    books: Array,
});


</script>

