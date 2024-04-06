<template>
       <swiper 
       :space-between="20" 
       :modules="modules" 
       navigation 
       :slides-per-view="4" class="authors-slider" 
       @swiper="onSwiper" 
       @slideChange="onSlideChange"
       :breakpoints="{
            320:{ slidesPerView:1 },
            769:{ slidesPerView:2.5 },
            1025:{ slidesPerView:4 },
        }"
        >
    
        <swiper-slide class="author" v-for="author in authors" :key="author.id" :authors="authors">
        <div class="author__content">
          <img class="author__img" :src="author.url" :alt="author.name">
          <p class="author__name">{{ author.name }}</p>
          <p class="author__info">{{ author.info }}</p>
        </div>
    </swiper-slide>
        </swiper>
</template>

<script>

import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules';
import 'swiper/css';
    export default {
        props: ['authors'],
        components: {Swiper, SwiperSlide},
        setup() {
      const onSwiper = (swiper) => {
        // console.log(swiper);
      };
      const onSlideChange = () => {
        // console.log('slide change');
      };
      return {
        onSwiper,
        onSlideChange,
        modules: [Navigation],
      };
    },

    }
</script>