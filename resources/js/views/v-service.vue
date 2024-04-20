<template>
    <v-create-material
        v-if="createMaterial"
        @closemodal="createMaterial=!createMaterial"
    >
    </v-create-material>
    <div class="container " v-if="!createMaterial">
        <Header/>
        <div class="container">
            <button @click="returnToBack" class="back">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M3.47007 11.4702C3.32962 11.6108 3.25073 11.8014 3.25073 12.0002C3.25073 12.1989 3.32962 12.3895 3.47007 12.5302L9.47007 18.5302C9.53873 18.6038 9.62153 18.6629 9.71353 18.7039C9.80553 18.7449 9.90485 18.767 10.0056 18.7687C10.1063 18.7705 10.2063 18.752 10.2997 18.7143C10.3931 18.6766 10.4779 18.6204 10.5491 18.5492C10.6203 18.478 10.6765 18.3931 10.7142 18.2998C10.7519 18.2064 10.7704 18.1063 10.7687 18.0056C10.7669 17.9049 10.7448 17.8056 10.7039 17.7136C10.6629 17.6216 10.6038 17.5388 10.5301 17.4702L5.81007 12.7502H20.0001C20.199 12.7502 20.3898 12.6711 20.5304 12.5305C20.6711 12.3898 20.7501 12.1991 20.7501 12.0002C20.7501 11.8012 20.6711 11.6105 20.5304 11.4698C20.3898 11.3292 20.199 11.2502 20.0001 11.2502H5.81007L10.5301 6.53015C10.6038 6.46149 10.6629 6.37869 10.7039 6.28669C10.7448 6.19469 10.7669 6.09538 10.7687 5.99468C10.7704 5.89397 10.7519 5.79394 10.7142 5.70056C10.6765 5.60717 10.6203 5.52233 10.5491 5.45112C10.4779 5.3799 10.3931 5.32375 10.2997 5.28603C10.2063 5.24831 10.1063 5.22979 10.0056 5.23156C9.90485 5.23334 9.80553 5.25538 9.71353 5.29637C9.62153 5.33736 9.53873 5.39647 9.47007 5.47015L3.47007 11.4702Z"
                          fill="#0A2B49" fill-opacity="0.6"/>
                </svg>
                Вернуться назад
            </button>
        </div>
        <h4 class="service_title">{{ (selectedService.title) ? selectedService.title : selectedService.label }}</h4>
        <div class="flex serv">
            <div class="service_item_mob">
                <v-service-tabs :service-name="serviceName"
                                :selected_service="selectedService"
                                @changeServiceTabs="changeServiceName"/>
            </div>
            <div class="service_wrap ">
                <p class="service_nav_title">Сервисы РКИ</p>
                <v-service-tabs
                    :service-name="serviceName"
                    :selected_service="selectedService"
                    @changeServiceTabs="changeServiceName"
                >
                </v-service-tabs>
            </div>
            <div class="service_wrap_second">
                <div class=""
                     v-if="selectedService.name === 'material' || selectedService.name === 'materialMaterial' ">
                    <router-view @openModal="createMaterial = !createMaterial" :activeMaterialInfo="activeMaterialInfo"/>
                </div>
                <div class="" v-if="selectedService.name==='game'">
                    <router-view></router-view>
                </div>
                <div class="test_box__wrap" v-if="selectedService.name==='Tests'">
                    <test v-for="item of tests"
                          :nameTest="item" :key="item.id"
                    >
                    </test>
                </div>
                <div class="" v-if="selectedService.name==='Teacher'">Teacher</div>
                <div class="" v-if="selectedService.name==='Vacancy'">Vacancy</div>
                <div class="" v-if="selectedService.name==='Course'">Course</div>
                <div class="" v-if="selectedService.name==='kalinka'">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
    <Footer v-if="!createMaterial"/>
</template>
<script setup>
import VServiceTabs from "@/components/v-service-tabs.vue";
import {ref, watch} from "vue";
import Test from "@/components/v-test.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import VCreateMaterial from "@/components/v-create-material.vue";
import {useRoute, useRouter} from "vue-router";

const route = useRoute();
const router = useRouter()

const createMaterial = ref(false)
const serviceName = [
    {name: 'material', label: 'Учебно-методические материалы',},
    {name: 'game', label: 'Игра', title: 'Игра РКИ онлайн'},
    {name: 'kalinka', label: 'Kalinka - Russian Fast & Easy'},
    /*
     {name: 'Course', label: 'Курсы'},
     {name: 'Teacher', label: 'База учителей'},
     {name: 'Vacancy', label: 'Вакансии'},
     {name: 'Tests', label: 'Тесты'},
     */

]
const tests = ref([
    {id: 1, name: 'Уровень A1', image: 'img/tests/a1.svg'},
    {id: 2, name: 'Уровень A2', image: 'img/tests/a2.svg'},
    {id: 3, name: 'Уровень B1', image: 'img/tests/b1.svg'},
    {id: 4, name: 'Уровень B2', image: 'img/tests/b2.svg'},
    {id: 5, name: 'Уровень C1', image: 'img/tests/c1.svg'},
])
const selectedService = ref({name: 'material', label: 'Учебно-методические материалы'})
const changeServiceName = (serviceName) => {
    selectedService.value = serviceName
};
watch(selectedService, () => {
    changeServiceName(selectedService.value)
})
const activeMaterialInfo = ref({
    id: 0,
    title: '',
    subtitle: '',
    img: '',
    body: '',
    date: '',
    likes: '',
})
let returnToBack = () => {
    router.push('/service')
    selectedService.value = {name: 'material', label: 'Учебно-методические материалы'}
}
</script>
<style scoped>
.back{
    background: none;
}
</style>

