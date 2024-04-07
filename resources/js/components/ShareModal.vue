<template>
    <div class="share">
        <button class="btn-reset btn-close" @click="$emit('close-modal')"></button>
        <p class="share__title">Поделиться</p>
        <div class="ya-share2" :data-title="item.title" :data-description="item.desc" data-copy="last" data-curtain data-size="l" data-shape="round" data-services="vkontakte,odnoklassniki,telegram,whatsapp,moimir"></div>
        <form class="share__form">
          <input readonly class="share__input" type="text" v-model="path">
          <button :disabled="btnText === 'Скопировано'" class="share__btn btn-background" @click.prevent="copy()">{{ this.btnText }}</button>
        </form>
    </div>
</template>


<script>


  export default {
    props: ['item'],
    data() {
      return {
        path: window.location,
        btnText: 'Скопировать'
      }
    },
    methods: {
      copy() {
        if (this.btnText === 'Скопировать') this.btnText = 'Скопировано'
        else this.btnText = 'Скопировать'
        setTimeout(() => {
          this.btnText = 'Скопировать'
        }, 1000)
        navigator.clipboard.writeText(this.path)
      }
    },
    mounted() {
      let recaptchaScript = document.createElement('script')
      recaptchaScript.setAttribute('src', 'https://yastatic.net/share2/share.js')
      document.head.appendChild(recaptchaScript)
    },
  };
</script>
