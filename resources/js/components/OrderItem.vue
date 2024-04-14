<template>
     <label :class="{active: selectedProducts.includes(book)}" class="product">
                                <div class="order__product">
                                   <input type="checkbox" class="visually-hidden product__input" :name="'product-'+book.id+''"  @change="addProduct(book)">
                                <span class="product__checkbox"></span>
                                <img :src="book.image" alt="">
                                <div class="product__name">
                                    <p>{{ book.type }}</p>
                                    <p>{{ book.name }} {{ book.level }}</p>
                                </div>
                                </div>

                                <div v-if="!book.isOnline" class="product__count count">
                                    <p class="count__text">Количество</p>
                                    <div class="count__block">
                                        <button @click.prevent="decrementProduct(book.amount)" class="btn-reset product__btn product__btn--decrement" :disabled="!selectedProducts.includes(book)"></button>
                                        <input type="number" class="count__num" :name="'count['+ book.id +']'" v-model="amount">
                                        <button @click.prevent="incrementProduct(book.amount)" class="btn-reset product__btn product__btn--increment" :disabled="!selectedProducts.includes(book)"></button>
                                    </div>
                                </div>

                                <div v-else-if="book.isOnline" class="product__count sub">
                                    <div class="sub__text">


                                        <div class="tooltip">
                                            Подписка
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <rect width="12" height="12" rx="6"/>
                                            <path d="M6 9.5V9.505M6 7.5V2.5" stroke="#0A2B49" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                            <div class="tooltip__block">
                                                <p class="tooltip__title">Подписка на 1 год</p>
                                                <p class="tooltip__text">Имеется спорная точка зрения, гласящая примерно следующее: непосредственные участники технического прогресса представляют собой не что иное.</p>
                                                <p class="tooltip__title">Подписка навсегда</p>
                                                <p class="tooltip__text">Однозначно, некоторые особенности внутренней политики неоднозначны и будут заблокированы в рамках своих собственных рациональных ограничений.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex sub__block">
                                        <label class="sub__label">
                                            <input type="radio" class="visually-hidden" :name="'sub['+ book.id +']'" value="year" :disabled="!selectedProducts.includes(book)" :checked="selectedProducts.includes(book.id)">
                                            <span></span>
                                            1 год
                                        </label>
                                        <label class="sub__label">
                                            <input type="radio" class="visually-hidden" :name="'sub['+ book.id +']'" value="always" :disabled="!selectedProducts.includes(book)" :checked="selectedProducts.includes(book.id)">
                                            <span></span>
                                            Навсегда
                                        </label>


                                    </div>
                                </div>
                                <p v-show="currencyValue == 'rub'" class="product__price">{{ book.rub }} ₽</p>
                                <p v-show="currencyValue == 'usd'" class="product__price">{{ book.usd }} $</p>
                                <p v-show="currencyValue == 'eur'" class="product__price">{{ book.eur }} €</p>
                            </label>
</template>

<script>
import { Form, Field, ErrorMessage   } from 'vee-validate';
    export default {
        data() {
            return {
                total: this.totalPrice
            }
        },

        props: ['book', 'selectedProducts', 'totalPrice'],
        components: {Form, Field, ErrorMessage },

        computed: {
            amount: {
                get() {
                return this.book.amount
            },

            set(value) {
                this.book.amount = value
            }
            },


        },

        methods: {
            incrementProduct() {
                this.amount += 1
            },

            decrementProduct() {
                if (this.amount > 1) {
                    this.amount -= 1
                }
            },

            addProduct(product) {
                if (!this.selectedProducts.includes(product)) {
                    this.selectedProducts.push(product);
                    product.amount = 1;

                } else {
                   const index = this.selectedProducts.indexOf(product);
                   this.selectedProducts.splice(index, 1);
                   product.amount = 0;
                }

            }
        }
    }
</script>
