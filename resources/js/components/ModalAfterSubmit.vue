<template>
    <div class="modal__offer modal-submit">
        <div class="modal__overlay">
            <div class="modal__window">
                <button class="btn-reset btn-close" @click="$emit('close-submit')"></button>
                <p class="modal__title">Спасибо, ваш заказ успешно оформлен</p>
                <p class="modal__text">Наши специалисты свяжутся с вами в ближайшее время для уточнения деталей заказа</p>
                <picture>
                    <source srcset="img/after-submit-illustration-phone.webp" media="(max-width: 768px)">
                    <img src="img/after-submit-illustration.webp" alt="">
                </picture>

            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
.modal-submit .modal__overlay {
    height: 100%;
}

body .modal-submit .modal__window {
    transform: translateY(-50%);
    top: 50%;
}

.modal__offer.modal-submit {
    overflow: auto;
}

@media (max-width: 1200px) {
    .modal-submit .modal__window {
        max-width: 622px;
        left: calc(50% - 311px);
        transform: translate(-50%, -50%);
    }

    .modal-submit .modal__title {
        margin-bottom: 16px;
        font-size: 24px;
        line-height: 28.8px;
    }

    .modal-submit .modal__text {
        margin-bottom: 45px;
        font-size: 14px;
        line-height: 16.8px;
    }

    .btn-close {
        top: 30px;
        right: 30px;
        width: 21px;
        height: 21px;
        background-size: 21px;
    }
}

@media (max-width: 768px) {
    .modal-submit .modal__window {
        padding: 20px;
        padding-bottom: 0;
        max-width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        transform: none;
        border-radius: 0;
        background-image: url(../img/after-submit-phone.webp);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .modal__offer.modal-submit {
        padding: 0;
    }

    .modal-submit .modal__title {
        padding-top: 140px;
    }

    .modal-submit .modal__window picture {
        margin-top: auto;
    }

}
</style>
