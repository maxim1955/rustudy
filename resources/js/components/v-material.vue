<template>
    <div class="material_wrap">
        <section class="create_material" :class="{'justify-between': isWidthOK}">
            <div id="v-model-select" class="demo" v-if="isWidthOK">
                <div class="" @click="listShow = !listShow" >
                    <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.0013 32.167H6.66797M33.3346 8.83366H28.3346M33.3346 32.167H26.668M21.668 8.83366H6.66797M11.668 20.5003H6.66797M33.3346 20.5003H18.3346"
                            stroke="#056BF0" stroke-width="2" stroke-linecap="round"/>
                        <path
                            d="M26.6667 32.1667C26.6667 30.3257 25.1743 28.8333 23.3333 28.8333C21.4924 28.8333 20 30.3257 20 32.1667C20 34.0076 21.4924 35.5 23.3333 35.5C25.1743 35.5 26.6667 34.0076 26.6667 32.1667Z"
                            stroke="#056BF0" stroke-width="2" stroke-linecap="round"/>
                        <path
                            d="M18.3346 20.4997C18.3346 18.6587 16.8423 17.1663 15.0013 17.1663C13.1604 17.1663 11.668 18.6587 11.668 20.4997C11.668 22.3406 13.1604 23.833 15.0013 23.833C16.8423 23.833 18.3346 22.3406 18.3346 20.4997Z"
                            stroke="#056BF0" stroke-width="2" stroke-linecap="round"/>
                        <path
                            d="M28.3346 8.83366C28.3346 6.99271 26.8423 5.50033 25.0013 5.50033C23.1604 5.50033 21.668 6.99271 21.668 8.83366C21.668 10.6746 23.1604 12.167 25.0013 12.167C26.8423 12.167 28.3346 10.6746 28.3346 8.83366Z"
                            stroke="#056BF0" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <ul v-if="listShow" class="list_filters">
                    <p class="list_title">Выберите уровень владения языком</p>
                    <li
                        v-for="item of levelFilter"
                        :key="item.id"
                        class="list_items">
                        <input type="checkbox" :value="item.value" :id="item.id" v-model="checkedLevelFilter"/>
                        <label :for="item.id" class="activeFilter__label">{{ item.value }}</label>
                    </li>
                    <p class="list_title">Выберите тему учебно-методического материала</p>
                    <li
                        v-for="item of themeFilter"
                        :key="item.id"
                        class="list_items">
                        <input type="checkbox" :value="item.value" :id="item.id" v-model="checkedTheme"/>
                        <label :for="item.id" class="activeFilter__label">{{ item.value }}</label>
                    </li>
                </ul>
            </div>
            <button class="create_material__btn" @click="emit('openModal',true)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"
                     class="create_btn__icon">
                    <path
                        d="M18 13.498H13V18.498C13 18.7633 12.8946 19.0176 12.7071 19.2052C12.5196 19.3927 12.2652 19.498 12 19.498C11.7348 19.498 11.4804 19.3927 11.2929 19.2052C11.1054 19.0176 11 18.7633 11 18.498V13.498H6C5.73478 13.498 5.48043 13.3927 5.29289 13.2052C5.10536 13.0176 5 12.7633 5 12.498C5 12.2328 5.10536 11.9785 5.29289 11.7909C5.48043 11.6034 5.73478 11.498 6 11.498H11V6.49805C11 6.23283 11.1054 5.97848 11.2929 5.79094C11.4804 5.6034 11.7348 5.49805 12 5.49805C12.2652 5.49805 12.5196 5.6034 12.7071 5.79094C12.8946 5.97848 13 6.23283 13 6.49805V11.498H18C18.2652 11.498 18.5196 11.6034 18.7071 11.7909C18.8946 11.9785 19 12.2328 19 12.498C19 12.7633 18.8946 13.0176 18.7071 13.2052C18.5196 13.3927 18.2652 13.498 18 13.498Z"
                        fill="#056BF0"/>
                </svg>
                Предложить материал
            </button>
        </section>
        <div class="" v-if="!activeMaterialShow">
            <section class="material_filter" v-show="isWidthOK === false">
                <p class="material_learn_title">Выберите уровень владения языком </p>
                <div class="material_learn_check">
                    <div v-for="level of levelFilter" :key="level.id">
                        <input type="checkbox" :value="level.value" :id="level.id" v-model="checkedLevel"/>
                        <label :for="level.id" class="material_learn__label">{{ level.value }}</label>
                    </div>
                </div>

                <div class="material_theme">
                    <p class="material_theme__title">Выберите тему учебно-методического материала</p>
                    <div class="material_theme__check">
                        <div class="" v-for="theme of themeFilter" :key="theme.id">
                            <input type="checkbox" :value="theme.value" :id="theme.id" v-model="checkedTheme"/>
                            <label :for="theme.id" class="material_theme__filter">{{ theme.value }}</label>
                        </div>

                    </div>
                </div>
                <div class="clean_filter">
                    <button class="clean_filter__btn" @click="clearFilter">Очистить фильтры</button>
                </div>
            </section>
            <section>
                <div class="material_list">
                    <div class="material_list__first " v-for="(materialItem,index ) of toBeShown" :key="index">
                        <div class="material_list__first" v-if="index === 0">
                            <div class="material_list__first_img">
                                <p class="material_list__first_img_title">{{ materialItem.title }}</p>
                                <img :src="materialItem.img" alt="logo Material" @click="showActiveMaterial(materialItem)"
                                     class="cursor">
                            </div>
                            <div class="material_list__first_text">
                                <p class="material_list__first_date">24.08.2023</p>
                                <p class="material_list__first_subtitle">{{ materialItem.subtitle }}</p>
                                <p class="material_list__first_body">{{ materialItem.body }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="material_list__other_test ">
                        <div class="material_list__other" v-for="(materialItem,index) of toBeShown" :key="index">
                            <div class="" v-if="index !== 0">
                                <div class="material_list__other_img">
                                    <p class="material_list__other_img_title">{{ materialItem.title }}</p>
                                    <img :src="materialItem.img" alt="" @click="showActiveMaterial(materialItem)" class="cursor">
                                </div>
                                <div class="material_list__other_text">
                                    <p class="material_list__first_date">24.08.2023</p>
                                    <p class="material_list__first_subtitle">{{ materialItem.subtitle }}</p>
                                    <p class="material_list__first_body">{{ materialItem.body }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="readNext">
                        <button
                            @click="showMore"
                            :disabled="currentPage === totalPages"
                            class="material_ShowMore"
                            :class=" {disabledBtn: currentPage === totalPages}"
                        >
                            Показать больше
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none">
                                <g clip-path="url(#clip0_4474_8680)">
                                    <path d="M1.5 5.5L12 16.5L22.5 5.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_4474_8680">
                                        <rect width="18" height="24" fill="white" transform="matrix(0 1 1 0 0 0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                        <button
                            @click="showLess"
                            :disabled="currentPage === 1"
                            :class=" {disabledBtn: currentPage === 1}"
                            class="material_ShowLess"
                        >
                            Скрыть
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none">
                                <g clip-path="url(#clip0_4474_12602)">
                                    <path d="M22.5 16.5L12 5.5L1.5 16.5" stroke="#056BF0" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_4474_12602">
                                        <rect width="18" height="24" fill="white" transform="matrix(0 -1 -1 0 24 18.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </div>
        <section class="active_material" v-if="activeMaterialShow">
            <div class="active_material_wrap">
                <div class="active_material_info">
                    <div class="active_material_img">
                        <img :src="activeMaterialInfo.img" alt="Logo" class="img  ">
                        <p class="material_list__first_img_title">{{ activeMaterialInfo.title }}</p>
                    </div>
                    <div class="active_material_text">
                        <p class="active_material_date">{{ activeMaterialInfo.date }}</p>
                        <p class="material_list__first_subtitle">{{ activeMaterialInfo.title }}</p>
                        <p class="material_list__first_body">{{ activeMaterialInfo.body }}</p>
                        <p class="active_material_likes">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path
                                    d="M12.8851 4.981H9.79698V2.86306C9.79698 1.84694 9.49398 1.10934 8.8941 0.671674C7.95144 -0.0200214 6.66905 0.368675 6.61396 0.387038C6.39665 0.454372 6.24668 0.659432 6.24668 0.888977V3.44458C6.24668 5.33603 4.02163 5.99406 3.92675 6.01854C3.92063 6.0216 3.91451 6.0216 3.91145 6.02466L3.65742 6.10424C3.36972 5.83185 2.98408 5.66657 2.56172 5.66657H1.59763C0.71618 5.66351 0 6.37969 0 7.26115V12.758C0 13.6394 0.71618 14.3556 1.59763 14.3556H2.56172C2.96878 14.3556 3.34218 14.2026 3.62375 13.9486C4.02775 14.4291 4.63375 14.7382 5.31014 14.7382H11.566C13.0167 14.7382 13.9808 13.9424 14.1492 12.6111L14.9265 7.72942L14.9694 7.46621C14.9878 7.34378 15 7.2183 15 7.09281C14.9969 5.92978 14.0482 4.981 12.8851 4.981ZM3.10957 12.761C3.10957 13.064 2.86472 13.3089 2.56172 13.3089H1.59763C1.29463 13.3089 1.04979 13.064 1.04979 12.761V7.26115C1.04979 6.95815 1.29463 6.7133 1.59763 6.7133H2.56172C2.86472 6.7133 3.10957 6.95815 3.10957 7.26115V12.761ZM13.9319 7.30399L13.1116 12.458C13.1116 12.4642 13.1085 12.4703 13.1085 12.4764C13.0718 12.7763 12.9616 13.6915 11.566 13.6915H5.31014C4.6766 13.6915 4.15936 13.1742 4.15936 12.5407V7.26115C4.15936 7.19075 4.15323 7.12036 4.14405 7.04996L4.22057 7.02548C4.44399 6.96121 7.29647 6.08588 7.29647 3.44152V1.32052C7.59947 1.28992 7.99735 1.31134 8.27586 1.51946C8.58804 1.75207 8.74719 2.20197 8.74719 2.86306V5.50742C8.74719 5.79818 8.98286 6.03385 9.27362 6.03385H12.8851C13.4728 6.03385 13.9472 6.5113 13.9472 7.09587C13.9472 7.16321 13.941 7.2336 13.9319 7.30399Z"
                                    fill="#0A2B49"/>
                            </svg>
                            {{ activeMaterialInfo.likes || 0 }}
                        </p>
                        <button class="active_download">Скачать</button>
                    </div>
                    <div class="active_material_reviews">
                        <p class="active_material_reviews_title">Оставьте свой отзыв</p>
                        <div class="active_material_reviews_logo">
                            <div class="active_material_reviews_logo_img">
                                <img src="public/img/material/avatar.svg" alt="avatar" width="100%">
                            </div>
                            <form class="active_material_reviews__form">
                                <input type="text" class="active_material_reviews__input">
                                <button type="submit" class="active_material_reviews__form__btn">Опубликовать</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="active_material_list">
                    <div class="active_material_list_item" v-for="materialItem of materialList" :key="materialItem.id"
                         :class="{active_material_show: activeMaterialInfo.id === materialItem.id}">
                        <div class="active_material_list__img cursor " @click="showActiveMaterial(materialItem)">
                            <img :src="'../../public/img/material/' + materialItem.img" alt="Logo" class="img">

                            <p class="active_material_list_item__title">{{ materialItem.title }}</p>
                        </div>
                        <div class="active_material_list__text">
                            <p class="active_material_list___title">{{ materialItem.title }}</p>
                            <p class="active_material_list___body">{{ materialItem.body }}</p>
                            <p class="active_material_list___date">{{ materialItem.date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


<script setup>
import {computed, onMounted, ref} from "vue";

const props = defineProps({})
const emit = defineEmits(['openModal'])
const showModal = () => {

}


/*------- Active Material --------------*/

const activeMaterialShow = ref(false)
const activeMaterialInfo = ref({
    id: 0,
    title: '',
    subtitle: '',
    img: '',
    body: '',
    date: '',
    likes: '',
})
const showActiveMaterial = (activeMaterial) => {
    console.log(activeMaterial)
    activeMaterialInfo.value = {
        id: activeMaterial.id,
        title: activeMaterial.title,
        subtitle: activeMaterial.subtitle,
        img: activeMaterial.img,
        body: activeMaterial.body,
        date: activeMaterial.date,
        likes: activeMaterial.likes,
    }
    activeMaterialShow.value = true
}
const clearFilter = () => {
    checkedLevel.value = []
    checkedTheme.value = []
}
const checkedTheme = ref([])
const checkedLevel = ref([])
const checkedLevelFilter = ref([])
const levelFilter = [
    {id: 0, value: 'A1',},
    {id: 1, value: 'A2',},
    {id: 2, value: 'B1',},
    {id: 3, value: 'B2',},
    {id: 4, value: 'C1',},
]
const themeFilter = [
    {id: 6, value: 'Алфавит'},
    {id: 11, value: 'Местоимение'},
    {id: 21, value: 'Прилагательное'},
    {id: 31, value: 'Глагол'},
    {id: 41, value: 'Числительное'},
    {id: 51, value: 'Наречие'},
    {id: 61, value: 'Синтаксис'},
    {id: 71, value: 'Глаголы движения'},
    {id: 81, value: 'Глаголы служебные'},
]
const materialList = [
    {
        id: 0,
        title: 'Новый учебник по РКИ какой он должен быть',
        subtitle: 'Новый учебник по РКИ какой он должен быть',
        img: '../img/material/material-7.png',
        body: 'Вебинар «Новый учебник по РКИ: какой он должен быть?»' +
            'Цель: экспертная поддержка разработки и апробации учебно-методического обеспечения Задачи: определение стратегических ориентиров в разработке учебного пособия, ознакомление с особенностями и преимуществами разработки, консультация разработчиков, ответы на вопросы участников апробации, обратная связь участников по материалам апробации. Участники апробации УМО из Австрии, Франции, Вьетнама, Словении, Словакии.',
        date: '24.08.23',
        likes: ''
    },
    {
        id: 1,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-1.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка.',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 2,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-2.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 3,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-3.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 4,
        title: 'Модель Здравствуйте Привет',
        subtle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-4.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 6,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-5.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 5,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-6.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 7,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-2.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 8,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-5.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 9,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-1.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
    {
        id: 10,
        title: 'Модель Здравствуйте Привет',
        subtitle: 'Модель Здравствуйте Привет',
        img: '../img/material/material-4.png',
        body: 'Отмечается, что фонд создаётся с целью представления в виртуальном пространстве информации о нормах современного русского литературного языка. ',
        date: '24.08.23',
        likes: '',
    },
]
const listShow = ref(false)
const isWidthOK = ref(false)
onMounted(() => {
    const mql = window.matchMedia('(max-width: 1100px)');
    const onChange = () => isWidthOK.value = mql.matches;
    onChange();
    mql.addEventListener('change', onChange);
})


/* ---- Show more ------*/
const currentPage = ref(1);
const toBeShown = computed(() => {
    return materialList.slice(0, currentPage.value * 5);
})
const totalPages = computed(() => {
    return Math.ceil(materialList.length / 7)
})
const showMore = () => {
    if (currentPage.value < totalPages.value) currentPage.value++;
}
const showLess = () => {
    currentPage.value = currentPage.value - 1 || 1
}
/*
* ************************** list item ***************************
*/
let isActiveFilter = ref(false)
let toggleClass = () => {
    isActiveFilter.value = !isActiveFilter.value
}
</script>
<style>
@import "../../../public/css/modalCreateMaterial.css";
</style>


