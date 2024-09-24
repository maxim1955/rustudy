<template>
    <li class="about__item">
        <a target="_blank" :href="book.url" class="about__link book">
            <img :src="book.image" :alt="book.type">
            <div class="about__content">
            <p class="book__title">{{ book.type }}</p>
            <p class="book__level">уровень <span>{{ book.level }}</span></p>
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 10L31.6667 31.6667M31.6667 31.6667V10.8667M31.6667 31.6667H10.8667" stroke="#0A2B49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </div>
        </a>

    </li>
</template>

<script setup>
import { onMounted } from "vue";
import gsap from 'gsap';
const props = defineProps({
    book: Object,
});


onMounted(() => {
    const items = document.querySelectorAll('.about__item');
var tl = gsap.timeline({ repeat: -1, defaults: { duration: 0.3, yoyo: -1, repeat: 1, ease: 'sine' } });


items.forEach(item => {
    tl.from(item, {
        y: '0',
    })
    tl.to(item, {
        y: '-3',
        boxShadow: '0px 13px 12px 0px rgba(87, 36, 167, 0.50)',

    })




})



})









</script>
