<template>
    <div>
        <div v-show="!newsLoading || !loaderValue" class="loader-block">
            <span class="loader"></span>
        </div>
        <Header></Header>

        <main>

            <div class="container">
                    <router-link to="/" class="back">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.47007 11.4702C3.32962 11.6108 3.25073 11.8014 3.25073 12.0002C3.25073 12.1989 3.32962 12.3895 3.47007 12.5302L9.47007 18.5302C9.53873 18.6038 9.62153 18.6629 9.71353 18.7039C9.80553 18.7449 9.90485 18.767 10.0056 18.7687C10.1063 18.7705 10.2063 18.752 10.2997 18.7143C10.3931 18.6766 10.4779 18.6204 10.5491 18.5492C10.6203 18.478 10.6765 18.3931 10.7142 18.2998C10.7519 18.2064 10.7704 18.1063 10.7687 18.0056C10.7669 17.9049 10.7448 17.8056 10.7039 17.7136C10.6629 17.6216 10.6038 17.5388 10.5301 17.4702L5.81007 12.7502H20.0001C20.199 12.7502 20.3898 12.6711 20.5304 12.5305C20.6711 12.3898 20.7501 12.1991 20.7501 12.0002C20.7501 11.8012 20.6711 11.6105 20.5304 11.4698C20.3898 11.3292 20.199 11.2502 20.0001 11.2502H5.81007L10.5301 6.53015C10.6038 6.46149 10.6629 6.37869 10.7039 6.28669C10.7448 6.19469 10.7669 6.09538 10.7687 5.99468C10.7704 5.89397 10.7519 5.79394 10.7142 5.70056C10.6765 5.60717 10.6203 5.52233 10.5491 5.45112C10.4779 5.3799 10.3931 5.32375 10.2997 5.28603C10.2063 5.24831 10.1063 5.22979 10.0056 5.23156C9.90485 5.23334 9.80553 5.25538 9.71353 5.29637C9.62153 5.33736 9.53873 5.39647 9.47007 5.47015L3.47007 11.4702Z" fill="#0A2B49" fill-opacity="0.6"></path></svg>
                        Вернуться назад</router-link>
            </div>
            <section class="news">
                <div class="container">
                    <div class="title-block"><h1 class="title news__title">Анонсы и новости</h1></div>
                    <div class="news__top">
                    <ul class="news__tabs tabs list-reset">
                        <li v-for="tab in tabs" :key="tab.id" class="tabs__item" @click.prevent="changeTab(tab.component)" :class="{active: activeTab == tab.component}">
                            <a href="" class="tabs__link">{{ tab.name }}</a>
                        </li>
                    </ul>
                    <button @click.prevent="openModal()" class="btn-reset news__btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M18 13.498H13V18.498C13 18.7633 12.8946 19.0176 12.7071 19.2052C12.5196 19.3927 12.2652 19.498 12 19.498C11.7348 19.498 11.4804 19.3927 11.2929 19.2052C11.1054 19.0176 11 18.7633 11 18.498V13.498H6C5.73478 13.498 5.48043 13.3927 5.29289 13.2052C5.10536 13.0176 5 12.7633 5 12.498C5 12.2328 5.10536 11.9785 5.29289 11.7909C5.48043 11.6034 5.73478 11.498 6 11.498H11V6.49805C11 6.23283 11.1054 5.97848 11.2929 5.79094C11.4804 5.6034 11.7348 5.49805 12 5.49805C12.2652 5.49805 12.5196 5.6034 12.7071 5.79094C12.8946 5.97848 13 6.23283 13 6.49805V11.498H18C18.2652 11.498 18.5196 11.6034 18.7071 11.7909C18.8946 11.9785 19 12.2328 19 12.498C19 12.7633 18.8946 13.0176 18.7071 13.2052C18.5196 13.3927 18.2652 13.498 18 13.498Z"/>
                    </svg>
                    Предложить новость</button>
                    </div>
                        <News @loader="loaderValue" :filteredNews="filteredNews"></News>



                </div>

                <offer-news-modal  v-if="showModal" @close-modal="closeModal"/>
            </section>

        </main>
        <Footer></Footer>
    </div>
</template>

<script>

// import useNewsStore from '@/stores/NewsStore.js'
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
import News from '@/components/News.vue';
import OfferNewsModal from '../components/OfferNewsModal.vue';
import { useHead } from "unhead";
import VCreateMaterial from "@/components/v-create-material.vue";
import newsStore from "@/stores/NewsStore.js";

    export default {
        components: {VCreateMaterial, Header, Footer, News, OfferNewsModal},
        data() {
            return {
                tabs: [
                    {
                        id: 1,
                        name: 'Все',
                        component: 'news',
                    },
                    {
                        id: 2,
                        name: 'Анонсы',
                        component: 'activities',
                    },
                    {
                        id: 3,
                        name: 'Новости',
                        component: 'publications',
                    },
                    {
                        id: 4,
                        name: 'Мероприятия',
                        component: 'events',
                    },
                ],
                showModal: false,
                newsLoading: false,
            }
        },

        computed: {

            activeTab() {
                return newsStore().activeTab
            },

            filteredNews() {
              if (newsStore().activeTab === 'news') return newsStore().allNews
              if (newsStore().activeTab === 'activities') return newsStore().activities
              if (newsStore().activeTab === 'publications') return newsStore().publications
              if (newsStore().activeTab === 'events') return newsStore().events
            },

        },

        methods: {
            changeTab(component) {
                this.activeTab = component;
                newsStore().activeTab = component;

                if (this.activeTab == 'activities') {
                    this.newsLoading = false;
                    newsStore().fetchActivities().then(() => {
                        this.newsLoading = true;
                    });

                } else
                if (this.activeTab == 'events') {
                    this.newsLoading = false;
                    newsStore().fetchEvents().then(() => {
                        this.newsLoading = true;
                    });
                } else
                if (this.activeTab == 'publications') {
                    this.newsLoading = false;
                    newsStore().fetchNews().then(() => {
                        this.newsLoading = true;
                    });
                } else
                if (this.activeTab == 'news') {
                    this.newsLoading = false;
                    newsStore().fetchAllNews().then(() => {
                        this.newsLoading = true;
                    });
                }


            },

            openModal() {
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            loaderValue(value) {
                this.newsLoading = value
                console.log(value)
            }

        },

        mounted() {
            this.newsLoading = false;
            newsStore().fetchAllNews().then(() => {
                this.newsLoading = true;
            });
            useHead({
                title: 'Актуальные события и новости в РКИ | Rus.Study',
                meta: [
                    {
                    name: 'title',
                    content: 'Актуальные события и новости в РКИ | Rus.Study'
                    },
                    {
                    name: 'keywords',
                    content: 'актуальные события, новости РКИ, новые технологии, открытия в образовании, акции, скидки, культурные мероприятия, международная конференция, научно-практическая конференция'
                    },
                    {
                    name: 'description',
                    content: 'Самое интересное и актуальное в мире РКИ: новые технологии и открытия в образовании, культурные мероприятия, научно-практические конференции, конкурсы, акции и скидки'
                    }
                ],

    })
        }


    }
</script>


