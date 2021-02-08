<template>
  <layout>
    <div class="text">hello vue</div>
  </layout>
</template>

<script>
import Layout from "../Components/Layout";
export default {
  name: "Example",
  components: {Layout}
}
</script>

<style scoped lang="scss">
.text {
  font-size: 50px;
  margin-top: 40px;
  text-align: center;
}
</style>
