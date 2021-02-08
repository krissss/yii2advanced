<template>
  <div v-if="src" class="music" @click="musicClick">
    <!--<img v-if="audioEl" src="../../image/post/music2.png" alt="音乐" :class="{'rotate': imageRotate}">-->
    <audio :src="src" loop autoplay></audio>
  </div>
</template>

<script>
export default {
  name: "AudioBg",
  data() {
    return {
      audioEl: null,
      imageRotate: true
    }
  },
  props: {
    src: String
  },
  methods: {
    startAudio() {
      // 谷歌最新规范，必须与页面有交互后才能播放音频
      if (this.audioEl.paused) {
        this.imageRotate = false
        // 当音乐未播放时，添加一次性事件
        const triggerEl = document.querySelector('html')
        const listenEvent = 'click' // touch 事件不算交互
        const _this = this
        triggerEl.addEventListener(listenEvent, function fn() {
          _this.audioEl.play()
          _this.imageRotate = true
          triggerEl.removeEventListener(listenEvent, fn)
        })
      }
    },
    musicClick() {
      if (this.audioEl.paused) {
        this.audioEl.play()
        this.imageRotate = true
      } else {
        this.audioEl.pause()
        this.imageRotate = false
      }
    }
  },
  mounted() {
    if (this.src) {
      // 延迟检查音乐是否播放
      setTimeout(() => {
        this.audioEl = document.querySelector('.music audio')
        this.startAudio()
      }, 500)
    }
  }
}
</script>

<style scoped lang="scss">
.music {
  position: fixed;
  right: 23px;
  top: 23px;

  img {
    width: 52px;
    height: 52px;
  }
}

$rotateTs: 3s;
.rotate {
  animation: rotating $rotateTs linear infinite
}

@keyframes rotating {
  from {
    transform: rotate(0)
  }
  to {
    transform: rotate(360deg)
  }
}
</style>
