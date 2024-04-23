<template>
  <div>
    <div class="modal__offer order">
      <div class="modal__overlay">
        <div class="modal__window">
          <button class="btn-reset btn-close" @click="$emit('close-order')"></button>
          <Form @InvalidSubmit="onInvalidSubmit" @submit="onSubmit()" class="order__form" method="post">
            <!-- <div class="flex currency-block">
                <label class="order__label currency">
                    <input type="radio" class="visually-hidden" name="currency" value="rub"
                           @change="selectedCurrency" checked>
                    <span class="currency__radio currency__radio--rub">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="21" viewBox="0 0 13 21"
                         fill="none">
<path
d="M1.6225 0.503097C1.73726 0.493038 1.82607 0.477952 1.9142 0.477952C3.90625 0.477952 5.89898 0.454961 7.89035 0.485854C10.3954 0.524651 12.5767 2.6362 12.8473 5.23486C13.1909 8.53114 10.8668 11.2979 7.7059 11.3396C6.38538 11.3568 5.06487 11.341 3.74435 11.3424C3.58791 11.3424 3.43146 11.3568 3.2354 11.3669C3.2354 11.6305 3.21013 11.8712 3.24838 12.1004C3.26273 12.1859 3.42395 12.3016 3.52096 12.3052C4.12349 12.3246 4.72739 12.3167 5.33061 12.3167C6.29657 12.3174 7.26322 12.3167 8.25788 12.3167C8.25788 12.8936 8.25788 13.4367 8.25788 14.0352C8.13696 14.0352 8.01673 14.0352 7.89718 14.0352C6.46257 14.0352 5.02865 14.0431 3.59405 14.0295C3.30918 14.0266 3.22584 14.1185 3.2272 14.4153C3.23813 16.2947 3.23267 18.1742 3.23267 20.0537C3.23267 20.1838 3.23267 20.3131 3.23267 20.4697C2.68889 20.4697 2.17243 20.4697 1.62386 20.4697C1.61635 20.3124 1.60269 20.1608 1.60269 20.0092C1.60201 18.1656 1.59654 16.322 1.6102 14.4785C1.61294 14.1466 1.54325 13.9863 1.19827 14.0302C0.987174 14.0568 0.770617 14.0352 0.50624 14.0352C0.50624 13.4942 0.500774 12.9841 0.514437 12.4747C0.515803 12.4208 0.627843 12.3375 0.697523 12.3253C0.841667 12.3008 0.992641 12.3152 1.1402 12.3145C1.59996 12.3138 1.59996 12.3138 1.60064 11.818C1.60132 11.3446 1.60132 11.3446 1.16 11.3431C1.01176 11.3424 0.858741 11.364 0.718013 11.3295C0.635352 11.3094 0.514434 11.2002 0.511702 11.1269C0.493257 10.6391 0.502137 10.1505 0.502137 9.61672C0.772662 9.61672 1.00904 9.59948 1.24267 9.62103C1.52959 9.64834 1.60952 9.53266 1.60747 9.23522C1.59586 7.31982 1.60132 5.40441 1.60132 3.48901C1.60132 2.63907 1.60064 1.78914 1.60201 0.939201C1.60269 0.799102 1.61498 0.659002 1.6225 0.503097ZM5.74118 9.616V9.61313C6.44687 9.61313 7.15255 9.62822 7.85756 9.61026C9.62007 9.56643 11.1291 8.02319 11.2391 6.16813C11.3539 4.23548 10.045 2.42785 8.24354 2.27194C6.64976 2.134 5.03891 2.20872 3.43625 2.20728C3.36862 2.20728 3.24155 2.38977 3.24155 2.4882C3.23062 4.76139 3.23608 7.03531 3.22925 9.30923C3.22857 9.5729 3.33514 9.62391 3.55717 9.62031C4.28472 9.60882 5.01295 9.616 5.74118 9.616Z"/>
</svg>
                </span>
                </label>
                <label class="order__label currency">
                    <input type="radio" class="visually-hidden" name="currency" value="usd"
                           @change="selectedCurrency">
                    <span class="currency__radio currency__radio--usd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="21" viewBox="0 0 14 21"
                         fill="none">
<path
d="M10.5014 10.2288C9.5592 9.83056 8.57108 9.63077 7.58431 9.41816V3.23431C7.59578 3.23633 7.60658 3.23768 7.61806 3.23971C8.74387 3.43544 9.70769 3.93288 10.3273 4.94327C10.4771 5.1876 10.5689 5.4677 10.6951 5.74916C11.1878 5.65871 11.6812 5.5676 12.2198 5.46905C12.1571 4.90412 11.9458 4.43706 11.663 4.0024C10.7721 2.63361 9.45391 1.93031 7.89141 1.63536C7.64168 1.58812 7.58836 1.4943 7.58836 1.26481C7.58836 0.469727 7.58026 0.469727 6.79395 0.469727C6.00021 0.469727 5.96714 0.469726 5.96511 1.21487C5.96511 1.23916 5.96511 1.26481 5.96511 1.29114C5.96511 1.51522 5.89964 1.59419 5.67286 1.63199C4.5025 1.8284 3.47254 2.31503 2.59308 3.12632C0.497375 5.06004 0.74643 8.84244 3.70134 10.0789C4.43434 10.386 5.19702 10.5682 5.96376 10.735V17.722C5.91517 17.7159 5.86657 17.7105 5.81798 17.7031C4.65302 17.5303 3.58998 17.0936 2.83674 16.1541C2.47564 15.7039 2.25561 15.1403 1.93096 14.5558C1.53679 14.5842 1.02518 14.6206 0.504125 14.6584C0.504125 14.7678 0.494001 14.8461 0.505475 14.921C0.628315 15.7032 0.929341 16.4106 1.42408 17.0295C2.50804 18.3861 3.97132 19.055 5.64654 19.3182C5.87332 19.354 5.95499 19.4188 5.96376 19.6321V19.7057C5.96443 20.469 5.98604 20.4697 6.7791 20.4697C7.57823 20.4697 7.58836 20.4697 7.58633 19.6631C7.58566 19.4148 7.67003 19.3547 7.90761 19.3182C9.41341 19.0854 10.7424 18.4908 11.8216 17.3805C13.8188 15.3266 13.4739 11.4841 10.5014 10.2288ZM4.2791 8.53264C3.54003 8.27211 3.06689 7.69773 2.90896 6.90264C2.69432 5.82543 3.00075 4.91425 3.82891 4.20556C4.47821 3.6494 5.19702 3.3288 5.96511 3.20934V9.03749C5.39546 8.89103 4.8312 8.7277 4.2791 8.53264ZM10.0006 16.8122C9.24265 17.3346 8.43272 17.6289 7.58431 17.7348V11.0987C8.37467 11.2904 9.16098 11.5057 9.92435 11.7784C10.6803 12.0484 11.1703 12.6424 11.3566 13.4503C11.6704 14.8062 11.2013 15.9847 10.0006 16.8122Z"/>
</svg>
                </span>
                </label>
                <label class="order__label currency">
                    <input type="radio" class="visually-hidden" name="currency" value="eur"
                           @change="selectedCurrency">
                    <span class="currency__radio currency__radio--eur">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21"
                         fill="none">
<path
d="M16.4031 17.237C16.728 17.686 17.0485 18.1299 17.3899 18.6018C16.7344 19.0873 16.0395 19.471 15.2944 19.7586C9.58285 21.9624 3.47833 18.8635 1.89842 12.9541C1.82383 12.6758 1.71051 12.5869 1.43656 12.6005C1.04283 12.6199 0.647674 12.6005 0.253232 12.6056C0.0717894 12.6077 -0.00278916 12.5374 7.95062e-05 12.3517C0.00796833 11.887 0.00294222 11.4215 0.00294222 10.8922C0.438979 10.8922 0.85279 10.8714 1.26444 10.8987C1.60223 10.9216 1.58859 10.7302 1.58859 10.4978C1.58859 10.259 1.62015 10.0439 1.25655 10.0697C0.855651 10.0976 0.451176 10.0761 0.0266143 10.0761C0.0266143 9.49882 0.0266143 8.96597 0.0266143 8.36068C0.487752 8.36068 0.948889 8.3406 1.40716 8.36785C1.71697 8.38578 1.8267 8.27821 1.91347 7.97771C3.06094 4.01968 5.65278 1.54545 9.67679 0.685568C12.2887 0.127613 14.7536 0.66979 17.0148 2.09911C17.1152 2.16222 17.2085 2.23608 17.3383 2.3286C17.0105 2.79189 16.69 3.24585 16.3644 3.70556C13.3795 1.84595 10.3588 1.6602 7.3001 3.41726C5.24829 4.59556 3.88209 6.85105 3.6526 8.33414C3.81755 8.34347 3.97891 8.3614 4.14028 8.3614C7.308 8.36355 10.475 8.36283 13.6427 8.36355C14.134 8.36355 14.1347 8.36427 14.1383 8.8505C14.1397 9.1137 14.1196 9.37834 14.1433 9.63867C14.1741 9.97574 14.0666 10.0869 13.7101 10.0847C11.0208 10.069 8.33139 10.0761 5.64202 10.0761C5.03243 10.0761 4.42284 10.0754 3.81324 10.0761C3.29043 10.0769 3.27178 10.0962 3.31051 10.619C3.31625 10.7 3.34064 10.7789 3.36215 10.8901C6.57219 10.8901 9.77217 10.8901 13.0288 10.8901C13.0288 11.4308 13.0331 11.9393 13.0217 12.4471C13.0202 12.4987 12.9284 12.5769 12.866 12.5934C12.7649 12.6192 12.6523 12.6056 12.5455 12.6056C9.74851 12.6056 6.95156 12.6056 4.15462 12.6056C3.99182 12.6056 3.82903 12.6056 3.58519 12.6056C4.20912 14.7492 5.38527 16.3994 7.23054 17.4988C10.3022 19.3304 13.3609 19.1397 16.4031 17.237Z"/>
</svg>
                </span>
                </label>
            </div> -->


            <div class="order__container">

              <div class="order__left">
                <div class="products">
                  <OrderItem v-for="book in books" :key="book.id" :book="book"
                             :currencyValue="currencyValue" :selectedProducts="selectedProducts"/>
                </div>
                <div class="order__info info">
                  <div>
                    <span class="form__text">Ф.И.О *</span>
                    <label for="" class="form__label">
                      <button class="modal__btn hidden" @click.prevent="clearInput"></button>
                      <Field :class="{'error-input': errorFio}" class="form__input" name="fio"
                             v-model="fio" type="text" placeholder="Введите Ф.И.О"
                             :rules="validateFio" @input="inputChange" @keydown="deleteNumber"/>
                      <span v-show="errorFio" class="error-icon"></span>
                      <ErrorMessage class="form__error" name="fio"/>
                    </label>
                  </div>

                  <div>
                    <span class="form__text">Страна</span>
                    <label for="" class="form__label">
                      <button class="modal__btn hidden" @click.prevent="clearInput"></button>
                      <input class="form__input" name="country" v-model="country" type="text"
                             placeholder="Введите страну" @input="inputChange"
                             @keydown="deleteNumber"/>
                    </label>
                  </div>


                  <div class="info-block">
                    <div class="w-100">
                      <span class="form__text">Email *</span>
                      <label for="" class="form__label">
                        <button v-show="!errorEmail" class="modal__btn hidden"
                                @click.prevent="clearInput"></button>
                        <Field :class="{'error-input': errorEmail}" class="form__input"
                               name="email" v-model="email" type="text"
                               placeholder="Введите email" :rules="validateEmail"
                               @input="inputChange" @keydown="deleteNumber"/>
                        <span v-show="errorEmail" class="error-icon"></span>
                        <ErrorMessage class="form__error" name="email"/>
                      </label>
                    </div>
                    <div class="w-100">
                      <span class="form__text">Телефон *</span>
                      <label for="" class="form__label">
                        <vue-tel-input v-model="phone" @country-changed="countryChanged"
                                       @validate="customValidate"
                                       @keydown="deleteLetter"></vue-tel-input>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="order__block payment">
                  <p class="order__title">Способ оплаты</p>
                  <div class="payment__block">
                    <label class="payment__label">
                      <input type="radio" class="visually-hidden" name="payment" value="robokassa"
                             @change="selectedPayment" checked/>
                      <span></span>
                      <img src="img/payment-1.svg" alt="Robokassa">
                    </label>
                    <label class="payment__label">
                      <input type="radio" class="visually-hidden" name="payment" value="paypal"
                             @change="selectedPayment"/>
                      <span></span>
                      <img src="img/payment-2.svg" alt="PayPal">
                    </label>
                  </div>

                </div>

                <div class="order__block delivery">
                  <p class="order__title">Способ получения</p>
                  <div class="delivery__block">
                    <div>
                      <label class="delivery__label">
                        <input type="radio" class="visually-hidden" name="delivery"
                               value="pickup" @change="selectedDelivery" checked/>
                        <span></span>
                        Самовывоз
                      </label>
                      <p>г. Москва, ул. Ростовская набережная, д. 5, вход с внутреннего двора,
                        слева от 5-го подъезда (бесплатно)</p>
                    </div>

                    <div>
                      <label class="delivery__label">
                        <input type="radio" class="visually-hidden" name="delivery"
                               value="pochta" @change="selectedDelivery"/>
                        <span></span>
                        Доставка почтой России
                      </label>
                      <p>Книга отправляется вам почтовым переводом, по адресу, который вы укажите,
                        срок доставки зависит от Почты России, стоимость за счёт покупателя</p>
                    </div>

                  </div>
                </div>

                <Pochta v-show="deliveryValue == 'pochta'"/>

              </div>
              <div class="order__right">
                <div class="order__block">
                  <div class="between-block">
                    <p class="order__title">Итого</p>
                    <p class="order__price order__price--bold">{{ total }} ₽</p>
                  </div>
                  <div class="between-block">
                    <p class="order__text">Товары, {{ selectedProducts.length }}  шт.</p>
                    <p class="order__price">0 ₽</p>
                  </div>

                  <p class="order__text order__text--info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                         viewBox="0 0 12 12" fill="none">
                      <rect width="12" height="12" rx="6" fill="#B6D3FD"/>
                      <path d="M6 9.5V9.505M6 7.5V2.5" stroke="#0A2B49" stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>
                    Мы свяжемся с вами, чтобы уточнить сроки и стоимость доставки.
                  </p>

                  <input class="order__input" type="text" placeholder="Промокод">

                  <button :disabled="!validate" class="btn-reset order__submit" type="submit">
                    Заказать
                  </button>

                  <p class="order__agreement">Нажимая на кнопку «Заказать», вы подтверждаете, что
                    ознакомлены c <a href="docs/Согласие_на_обработку_ПДн_на_сайте_учебник.pdf"
                                     target="_blank">Пользовательским соглашением</a> и <a
                        href="docs/политика_обработки_ПДн_на_сайте_учебник.pdf" target="_blank">Политикой
                      о персональных данных</a></p>

                </div>
                <div class="order__block order__message">
                  <p class="order__text">Любые вопросы по покупке книги: <a href="tel:+74993021872">+7 499 302-18-72</a>,
                    <a href="tel:+79993333303">+7 999 333-33-03</a>, <a
                        href="mailto:book@rus.study">book@rus.study</a></p>
                  <p class="order__text">Если вы не получили ответ, продублируйте, пожалуйста, письмо
                    координатору проекта на <a href="mailto:pressantonov2013@gmail.com">pressantonov2013@gmail.com</a>
                  </p>
                  <p class="order__text">If you did not receive a response, please duplicate the
                    letter to the project coordinator at <a
                        href="mailto:pressantonov2013@gmail.com">pressantonov2013@gmail.com</a></p>
                </div>
              </div>

            </div>
          </Form>

        </div>
      </div>
    </div>

    <ModalAfterSubmit @close-submit="closeSubmit" v-if="showModalSubmit"></ModalAfterSubmit>
  </div>
</template>

<script>
import {VueTelInput} from 'vue-tel-input';
import {Form, Field, ErrorMessage, configure} from 'vee-validate';
import OrderItem from './OrderItem.vue';
import Pochta from './Pochta.vue';
import ModalAfterSubmit from './ModalAfterSubmit.vue';
import axios from "axios";

configure({
  validateOnBlur: false,
  validateOnChange: true,
  validateOnInput: true,
  validateOnModelUpdate: true,

});

export default {
  props: ['books'],
  components: {VueTelInput, Form, Field, ErrorMessage, OrderItem, Pochta, ModalAfterSubmit},
  data() {
    return {
      phone: 0,
      activeCountry: 0,
      productAmount: 0,
      fio: '',
      country: '',
      email: '',
      errorFio: false,
      errorEmail: false,
      phoneValid: false,
      selectedProducts: [],
      deliveryValue: '',
      paymentValue: '',
      currencyValue: 'rub',
      delivery: '',
      showModalSubmit: false,
      totalPrice: 0

    }
  },

  methods: {
    countryChanged(country) {
      this.activeCountry = country.dialCode
      this.phone = `+ ${country.dialCode}`
    },

    onInvalidSubmit(e) {
      if (e.errors.fio) {
        this.errorFio = true
      }

      if (e.errors.country) {
        this.errorCountry = true
      }

      if (e.errors.email) {
        this.errorEmail = true
      }
    },

    validateFio(value) {
      if (!value) {
        return 'Введите Ф.И.О';
      }

      return true;
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

    clearInput(e) {
      e.target.classList.add('hidden');
      if (e.target.nextSibling.getAttribute('name') == 'fio') {
        this.fio = '';
        this.errorFio = true
      }
      if (e.target.nextSibling.getAttribute('name') == 'country') {
        this.country = '';
        this.errorCountry = true
      }

      if (e.target.nextSibling.getAttribute('name') == 'email') {
        this.email = '';
        this.errorEmail = true
      }


    },

    inputChange(e) {
      const btn = e.target.previousSibling;
      if (e.target.getAttribute('name') == 'fio') {
        this.errorFio = false
      }


      if (e.target.getAttribute('name') == 'email') {
        this.errorEmail = false
      }

      console.log(e)

      if (e.target.value != '') {
        btn.classList.remove('hidden')

      } else btn.classList.add('hidden')

    },

    customValidate(value) {
      if (value.valid == true) {
        this.phoneValid = true
      } else this.phoneValid = false
    },

    deleteNumber(e) {
      if (e.key.match(/[0-9]/)) return e.preventDefault();
    },

    deleteLetter(e) {
      if (e.key.match(/^[a-zA-Zа-яА-Я]$/)) return e.preventDefault();
    },

    selectedDelivery(e) {
      this.deliveryValue = e.target.value
    },

    selectedPayment(e) {
      this.paymentValue = e.target.value
    },

    selectedCurrency(e) {
      this.currencyValue = e.target.value
    },

    async onSubmit(e) {
      let res = {
        fio: this.fio,
        email: this.email,
        country: this.country,
        telephone: this.phone.replaceAll(' ', ''),
      }

      try {
        const response = await axios.post('/api/payment', res,
            {
              headers: {
                'Content-Type': 'application/json'
              }
            })
        this.showModalSubmit = true
        return response.data;
      } catch (error) {
        if (error.response) {
          console.error('Ошибка:', error.response.data);
          console.error('Статус ошибки:', error.response.status);
          console.error('Заголовки:', error.response.headers);
        } else if (error.request) {
          console.error('Ошибка при ожидании ответа от сервера:', error.request);
        } else {
          console.error('Ошибка:', error.message);
        }
        throw error; // Если вы хотите передать ошибку дальше для обработки в вызывающем коде
      }
    },



    closeSubmit() {
      this.showModalSubmit = false;
      this.$emit('close-order');
    }

  },

  computed: {
    validate() {
      if (this.validateFio(this.fio) == true && this.validateEmail(this.email) == true && this.phoneValid == true && this.selectedProducts.length > 0)
        return true
    },

    total() {
      return this.selectedProducts.reduce((total, item) => total + item[this.currencyValue], 0)
    },

  }

}
</script>

<style>
.order {
  font-size: 14px;
}
</style>
