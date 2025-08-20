// src/utilities/auth.ts
import api from './axios'; // ← axios.ts に統一

export async function getUser() {
  await api.get('/sanctum/csrf-cookie');
  const res = await api.get('/api/user');
  return res.data;
}
