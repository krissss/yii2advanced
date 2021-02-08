<template>
  <div id="loading" class="mask" style="display: none"></div>
</template>

<script>
export default {
  name: "Loading",
}
</script>

<style scoped lang="scss">
@import "../../css/mask";

#loading {
  color: #fff;
  font-size: 40px;
  text-align: center;
  padding-top: 50vh;
}
</style>
