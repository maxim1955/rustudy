<template>
  <section class="test">
    <div class="test_wrap">
      <div class="test_box" :style="{background: `url(${nameTest.image})`,backgroundSize: 'contain',backgroundRepeat: 'no-repeat'}">
        <p class="test_box__title">{{ nameTest.name }}</p>
        <router-link :to="{ name: 'testPage', params: {testId: nameTest.id }}">
          <v-test-button/>
        </router-link>
      </div>
    </div>
  </section>
</template>
<script setup>
import VTestButton from "@/components/v-test-button.vue";
import Header from "@/App.vue";
import Footer from "@/App.vue";

const props = defineProps({
  nameTest: {
    type: Object,
    required: true,
  }
})
console.log(props.nameTest)
</script>
<style scoped>

</style>
