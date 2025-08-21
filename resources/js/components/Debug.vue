<!-- src/components/DevAuthDebug.vue -->
<script setup lang="ts">
import { ref } from "vue";
import { runAuthDebug } from "../utilities/debugAuth";

const running = ref(false);
const output = ref<any>(null);

async function run() {
  running.value = true;
  output.value = await runAuthDebug();
  running.value = false;
}
</script>

<template>
  <div style="padding:12px; border:1px dashed #ccc; border-radius:12px; margin:12px 0;">
    <button @click="run" :disabled="running" style="padding:8px 12px; border:1px solid #999; border-radius:8px;">
      {{ running ? "Running..." : "Run Auth Debug" }}
    </button>
    <pre v-if="output" style="white-space:pre-wrap; font-size:12px; margin-top:12px;">{{ output }}</pre>
  </div>
</template>
