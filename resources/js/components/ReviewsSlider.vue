<template>
    <div>
     <swiper class="reviews-slider"
        :modules="modules"
        :slides-per-view="4"
        :space-between="20"
        navigation
        :breakpoints="{
            320:{ slidesPerView:1 },
            768:{ slidesPerView:2.5 },
            1025:{ slidesPerView:4 },
        }"
        >
        <swiper-slide class="review" v-for="(review, index) of reviews" :key="review.id" @click.prevent="openModal(review.id, index)">
            <div class="review__card">
                <img class="review__image" :src="'storage/'+review.image" :alt="review.teachername">
                <!-- <picture>
                    <source :srcset="review.tablet" media="(max-width:1024px)">
                    <img class="review__image" :src="review.image" :alt="review.name">
                </picture> -->
                <div class="review__block">
                    <img class="" :src="'storage/'+review.image" alt="">
                    <p class="review__name">{{ review.teachername }}</p>
                    <p class="review__info">{{ review.title }}</p>
                </div>
            </div>
        </swiper-slide>
        </swiper>

        <ReviewsModal :class="{active: showModal}" :review="review" :currentActiveSlide="currentActiveSlide" v-if="showModal" @close-modal="closeModal"></ReviewsModal>
    </div>
</template>

<script>

import ReviewsModal from './ReviewsModal.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import useNewsStore from '../stores/NewsStore.js'
import 'swiper/css';
    export default {
        props: ['reviews', 'review'],
        components: {Swiper, SwiperSlide, ReviewsModal},
        setup() {

      return {
        modules: [Navigation],
      };
    },

    data() {
        return {
            showModal: false,
            currentActiveSlide: 0
        }
    },

    methods: {
        openModal(id, index) {
            this.currentActiveSlide = id;
            this.showModal = true;
            document.body.style.overflow = 'hidden';
            console.log(id)
            const NewsStore = useNewsStore();
            NewsStore.currentActiveSlide = index
        },

        closeModal() {
            this.showModal = false;
            document.body.style.overflow = 'auto'
        },

    },

    watch: {
        index(value) {
            this.currentActiveSlide = value
        }
    }

    }
</script>
