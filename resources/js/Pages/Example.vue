<template>
  <layout>
    <div class="text">hello vue</div>
    <div class="text">{{ fromServer }}</div>
  </layout>
</template>

<script>
import Layout from "../Components/Layout";
import {http} from "../plugins";
export default {
  name: "Example",
  components: {Layout},
  data() {
    return {
      fromServer: ''
    }
  },
  async mounted() {
    this.fromServer = await http.get('site/index')
  }
}
</script>

<style scoped lang="scss">
.text {
  font-size: 50px;
  margin-top: 40px;
  text-align: center;
}
</style>
