<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/login">Login</router-link>
    </nav>
    <hr />
    <router-view />
  </div>
</template>

<script setup>
import { onMounted } from 'vue'; 
import api from 'axios';    

onMounted(async () => {
  try {
    // CSRF cookie取得
    await api.get('/sanctum/csrf-cookie');

    // 認証状態確認
    const res = await api.get('/api/user');
    console.log('ログイン中のユーザー:', res.data);
  } catch (error) {
    console.log('未ログイン or 401:', error.response?.status);
  }
});
</script>

<style scoped>
nav {
  margin: 1rem;
}
</style>
