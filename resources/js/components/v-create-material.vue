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
        <div class="modal_material_form" v-if="statusCreated === 'info'">
            <form @submit.prevent="submitForm">
                <div class="modal_form_wrap">
                    <div class="modal_form__input">
                        <div class="modal_form__input_user fg">
                            <div class="input_name flex_input">
                                <label class="modal_label">Ф.И.О. *</label>
                                <input
                                    type="text"
                                    class="modal_input"
                                    placeholder="Введите Ф.И.О."
                                    v-model="name"
                                    :class="{'isInvalidInput':v$.name.$error }"
                                >
                                <div v-if="v$.name.$error" style="color: red;font-size: 15px">
                                    Введите Ф.И.О.
                                </div>
                            </div>
                            <div class="input_position flex_input">
                                <label class="modal_label">Должность *</label>
                                <input
                                    type="text"
                                    class="modal_input"
                                    placeholder="Введите должность"
                                    v-model="position"
                                    :class="{'isInvalidInput':v$.position.$error }"
                                >
                                <div v-if="v$.position.$error" style="color: red;font-size: 15px">
                                    Введите должность
                                </div>
                            </div>
                            <div class="input_about flex_input">
                                <label class="modal_label">О себе *</label>
                                <textarea
                                    class="modal_input area_text"
                                    v-model="about"
                                    :class="{'isInvalidInput':v$.about.$error }"
                                />
                                <div v-if="v$.about.$error" style="color: red;font-size: 15px">
                                    Поле не может быть пустым
                                </div>
                            </div>
                        </div>
                        <div class="modal_form__input_material fg">
                            <div class="input_material flex_input">
                                <label class="modal_label">Название материала *</label>
                                <input
                                    type="text"
                                    class="modal_input"
                                    placeholder="Введите название"
                                    v-model="titleMaterial"
                                    :class="{'isInvalidInput':v$.titleMaterial.$error }"

                                >
                                <div v-if="v$.titleMaterial.$error" style="color: red;font-size: 15px">
                                    Введите название материала
                                </div>
                            </div>
                            <div class="input_desc flex_input ">
                                <label class="modal_label">Описание материала *</label>
                                <textarea
                                    class="modal_input area_text"
                                    placeholder="Введите описание"
                                    v-model="description"
                                    :class="{'isInvalidInput':v$.titleMaterial.$error }"
                                />
                                <div v-if="v$.description.$error" style="color: red;font-size: 15px">
                                    Введите описание
                                </div>
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
                                            <input
                                                type="checkbox"
                                                :value="level.value"
                                                :id="level.id"
                                                v-model="checkedLevel"
                                            />
                                            <label :for="level.id" class="form_level_label">{{ level.value }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_check_theme pb">
                                <p class="modal_label pb">Выберите тему</p>
                                <v-modal-select :options="themeFilter" class="pb" @input="theme"/>
                            </div>
                            <div class="form_link_video flex_input">
                                <label class="modal_label pb">Вставьте ссылку на Ваш видеоматериал</label>
                                <input
                                    type="text"
                                    class="modal_input"
                                    placeholder="Ссылка на Ваш видеоматериал"
                                    v-model="link"
                                    :class="{'isInvalidInput':v$.link.$error }"
                                >
                                <div v-if="v$.link.$error" style="color: red;font-size: 15px">
                                    Вставьте ссылку на Ваш видеоматериал
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="form__text">Загрузите файл</span>
                        <div class="form__label">
                            <DropZone
                                ref="dropzone"
                                :maxFiles="1"
                                url="http://localhost:5000/item"
                                :uploadOnDrop="true"
                                :multipleUpload="true"
                                :parallelUpload="3"
                                :maxFileSize="Number(131072000)"
                                @errorAdd="onError"
                                @removedFile="onFileRemove"
                                @sending="onFileAdd"
                            >
                            </DropZone>
                            <cropper
                                ref="cropperImage"
                                :key="cropperKey"
                                v-if="cropImage"
                                class="cropper"
                                :src="cropImage.thumbnail"
                                @change="change"
                            />
                            <div  v-if="previewCropImage">
                                <h2>Превью изображения</h2>
                                <img :src="previewCropImage">
                            </div>

                            <div class="d-flex pb-4" v-if="cropImage">
                                <button class="modal_form_next" type="button" @click="uploadImage">Обрезать</button>
                            </div>
                            <span class="form__error" v-show="errorFile">Размер файла превышает 125MB</span>
                        </div>
                        <div class="d-flex">
                            <button class="modal_form_next" type="submit">Далее</button>
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
            <p class="checking_title">
                Спасибо, что поделились своими полезными материалами! Мы ценим ваш вклад.
            </p>
            <p class="checking_subtitle">
                Обратите внимание, что все материалы проходят модерацию перед публикацией,
                чтобы гарантировать качество
                контента нашего сайта. Мы постараемся рассмотреть ваш материал как можно скорее и опубликовать его,
                если он соответствует нашим критериям. Спасибо за ваше терпение и понимание!
            </p>
            <div class="d-flex">
                <button class="modal_form_next" @click.prevent="emit('closemodal',false)">Готово</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted, ref, watch} from "vue";
import {useVuelidate} from '@vuelidate/core'
import {required, email, maxLength, minLength} from '@vuelidate/validators'
import VModalSelect from "@/components/v-modal-select.vue";
import DropZone from 'dropzone-vue';
import {Cropper} from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';


const emit = defineEmits(['closemodal'])

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


// Выбор области
let cropImage= ref()
const cropperImage = ref()
const cropperKey = ref(0);
const previewCropImage = ref('')
let onFileAdd = (e) => {
    cropperKey.value += 1;
    cropImage.value = dropzone.value.all[Object.keys(dropzone.value.all)[0]]
}
let dropzone = ref()

let uploadImage = ()=>{
        const { canvas } = cropperImage.value.getResult();
        if (canvas) {
            previewCropImage.value= canvas.toDataURL() // вывод превью
        }
}
let onError = () => {
    errorFile = true
    alert('Ошибка')
}
let onFileRemove = () => {
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
onMounted(() => {
    const text = document.querySelector('.dropzone__message.dropzone__message--style.dropzone-clickable');
    text.innerHTML =
        `<div class="file">
                            <p class="file__title">Загрузка файлов</p>
                            <p>Чтобы начать загрузку, выберите файлы на компьютере или перетащите их в это окно.</p>
                            <p class="file__size">Максимальный размер файлов 125 MB</p>
                            <button class="btn-reset btn-outline file__btn">Выбрать файлы</button>
                        </div>`
})

//Form
const name = ref('');
const position = ref('');
const about = ref('');
const titleMaterial = ref('');
const description = ref('');
const theme = ref('');
const checkedLevel = ref([]);
const link = ref('');
const file = ref(false);


let sendForm = () => {
    const cropper = cropImage.cropper; // Получаем доступ к cropper
    const croppedCanvas = cropper.getCroppedCanvas(); // Получаем обрезанное изображение в виде canvas

    // Преобразуем canvas в Blob для отправки на сервер
    croppedCanvas.toBlob((blob) => {
        // Отправляем обрезанное изображение на сервер
        const formData = new FormData();
        formData.append('croppedImage', blob);

        axios.post('http://your-server-url/save-cropped-image', formData)
            .then(response => {
                console.log('Cropped image saved successfully:', response.data);
            })
            .catch(error => {
                console.error('Error saving cropped image:', error);
            });
    })
    statusCreated.value = 'checking'
}
//validate

const rules = {
    name: {required, minLength: minLength(5)},
    position: {required, minLength: minLength(5)},
    about: {required, minLength: minLength(5)},
    titleMaterial: {required, minLength: minLength(5)},
    description: {required, maxLength: maxLength(255)},
    link: {required, minLength: minLength(5)},
};
const v$ = useVuelidate(rules, {
    name,
    position,
    about,
    titleMaterial,
    description,
    link,
});

let submitForm = async () => {
    console.log(v$.value)
    v$.value.$touch()
    if (v$.value.$invalid) {
        return
    } else {
        sendForm()
    }
}


</script>

<style>
.isInvalidInput {
    border: 1.5px solid red !important;
}

input:focus-visible, textarea:focus-visible {
    outline: none !important;
}
</style>
