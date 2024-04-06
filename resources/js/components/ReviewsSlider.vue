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
        <swiper-slide class="review" v-for="review in reviews" :key="review.id" @click.prevent="openModal(review.id)">
            <div class="review__card">
                <picture>
                    <source :srcset="review.tablet" media="(max-width:1024px)">
                    <img class="review__image" :src="review.image" :alt="review.name">                    
                </picture>
                <div class="review__block">
                    <img class="" :src="review.image" alt="">
                    <p class="review__name">{{ review.name }}</p>
                    <p class="review__info">{{ review.info }}</p>
                </div>
            </div>
        </swiper-slide>
        </swiper>

        <ReviewsModal :class="{active: showModal}" :reviews="reviews" :currentActiveSlide="currentActiveSlide" v-show="showModal" @close-modal="closeModal"></ReviewsModal>
    </div>
</template>

<script>

import ReviewsModal from './ReviewsModal.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
    export default {
        props: ['reviews'],
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
        openModal(id) {
            this.currentActiveSlide = id;
            this.showModal = true;
            document.body.style.overflow = 'hidden';
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