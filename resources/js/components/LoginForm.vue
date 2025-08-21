<template>
  <div class="max-w-sm mx-auto mt-16 p-6 border rounded-xl shadow-lg bg-white">
    <h1 class="text-2xl font-bold mb-6 text-center">ログイン</h1>

    <form @submit.prevent="handleLogin">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">メールアドレス</label>
        <input
          v-model="email"
          type="email"
          class="w-full px-3 py-2 border rounded"
          required
        />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium mb-1">パスワード</label>
        <input
          v-model="password"
          type="password"
          class="w-full px-3 py-2 border rounded"
          required
        />
      </div>

      <button
        type="submit"
        class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        :disabled="loading"
      >
        {{ loading ? "ログイン中..." : "ログイン" }}
      </button>

      <p v-if="error" class="text-red-600 mt-4 text-sm text-center">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref('')
const loading = ref(false)
const router = useRouter()

const handleLogin = async () => {
  error.value = ''
  loading.value = true

  try {
    // 1. CSRFクッキー取得
    await axios.get('http://localhost:8000/sanctum/csrf-cookie', {
      withCredentials: true,
    })

    // 2. ログイン
    await axios.post(
      'http://localhost:8000/api/login',
      { email: email.value, password: password.value },
      { withCredentials: true }
    )

    // 3. ログイン成功 → ホーム画面へ遷移
    router.push('/')
  } catch (err) {
    error.value = 'ログインに失敗しました。メールアドレスとパスワードを確認してください。'
    console.error(err)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
input:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 1px #3b82f6;
}
</style>
