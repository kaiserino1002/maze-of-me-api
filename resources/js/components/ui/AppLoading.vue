<script setup lang="ts">
import { Vue3Lottie } from 'vue3-lottie';
import Indicator from '@/assets/animations/Indicator.json';

defineProps<{ show?: boolean }>();
</script>

<template>
  <teleport to="body">
    <div
      v-if="show"
      id="app-loading"
      aria-busy="true"
      aria-live="polite"
      role="status"
    >
      <div class="overlay">
        <Vue3Lottie
          class="loading-animation"
          :animation-data="Indicator"
          :height="200"
          :width="200"
          :loop="true"
        />
      </div>
    </div>
  </teleport>
</template>

<style scoped lang="scss">
#app-loading {
  .overlay {
    position: fixed;
    inset: 0;
    z-index: 1040;
    background-color: rgba(244, 245, 246, 0.5); // 半透明背景
  }
  .loading-animation {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}
</style>
