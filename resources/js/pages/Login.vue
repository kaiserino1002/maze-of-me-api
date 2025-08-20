<template>
  <button
    @click="redirectToGoogle"
    class="w-full py-2 bg-red-600 text-white rounded hover:bg-red-700"
  >
    Googleでログイン
  </button>
</template>

<script setup>
const redirectToGoogle = () => {
  window.location.href = 'http://localhost/auth/redirect/google'
}
</script>
