<!-- frontend/src/pages/Home.vue -->
<template>
  <div>
    <h1>Home</h1>
     <DevAuthDebug />
    <div v-if="user">
      ようこそ、{{ user }} さん
    </div>
    <div v-else>
      ログインしていません
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { getUser } from '../utilities/auth.ts'
import DevAuthDebug from "../components/Debug.vue"

const user = ref(null)

onMounted(async () => {
  try {
    const result = await getUser()
    console.log('APIからのレスポンス:', result)
    user.value = result
  } catch (e) {
    console.log('未ログイン、またはエラー:', e)
  }
})
</script>