<template>
    <div>
        <div class="news__block all">
            <div class="all__block" v-for="(item, index) in toBeShow" :key="item.id"
                 @click.prevent="openModalNews(index, item.id)">
                <img src="../../../public/img/new-2.webp" alt="logo">
                <p :class="{'all__title--preview': item.tag === 'Анонсы', 'all__title--event': item.tag === 'Мероприятия', 'all__title--new': item.tag === 'Новости'}"
                   class="all__title all__title--new">Новости</p>
                <button class="all__btn btn-reset" v-if="item.tag == 'Мероприятия'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path
                            d="M18 13.498H13V18.498C13 18.7633 12.8946 19.0176 12.7071 19.2052C12.5196 19.3927 12.2652 19.498 12 19.498C11.7348 19.498 11.4804 19.3927 11.2929 19.2052C11.1054 19.0176 11 18.7633 11 18.498V13.498H6C5.73478 13.498 5.48043 13.3927 5.29289 13.2052C5.10536 13.0176 5 12.7633 5 12.498C5 12.2328 5.10536 11.9785 5.29289 11.7909C5.48043 11.6034 5.73478 11.498 6 11.498H11V6.49805C11 6.23283 11.1054 5.97848 11.2929 5.79094C11.4804 5.6034 11.7348 5.49805 12 5.49805C12.2652 5.49805 12.5196 5.6034 12.7071 5.79094C12.8946 5.97848 13 6.23283 13 6.49805V11.498H18C18.2652 11.498 18.5196 11.6034 18.7071 11.7909C18.8946 11.9785 19 12.2328 19 12.498C19 12.7633 18.8946 13.0176 18.7071 13.2052C18.5196 13.3927 18.2652 13.498 18 13.498Z"
                            fill="white"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                        <path
                            d="M2.33398 14.4993C2.33398 10.0998 2.33398 7.89952 3.70132 6.53335C5.06748 5.16602 7.26782 5.16602 11.6673 5.16602H16.334C20.7335 5.16602 22.9338 5.16602 24.3 6.53335C25.6673 7.89952 25.6673 10.0998 25.6673 14.4993V16.8327C25.6673 21.2322 25.6673 23.4325 24.3 24.7987C22.9338 26.166 20.7335 26.166 16.334 26.166H11.6673C7.26782 26.166 5.06748 26.166 3.70132 24.7987C2.33398 23.4325 2.33398 21.2322 2.33398 16.8327V14.4993Z"
                            stroke="white" stroke-width="2"/>
                        <path d="M8.16797 5.16602V3.41602M19.8346 5.16602V3.41602M2.91797 10.9993H25.0846"
                              stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path
                            d="M21 20.3333C21 20.6428 20.8771 20.9395 20.6583 21.1583C20.4395 21.3771 20.1428 21.5 19.8333 21.5C19.5239 21.5 19.2272 21.3771 19.0084 21.1583C18.7896 20.9395 18.6667 20.6428 18.6667 20.3333C18.6667 20.0239 18.7896 19.7272 19.0084 19.5084C19.2272 19.2896 19.5239 19.1667 19.8333 19.1667C20.1428 19.1667 20.4395 19.2896 20.6583 19.5084C20.8771 19.7272 21 20.0239 21 20.3333ZM21 15.6667C21 15.9761 20.8771 16.2728 20.6583 16.4916C20.4395 16.7104 20.1428 16.8333 19.8333 16.8333C19.5239 16.8333 19.2272 16.7104 19.0084 16.4916C18.7896 16.2728 18.6667 15.9761 18.6667 15.6667C18.6667 15.3572 18.7896 15.0605 19.0084 14.8417C19.2272 14.6229 19.5239 14.5 19.8333 14.5C20.1428 14.5 20.4395 14.6229 20.6583 14.8417C20.8771 15.0605 21 15.3572 21 15.6667ZM15.1667 20.3333C15.1667 20.6428 15.0437 20.9395 14.825 21.1583C14.6062 21.3771 14.3094 21.5 14 21.5C13.6906 21.5 13.3938 21.3771 13.175 21.1583C12.9562 20.9395 12.8333 20.6428 12.8333 20.3333C12.8333 20.0239 12.9562 19.7272 13.175 19.5084C13.3938 19.2896 13.6906 19.1667 14 19.1667C14.3094 19.1667 14.6062 19.2896 14.825 19.5084C15.0437 19.7272 15.1667 20.0239 15.1667 20.3333ZM15.1667 15.6667C15.1667 15.9761 15.0437 16.2728 14.825 16.4916C14.6062 16.7104 14.3094 16.8333 14 16.8333C13.6906 16.8333 13.3938 16.7104 13.175 16.4916C12.9562 16.2728 12.8333 15.9761 12.8333 15.6667C12.8333 15.3572 12.9562 15.0605 13.175 14.8417C13.3938 14.6229 13.6906 14.5 14 14.5C14.3094 14.5 14.6062 14.6229 14.825 14.8417C15.0437 15.0605 15.1667 15.3572 15.1667 15.6667ZM9.33333 20.3333C9.33333 20.6428 9.21042 20.9395 8.99162 21.1583C8.77283 21.3771 8.47609 21.5 8.16667 21.5C7.85725 21.5 7.5605 21.3771 7.34171 21.1583C7.12292 20.9395 7 20.6428 7 20.3333C7 20.0239 7.12292 19.7272 7.34171 19.5084C7.5605 19.2896 7.85725 19.1667 8.16667 19.1667C8.47609 19.1667 8.77283 19.2896 8.99162 19.5084C9.21042 19.7272 9.33333 20.0239 9.33333 20.3333ZM9.33333 15.6667C9.33333 15.9761 9.21042 16.2728 8.99162 16.4916C8.77283 16.7104 8.47609 16.8333 8.16667 16.8333C7.85725 16.8333 7.5605 16.7104 7.34171 16.4916C7.12292 16.2728 7 15.9761 7 15.6667C7 15.3572 7.12292 15.0605 7.34171 14.8417C7.5605 14.6229 7.85725 14.5 8.16667 14.5C8.47609 14.5 8.77283 14.6229 8.99162 14.8417C9.21042 15.0605 9.33333 15.3572 9.33333 15.6667Z"
                            fill="white"/>
                    </svg>
                </button>
                <div class="all__text">
                    <p class="all__descr">{{ item.title }}</p>
                </div>
            </div>
        </div>
        <div class="news__btns">
            <button v-show="totalPage > 1 && currentPage != totalPage" @click.prevent="showMore()"
                    class="btn-reset btn-background">
                Показать больше
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none">
                    <g clip-path="url(#clip0_5060_1102)">
                        <path d="M1.5 5.5L12 16.5L22.5 5.5" stroke="white" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_5060_1102">
                            <rect width="18" height="24" fill="white" transform="matrix(0 1 1 0 0 0.5)"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>

            <button v-show="hiddenBtn" @click="hide()" class="btn-reset btn-outline">
                Скрыть
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none">
                    <g clip-path="url(#clip0_5060_12448)">
                        <path d="M22.5 16.5L12 5.5L1.5 16.5" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_5060_12448">
                            <rect width="18" height="24" fill="white" transform="matrix(0 -1 -1 0 24 18.5)"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>
        </div>
    </div>

</template>

<script>
import NewsModal from './NewsModal.vue';
import useNewsStore from '../stores/NewsStore.js'
import NewsStore from "../stores/NewsStore.js";

export default {
    props: ['filteredNews'],
    components: {NewsModal},
    data() {
        return {
            showModal: false,
            currentPage: 1,
            hiddenBtn: false,
        }
    },

    computed: {
        toBeShow() {
            return this.filteredNews.slice(0, this.currentPage * 10)
        },

        totalPage() {
            return useNewsStore().totalPage
        },

        currentActiveSlide() {
            const NewsStore = useNewsStore()
            return NewsStore.currentActiveSlide
        }
    },

    methods: {
        openModalNews(index, id) {
            const NewsStore = useNewsStore();
            NewsStore.currentActiveSlide = index
            this.$router.push({name: 'newItem', params: {id: id}})
        },

        closeModalNews() {
            this.showModal = false;
            document.body.style.overflow = 'auto';
        },

        async showMore() {
            if (this.currentPage < this.totalPage) {
                this.hiddenBtn = true;
                let res = await NewsStore().ShowMore(++this.currentPage)
                console.log(this.currentPage)
            }
        },

        hide() {
            this.currentPage = this.currentPage -1 || 1
            NewsStore().sliceItem()
        }
    }
}
</script>
