<template>
  <div class="bg">
    <div class="title">{{ title }}</div>
    <slot></slot>
    <loading/>
    <!--<audio-bg :src=""/>-->
  </div>
</template>

<script>
import Loading from "./Loading";
import AudioBg from "./AudioBg";

export default {
  name: "Layout",
  components: {AudioBg, Loading},
  computed: {
    title() {
      return document.title
    }
  }
}
</script>

<style scoped lang="scss">
.bg {
  width: 100%;
  height: 100%;
}

.title {
  text-align: center;
}
</style>
