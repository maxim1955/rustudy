<template>
  <div class="custom-select" :tabindex="tabindex" @blur="open = false">
    <div class="selected" :class="{ open: open }" @click="open = !open">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="19" viewBox="0 0 15 19" fill="none">
        <path d="M6.79289 18.7071C7.18342 19.0976 7.81658 19.0976 8.20711 18.7071L14.5711 12.3431C14.9616 11.9526 14.9616 11.3195 14.5711 10.9289C14.1805 10.5384 13.5474 10.5384 13.1569 10.9289L7.5 16.5858L1.84315 10.9289C1.45262 10.5384 0.819457 10.5384 0.428932 10.9289C0.0384078 11.3195 0.0384078 11.9526 0.428932 12.3431L6.79289 18.7071ZM6.5 0L6.5 18H8.5L8.5 0L6.5 0Z" fill="#0A2B49"/>
      </svg>
      {{ selected.value }}
    </div>
    <div class="items" :class="{ selectHide: !open }">
      <div
          v-for="(option, i) of options"
          :key="i"
          @click="
          selected = option;
          open = false;
          $emit('input', option);
        "
      >

        {{ option.value }}
      </div>
    </div>
  </div>
</template>

<script >
export default {
  props: {
    options: {
      type: Array,
      required: true,
    },
    default: {
      type: String,
      required: false,
      default: null,
    },
    tabindex: {
      type: Number,
      required: false,
      default: 0,
    },
  },
  data() {
    return {
      selected: this.default
          ? this.default
          : this.options.length > 0
              ? this.options[0]
              : null,
      open: false,
    };
  },
  mounted() {
    this.$emit("input", this.selected);
  },
};
</script>

<style scoped>
.selected{
  display: flex;
  justify-content: space-between;
  flex-direction: row-reverse;
  align-items: center;
  padding: 0 10px;
}
.custom-select {
  position: relative;
  width: 70%;
  text-align: left;
  outline: none;
  height: 47px;
  line-height: 47px;
}

.custom-select .selected {
  border-radius: 6px;
  border: 1px solid #666666;
  padding-left: 1em;
  cursor: pointer;
  user-select: none;

}

.custom-select .selected.open {
  background: white;
  border-radius: 6px 6px 0px 0px;
}

.custom-select .selected:after {
  position: absolute;
  content: '';
  top: 22px;
  right: 1em;
  width: 0;
  height: 0;
}
.custom-select .items{
  background: white;
  border-radius: 10px;
  padding-top: 10px;
}
.custom-select .items div {
  color: rgba(10, 43, 73, 1);
  padding-left: 1em;
  margin: 0 10px;
  cursor: pointer;
  user-select: none;
}

.custom-select .items div:hover {
  border-radius: 20px;
  background: rgba(136, 176, 224, 0.66);

}

.selectHide {
  display: none;
}
</style>
