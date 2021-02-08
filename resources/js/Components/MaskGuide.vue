<template>
  <div class="mask" @click.prevent="close()">
    <div class="guide" :style="guideStyle">
      <img :src="img" :style="imgStyle">
    </div>
  </div>
</template>

<script>
import {tools} from "../plugins";

export default {
  name: "MaskGuide",
  props: {
    img: String,
    width: Number,
    height: Number,
    top: Number,
    left: Number,
    right: Number
  },
  computed: {
    guideStyle() {
      if (this.left || this.right) {
        return null
      }
      return {
        top: tools.px2vw(this.top),
      }
    },
    imgStyle() {
      const base = {
        width: tools.px2vw(this.width),
        height: tools.px2vw(this.height),
      }
      if (this.left || this.right) {
        base['position'] = 'absolute'
        base['top'] = tools.px2vw(this.top)
        if (this.left) {
          base['left'] = tools.px2vw(this.left)
        }
        if (this.right) {
          base['right'] = tools.px2vw(this.right)
        }
      }

      return base
    }
  },
  methods: {
    close() {
      this.$emit('close')
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../css/mask";

.guide {
  position: fixed;
  z-index: 999;
  width: 100%;
  text-align: center;
}
</style>
