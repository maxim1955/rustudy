<template>
    <div id="news" class="modal__offer modal-news">
        <router-link to="/news" class="btn-reset btn-close"></router-link>
        <div class="modal__overlay">
            <div class="modal__window">
                <swiper class="modal-slider"
                :modules="modules"
                :slides-per-view="1"
                :navigation="{
                    prevEl: prev,
                    nextEl: next,
                }"
                @swiper="onSwiper"
                :allowTouchMove="false"
                >

                {{ this.$route.params.type }}
                <swiper-slide class="new" v-for="item in filteredNews" :key="item.id" :id="item.id">
                    <div class="new__block">

                        <!-- <div class="new__left" v-if="item.video != ''">
                            <p :class="{'new__tag--preview': item.tag == 'Анонсы', 'new__tag--event': item.tag == 'Мероприятия', 'new__tag--new': item.tag == 'Новости'}" class="new__tag">{{ item.tag }}</p>
                            <iframe width="100%" height="900" :src="item.video"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                        </div> -->
                        <div class="new__left">
                            <p v-if="activeTab == 'news'" :class="{'all__title--preview': item.type === 'activity', 'all__title--event': item.type === 'event', 'all__title--new': item.type === 'publication'}"
                            class="all__title">
                                <span v-if="item.type === 'activity'">Анонсы</span>
                                <span v-else-if="item.type === 'publication'">Новости</span>
                                <span v-else-if="item.type === 'event'">Мероприятия</span>
                            </p>
                            <p v-else-if="activeTab == 'publications'" class="all__title--new all__title">Новости</p>
                            <p v-else-if="activeTab == 'events'" class="all__title--event all__title">Мероприятия</p>
                            <p v-else-if="activeTab == 'activities'" class="all__title--preview all__title">Анонсы</p>

                            {{ type }}
                            <img :src="'storage/'+item.img_path" :alt="item.title">
                        </div>


                    <div class="new__right">
                        <div class="new__btns">
                            <!-- <button class="btn-reset btn-background">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                <path d="M18 13.498H13V18.498C13 18.7633 12.8946 19.0176 12.7071 19.2052C12.5196 19.3927 12.2652 19.498 12 19.498C11.7348 19.498 11.4804 19.3927 11.2929 19.2052C11.1054 19.0176 11 18.7633 11 18.498V13.498H6C5.73478 13.498 5.48043 13.3927 5.29289 13.2052C5.10536 13.0176 5 12.7633 5 12.498C5 12.2328 5.10536 11.9785 5.29289 11.7909C5.48043 11.6034 5.73478 11.498 6 11.498H11V6.49805C11 6.23283 11.1054 5.97848 11.2929 5.79094C11.4804 5.6034 11.7348 5.49805 12 5.49805C12.2652 5.49805 12.5196 5.6034 12.7071 5.79094C12.8946 5.97848 13 6.23283 13 6.49805V11.498H18C18.2652 11.498 18.5196 11.6034 18.7071 11.7909C18.8946 11.9785 19 12.2328 19 12.498C19 12.7633 18.8946 13.0176 18.7071 13.2052C18.5196 13.3927 18.2652 13.498 18 13.498Z" fill="white"/>
                                </svg>
                                Добавить в календарь
                            </button> -->
                            <button class="btn-reset btn-outline" @click="openModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="21" viewBox="0 0 25 21" fill="none">
                                <path d="M0 20.5H2.08322C2.08542 18.9147 2.85431 17.3949 4.22121 16.274C5.58811 15.153 7.44139 14.5225 9.37447 14.5207H14.4054V19.9994L24.0851 12.0615C24.6709 11.5809 25 10.9292 25 10.2497C25 9.57022 24.6709 8.91854 24.0851 8.43799L14.4054 0.5V5.97877H9.37447C6.88905 5.98103 4.50622 6.79171 2.74876 8.23295C0.991306 9.67418 0.00275803 11.6283 0 13.6665V20.5ZM16.4887 4.62403L22.6123 9.64581C22.8075 9.80599 22.9172 10.0232 22.9172 10.2497C22.9172 10.4762 22.8075 10.6934 22.6123 10.8536L16.4887 15.8754V12.8123H9.37447C7.97575 12.8122 6.59479 13.0691 5.33304 13.5642C4.07129 14.0592 2.96082 14.7798 2.08322 15.673V13.6665C2.08542 12.0812 2.85431 10.5614 4.22121 9.44046C5.58811 8.31951 7.44139 7.68896 9.37447 7.68715H16.4887V4.62403Z" fill="#056BF0"/>
                                </svg>
                                Поделиться
                            </button>

                            <ShareModal @close-modal="closeModal()" :item="item" v-show="showModal"></ShareModal>
                        </div>
                        <div class="new__text">
                            <p class="new__title">{{ item.title }}</p>
                            <p class="new__desc" v-html="item.content"></p>
                        </div>

                    </div>
                </div>
                </swiper-slide>
                </swiper>
                <div @click="prevSlide()" ref="prev" class="swiper-button-prev"></div>
                <div @click="nextSlide()" ref="next" class="swiper-button-next"></div>

            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import { watch } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import ShareModal from './ShareModal.vue';
import useNewsStore from '@/stores/NewsStore.js';
import newsStore from "@/stores/NewsStore.js";
    export default {
        components: {Swiper, SwiperSlide, ShareModal},
        // props: ['type'],
        data() {
            return {
                showModal: false,
                type: null
            }
        },

        computed: {

            activeTab() {
                return useNewsStore().activeTab;
            },

            filteredNews() {
              if (newsStore().activeTab === 'news') return newsStore().allNew
              if (newsStore().activeTab === 'activities') return newsStore().activity
              if (newsStore().activeTab === 'publications') return newsStore().publication
              if (newsStore().activeTab === 'events') return newsStore().event
            },

            currentActiveSlide() {
                const NewsStore = useNewsStore()
                return NewsStore.currentActiveSlide
            }
        },

        setup() {
            const prev = ref(null);
            const next = ref(null);
            const onSwiper = (swiper) => {
                const NewsStore = useNewsStore();
                // NewsStore.currentActiveSlide
                swiper.activeIndex = NewsStore.currentActiveSlide
                console.log(swiper.activeIndex)
            };

            return {
                onSwiper,
                prev,
                next,
                modules: [Navigation],
            };

        },

        methods: {
            openModal() {
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            nextSlide() {
                const slides = document.querySelector('.swiper-slide-next');
                if (slides) {
                    const id = slides.getAttribute('id');
                    window.history.replaceState('page2', 'Title', `/news/${id}`);
                }

            },

            prevSlide() {
                const slides = document.querySelector('.swiper-slide-prev');
                if (slides) {
                    const id = slides.getAttribute('id');
                    window.history.replaceState('page2', 'Title', `/news/${id}`);
                }

            },

        },

        // created() {
        //     console.log(this.$route.params.type)
        //     this.type = this.$route.params.type;
        // }

        // mounted() {
        //     const NewsStore = useNewsStore();
        //     newsStore().getNew();
        // }
    }
</script>
