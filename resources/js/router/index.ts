import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'
import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
// import NodeDetail from '../pages/NodeDetail.vue'

const routes = [
  { path: '/', name: 'Home', component: Home, meta: { requiresAuth: true } },
  { path: '/login', name: 'Login', component: Login, meta: { guestOnly: true } },
  // { path: '/node/:id', name: 'NodeDetail', component: NodeDetail, meta: { requiresAuth: true } },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

/**
 * 認証チェック関数
 */
async function checkAuth(): Promise<boolean> {
  try {
    const res = await axios.get('http://localhost/api/user', {
      withCredentials: true,
    })
    return !!res.data
  } catch {
    return false
  }
}

/**
 * ナビゲーションガード
 */
router.beforeEach(async (to, from, next) => {
  const isLoggedIn = await checkAuth()

  if (to.meta.requiresAuth && !isLoggedIn) {
    // 認証必須ルートなのに未ログイン → /login へ
    next('/login')
  } else if (to.meta.guestOnly && isLoggedIn) {
    // ゲスト専用ルートにログイン済みで来た → / に戻す
    next('/')
  } else {
    next()
  }
})

export default router
