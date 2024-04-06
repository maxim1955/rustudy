<template>
  <div class=" service_item_mob">
    <Swiper slides-per-view="auto">
      <swiper-slide
          v-for="(item,index ) of serviceName"
          :key="index"
          :class="{active_tab: item.name === props.selected_service.name}"
          @click="emit('changeServiceTabs',item)"
          class=""
      >
        <router-link :to="service/item.label">
          <span>{{ item.label }}</span>
        </router-link>
      </swiper-slide>
    </Swiper>
  </div>
  <div class="service_item__wrap">
    <div class="service_item__label">
        <span
            v-for="item of serviceName"
            @click="emit('changeServiceTabs',item)"
            class="service_item"
            :class="{active_tab: item.name === props.selected_service.name}"
        >
       <router-link :to="{name: item.name}">
          <span>{{ item.label }}</span>
        </router-link>


        </span>
    </div>
  </div>

</template>
<script setup>

// Import Swiper Vue.js components
import {Swiper, SwiperSlide} from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/navigation';


// import required modules
import {Navigation, Pagination} from 'swiper/modules';
import router from "@/router";


const props = defineProps({
  serviceName: {
    type: Array,
    required: true,
  },
  selected_service: {
    type: Object,
    required: true,
  }
})

const emit = defineEmits(["changeServiceTabs"])
/*Slick slider */
const modules = [Navigation, Pagination]


</script>
<style scoped>
.active_tab {
  text-decoration: underline;
}

/* Стили для листающегося списка по горизонтали */
.swiper {
  max-width: 100%;
  margin: 0 auto;
}

.swiper-slide {
  padding: 12px;
  margin: 40px 20px 40px;;
  color: #0A2B49;
  cursor: pointer;
  width: fit-content !important;
  text-align: center;
  font-size: 18px;
  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}


</style>
