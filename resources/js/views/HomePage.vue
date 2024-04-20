<template>
    <div>
        <Header></Header>
        <main>
            <div class="container title">
                <h1 class="title__text">Информационный портал для преподавателей РКИ</h1>
            </div>
            <section class="container promo flex">
                <div class="promo-left flex">
                    <div class="promo-top">
                        <div class="card-content">
                            <h2 class="card-title">Привет, Россия!</h2>
                            <p class="card-text">Обучение русскому языку как&nbsp;иностранному</p>
                            <p class="card-info">печатные и онлайн учебники</p>

                            <picture>
                                <source srcset="img/books_tablet.png" media="(max-width: 1415px)">
                                <img class="card-img_desktop" src="img/books_desktop.png"
                                     alt='Учебники "Привет, Россия!"'>
                            </picture>
                        </div>
                        <router-link :to="{ name: 'book' }" class="promo__btn btn btn-reset">Подробнее</router-link>
                    </div>
                    <a target="_blank" href="https://kurs.rus.study/" class="promo-bottom">
                        <div class="bottom_content card-content">
                            <h2 class="card-title">Курсы для педагогов</h2>
                            <p class="card-text card-width">Повышение квалификации РКИ</p>
                        </div>
                        <svg class="bottom__arrow" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L22.6667 22.6667M22.6667 22.6667V1.86667M22.6667 22.6667H1.86667"
                                  stroke="white"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                </div>

                <router-link to="/service" class="promo-center">
                    <div class="card-content center_content">
                        <h2 class="card-title">Сервисы РКИ</h2>
                        <ul class="card-list list-reset">
                            <li class="card-text card-item">учебно-методические материалы</li>
                            <li class="card-text card-item">игры, тесты, карточки</li>
                            <li class="card-text card-item">видеоуроки</li>
                        </ul>
                    </div>
                    <svg class="center_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L22.6667 22.6667M22.6667 22.6667V1.86667M22.6667 22.6667H1.86667" stroke="white"
                              stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </router-link>

                <div class="promo-right">
                    <h2 class="card-title card-name">Афиша</h2>

                    <!-- Слайдер -->

                    <Swiper navigation :pagination="{ clickable: true }" :modules="modules">
                        <swiper-slide v-for="item in affiche" :key="item.id">
                            <picture>
                                <source :srcset="item.phone" media="(max-width: 576px)">
                                <source :srcset="item.tablet" media="(max-width: 1180px)">
                                <img class="right-background" :src="item.image" alt="Курсы для педагогов">
                            </picture>
                        </swiper-slide>
                    </Swiper>

                    <a class="card-link flex" href="/news">
                        Все новости
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L22.6667 22.6667M22.6667 22.6667V1.86667M22.6667 22.6667H1.86667"
                                  stroke="white"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </section>

            <section class="container subscription">
                <div class="subscription__content flex">
                    <h3 class="subscription__text">Хотите быть в&nbsp;курсе наших мероприятий, новостей
                        и&nbsp;обновлений? Подпишитесь на&nbsp;рассылку
                        и&nbsp;станьте частью нашего образовательного сообщества.</h3>

                    <Form @InvalidSubmit="onInvalidSubmit" id="form" class="form flex">
                        <div>
                            <span class="form_name form__text">E-mail</span>
                            <label class="form_item flex">
                                <button class="modal__btn hidden" @click.prevent="clearInput"></button>
                                <Field id="emailForma" type="email" name="email" placeholder="Введите E-mail"
                                       class="form__input" :class="{'error-input': errorEmail}"
                                       @input="inputChange" v-model="email" :rules="validateEmail"/>
                                <span v-show="errorEmail" class="error-icon"></span>
                                <ErrorMessage class="form__error" name="email"/>


                            </label>
                        </div>

                        <button class="btn-reset btn form-btn" type="submit">Подписаться</button>
                        <p class="form_agree">Нажимая на&nbsp;кнопку &laquo;Подписаться&raquo;, я&nbsp;даю своё согласие на&nbsp;обработку
                            <a class="form_link"
                               href="docs/политика_обработки_ПДн_на_сайте_учебник.pdf"
                               target="_blank">персональных данных
                            </a>
                        </p>
                    </Form>
                </div>
            </section>

            <section class="container partners flex">
                <Swiper navigation
                        :modules="modules"
                        class="partners__list flex"
                        :slides-per-view="6"
                        :space-between="20"
                        :breakpoints="{
                            320: { slidesPerView: 2 },
                            576: { slidesPerView: 3 },
                            950: { slidesPerView: 6 },
                            }">
                    <swiper-slide v-for="partner of partners  " :key="partner.id" class="partners_slide">
                        <div class="partners__item">
                            <a class="partners__link flex"
                               :href="partner.link"
                               target="_blank">
                                <img :src="'storage/'+partner.photo_path" alt="Обрсоюз">
                            </a>
                        </div>
                    </swiper-slide>
                </Swiper>
            </section>
        </main>
        <Footer/>
    </div>
</template>
<script>

import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination} from 'swiper/modules';
import {Form, Field, ErrorMessage} from 'vee-validate';

import {getPartners} from "../dbquery/getPartners";
import {useHead} from "unhead";


export default {
    name: 'HomePage',
    components: {Header, Footer, Swiper, SwiperSlide, Form, Field, ErrorMessage},

    data() {
        return {
            email: '',
            errorEmail: false,
            affiche: [
                {
                    id: 1,
                    image: 'img/card-right.webp',
                    tablet: 'img/right-card-tablet.webp',
                    phone: 'img/right-card-mobile.webp'
                },
                {
                    id: 2,
                    image: 'img/card-right.webp',
                    tablet: 'img/right-card-tablet.webp',
                    phone: 'img/right-card-mobile.webp'
                },

            ],

            partners: [
               /* {
                    id: 1,
                    image: 'img/обрсоюз.png',
                    link: 'http://obr.so/',
                },
                {
                    id: 2,
                    image: 'img/partner.png',
                    link: 'http://amities-russes.jimdofree.com/',
                },
                {
                    id: 3,
                    image: 'img/partner_szkola.png',
                    link: '#',
                },
                {
                    id: 4,
                    image: 'img/РКИ today.png',
                    link: 'http://www.rki.today/?m=1',
                },
                {
                    id: 5,
                    image: 'img/арбат.png',
                    link: 'http://www.arbat.gr/',
                },
                {
                    id: 6,
                    image: 'img/диктант.png',
                    link: 'http://totaldict.ru/',
                },
                {
                    id: 7,
                    image: 'img/диктант.png',
                    link: 'http://totaldict.ru/',
                },
                {
                    id: 8,
                    image: 'img/диктант.png',
                    link: 'http://totaldict.ru/',
                },
                {
                    id: 9,
                    image: 'img/диктант.png',
                    link: 'http://totaldict.ru/',
                },*/

            ]
        }
    },

    setup() {
        return {
            modules: [Navigation, Pagination],
        };
    },

    methods: {

        inputChange(e) {
            const btn = e.target.previousSibling;

            if (e.target.getAttribute('name') == 'email') {
                this.errorEmail = false
            }

            if (e.target.value != '') {
                btn.classList.remove('hidden')

            } else btn.classList.add('hidden')
        },

        clearInput(e) {
            this.email = '';
            e.target.classList.add('hidden');
            if (this.email == '') {
                this.errorEmail = true
            }
        },

        onInvalidSubmit(e) {
            if (e.errors) {
                this.errorEmail = true
            }
        },


        validateEmail(value) {
            if (!value) {
                return 'Введите E-mail!';
            }
            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return 'Введите корректный E-mail!';
            }

            return true;
        },

    },
    mounted() {
        let getPartnersDb = async () => {
/*
            axios.get('news')
*/
            try {
                let partners = await getPartners();
                console.log(partners) // Надо проверить что приходит и опдставить правильные данные
                this.partners = partners.data

                console.log('Data from API:', this.partners);
            } catch (error) {
                console.log(error)
            }
        }
        getPartnersDb()

        useHead({
            title: 'Обучение русскому как иностранному | Привет, Россия! | Rus.Study',
            meta: [
                {
                    name: 'title',
                    content: 'Обучение русскому как иностранному | Привет, Россия! | Rus.Study'
                },
                {
                    name: 'keywords',
                    content: 'Rus.Study, рки, Привет, Россия, русский язык как иностранный, учебники, уроки РКИ, преподавание русского языка как иностранного, преподаватели рки, онлайн, A1, B1, C1, учебник русского языка для иностранцев'
                },
                {
                    name: 'description',
                    content: 'Готовые уроки русского языка как иностранного (РКИ) всех уровней (А1-С2). Учебные и методические материалы, тесты, видео, новости, мероприятия, курсы для учителей.'
                }
            ],

        })

    },
}

</script>
<style>
</style>
