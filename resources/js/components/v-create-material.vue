<template>
    <div class="modal_material">
        <div class="close_materialModal">
            <button @click="emit('closemodal',false)">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M6.11612 5.88388C6.35054 5.64946 6.71081 5.5601 7.11767 5.63544C7.52454 5.71079 7.94467 5.94467 8.28565 6.28565L33.9986 31.9986C34.3396 32.3396 34.5735 32.7597 34.6488 33.1666C34.7242 33.5735 34.6348 33.9337 34.4004 34.1682C34.166 34.4026 33.8057 34.4919 33.3988 34.4166C32.992 34.3413 32.5718 34.1074 32.2309 33.7664L6.51788 8.05342C6.17691 7.71244 5.94302 7.29231 5.86767 6.88544C5.79233 6.47858 5.8817 6.1183 6.11612 5.88388Z"
                          fill="#0A2B49"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M34.1161 6.11612C34.3505 6.35054 34.4399 6.71081 34.3646 7.11767C34.2892 7.52454 34.0553 7.94467 33.7144 8.28565L8.00137 33.9986C7.6604 34.3396 7.24026 34.5735 6.8334 34.6488C6.42653 34.7242 6.06626 34.6348 5.83184 34.4004C5.59742 34.166 5.50805 33.8057 5.5834 33.3988C5.65874 32.992 5.89263 32.5718 6.23361 32.2309L31.9466 6.51788C32.2876 6.17691 32.7077 5.94302 33.1146 5.86767C33.5214 5.79233 33.8817 5.8817 34.1161 6.11612Z"
                          fill="#0A2B49"/>
                </svg>
            </button>
        </div>
        <div class="modal_material_tab">
            <div class="fg">
                <p class="modal_tab__title" :class="{modal_material_tab__active: statusCreated === 'info' }">
                    Информация</p>
            </div>
            <div class="fg">
                <p class="modal_tab__title " :class="{modal_material_tab__active: statusCreated === 'checking'}">
                    Проверка</p>
            </div>
        </div>
        <div class="modal_material_form" v-if="statusCreated=== 'info'">
            <form>
                <div class="modal_form_wrap">
                    <div class="modal_form__input">
                        <div class="modal_form__input_user fg">
                            <div class="input_name flex_input">
                                <label class="modal_label">Ф.И.О. *</label>
                                <input type="text" class="modal_input" placeholder="Введите Ф.И.О.">
                            </div>
                            <div class="input_position flex_input">
                                <label class="modal_label">Должность *</label>
                                <input type="text" class="modal_input" placeholder="Введите должность">
                            </div>
                            <div class="input_about flex_input">
                                <label class="modal_label">О себе *</label>
                                <textarea class="modal_input area_text"/>
                            </div>
                        </div>
                        <div class="modal_form__input_material fg">
                            <div class="input_material flex_input">
                                <label class="modal_label">Название материала *</label>
                                <input type="text" class="modal_input" placeholder="Введите название">
                            </div>
                            <div class="input_desc flex_input ">
                                <label class="modal_label">Описание материала *</label>
                                <textarea class="modal_input area_text" placeholder="Введите описание"/>
                            </div>
                        </div>
                    </div>

                    <div class="modal_form_select">
                        <div class="form_select__level">
                            <div class="form_check_level pb ">
                                <p class="modal_label pb">Выберите для какого уровня владения языка предназначен
                                    материал</p>
                                <div class="">
                                    <div class="material_learn_check pb">
                                        <div v-for="level of levelFilter">
                                            <input type="checkbox" :value="level.value" :id="level.id"
                                                   v-model="checkedLevel"/>
                                            <label :for="level.id" class="form_level_label">{{ level.value }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_check_theme pb">
                                <p class="modal_label pb">Выберите тему</p>
                                <v-modal-select :options="themeFilter" class="pb">
                                </v-modal-select>
                            </div>
                            <div class="form_link_video flex_input">
                                <label class="modal_label pb">Вставьте ссылку на Ваш видеоматериал</label>
                                <input type="text" class="modal_input" placeholder="Ссылка на Ваш видеоматериал">
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="modal_form_attach" id="drop-area"
                                             @dragover.prevent="allowDrop"
                                             @drop.prevent="handleDrop">
                                            <p class="modal_label pb">Загрузите файлы, которые хотите прикрепить к Вашему материалу</p>
                                            <div class="modal_form_attach_border">
                                                <div class="modal_form_attach_img">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewBox="0 0 61 60"
                                                         fill="none">
                                                        <g clip-path="url(#clip0_3614_8280)">
                                                            <path
                                                                d="M2.375 37.125C2.87228 37.125 3.34919 37.3225 3.70083 37.6742C4.05246 38.0258 4.25 38.5027 4.25 39V48.375C4.25 49.3696 4.64509 50.3234 5.34835 51.0267C6.05161 51.7299 7.00544 52.125 8 52.125H53C53.9946 52.125 54.9484 51.7299 55.6516 51.0267C56.3549 50.3234 56.75 49.3696 56.75 48.375V39C56.75 38.5027 56.9475 38.0258 57.2992 37.6742C57.6508 37.3225 58.1277 37.125 58.625 37.125C59.1223 37.125 59.5992 37.3225 59.9508 37.6742C60.3025 38.0258 60.5 38.5027 60.5 39V48.375C60.5 50.3641 59.7098 52.2718 58.3033 53.6783C56.8968 55.0848 54.9891 55.875 53 55.875H8C6.01088 55.875 4.10322 55.0848 2.6967 53.6783C1.29018 52.2718 0.5 50.3641 0.5 48.375V39C0.5 38.5027 0.697544 38.0258 1.04917 37.6742C1.40081 37.3225 1.87772 37.125 2.375 37.125Z"
                                                                fill="#0A2B49"/>
                                                            <path
                                                                d="M29.1749 44.4525C29.349 44.6271 29.5559 44.7656 29.7837 44.8602C30.0115 44.9547 30.2557 45.0033 30.5024 45.0033C30.749 45.0033 30.9932 44.9547 31.221 44.8602C31.4488 44.7656 31.6557 44.6271 31.8299 44.4525L43.0799 33.2025C43.4319 32.8504 43.6297 32.3729 43.6297 31.875C43.6297 31.3771 43.4319 30.8996 43.0799 30.5475C42.7278 30.1954 42.2503 29.9976 41.7524 29.9976C41.2545 29.9976 40.7769 30.1954 40.4249 30.5475L32.3774 38.5987V5.625C32.3774 5.12772 32.1798 4.65081 31.8282 4.29917C31.4766 3.94754 30.9996 3.75 30.5024 3.75C30.0051 3.75 29.5282 3.94754 29.1765 4.29917C28.8249 4.65081 28.6274 5.12772 28.6274 5.625V38.5987L20.5799 30.5475C20.2278 30.1954 19.7503 29.9976 19.2524 29.9976C18.7545 29.9976 18.2769 30.1954 17.9249 30.5475C17.5728 30.8996 17.375 31.3771 17.375 31.875C17.375 32.3729 17.5728 32.8504 17.9249 33.2025L29.1749 44.4525Z"
                                                                fill="#0A2B49"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_3614_8280">
                                                                <rect width="60" height="60" fill="white" transform="translate(0.5)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <div class="modal_form_attach__title">Загрузка файлов</div>
                                                <p v-if="selectedFile">Выбранный файл: {{ selectedFile.name }}</p>
                                                <img v-if="isImage" :src="filePreview" alt="Preview"
                                                     style="max-width: 100%; max-height: 200px"/>
                                                <pre v-if="!isImage">{{ filePreview }}</pre>

                                                <div class="modal_form_attach__subtitle_text" v-if="!selectedFile">
                                                    <p class="modal_form_attach__subtitle">Чтобы начать загрузку, выберите файлы на компьютере
                                                        или перетащите
                                                        их в это окно.</p>
                                                    <p class="modal_form_attach__subtitle">Максимальный размер файлов 125 MB</p>
                                                </div>
                                                <div class="">
                                                    <input type="file" ref="fileInput" class="modal_form_attach__btn" @change="handleFileInput"
                                                           style="display: none"/>
                                                    <button class="modal_form_attach__btn" @click="openFileInput">Выбрать файлы</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button class="modal_form_next" @click.prevent="uploadFile">Далее</button>
                                        </div>
                                        <div class="d-flex">
                                            <p class="form_link_bottom">
                                                Нажимая на кнопку «Далее»,<br> вы подтверждаете, что ознакомлены с
                                                <a href="#" class="link_doc">Пользовательским соглашением</a>
                                                и
                                                <span class="link_doc">Политикой о персональных данных</span>
                                            </p>
                                        </div>-->
                    <div>
                        <span class="form__text">Загрузите файл</span>
                        <div class="form__label">
                            <DropZone
                                :maxFiles="1"
                                url="http://localhost:5000/item"
                                :uploadOnDrop="true"
                                :multipleUpload="true"
                                :parallelUpload="3"
                                :maxFileSize="Number(131072000)"
                                @errorAdd="onError"
                                @removedFile="onFileRemove"/>
                            <span class="form__error" v-show="errorFile">Размер файла превышает 125MB</span>
                        </div>
                        <div class="d-flex">
                            <button class="modal_form_next" @click.prevent="sendForm">Далее</button>
                        </div>
                        <div class="d-flex">
                            <p class="form_link_bottom">
                                Нажимая на кнопку «Далее»,<br> вы подтверждаете, что ознакомлены с
                                <a href="#" class="link_doc">Пользовательским соглашением</a>
                                и
                                <span class="link_doc">Политикой о персональных данных</span>
                            </p>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="modal_material_checking" v-if="statusCreated=== 'checking'">
            <p class="checking_title"> Спасибо, что поделились своими полезными материалами! Мы ценим ваш вклад.</p>

            <p class="checking_subtitle">Обратите внимание, что все материалы проходят модерацию перед публикацией,
                чтобы гарантировать качество
                контента нашего сайта. Мы постараемся рассмотреть ваш материал как можно скорее и опубликовать его,
                если он соответствует нашим критериям. Спасибо за ваше терпение и понимание!
            </p>
            <div class="d-flex">
                <button class="modal_form_next" @click.prevent="emit('closemodal',false)">Готово</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted, ref, watch} from "vue";
import VModalSelect from "@/components/v-modal-select.vue";
import DropZone from 'dropzone-vue';

const emit = defineEmits(['closemodal'])
const checkedLevel = ref([])
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
const statusCreated = ref('info')
let errorFile = false
let  onError = ()=> {
    errorFile = true
}
let onFileRemove= ()=> {
    setTimeout(() => {
        console.log(document.querySelector('.dropzone__message.dropzone__message--style.dropzone-clickable'))
        const text = document.querySelector('.dropzone__message.dropzone__message--style.dropzone-clickable');
        text.innerHTML =
            `<div class="file">
                            <p class="file__title">Загрузка файлов</p>
                            <p>Чтобы начать загрузку, выберите файлы на компьютере или перетащите их в это окно.</p>
                            <p class="file__size">Максимальный размер файлов 125 MB</p>
                            <button class="btn-reset btn-outline file__btn">Выбрать файлы</button>
                        </div>`
    }, 5)
}
onMounted(()=>{
    const text = document.querySelector('.dropzone__message.dropzone__message--style.dropzone-clickable');
    text.innerHTML =
        `<div class="file">
                            <p class="file__title">Загрузка файлов</p>
                            <p>Чтобы начать загрузку, выберите файлы на компьютере или перетащите их в это окно.</p>
                            <p class="file__size">Максимальный размер файлов 125 MB</p>
                            <button class="btn-reset btn-outline file__btn">Выбрать файлы</button>
                        </div>`
})
let sendForm = ()=>{
    statusCreated.value = 'checking'
}
</script>

