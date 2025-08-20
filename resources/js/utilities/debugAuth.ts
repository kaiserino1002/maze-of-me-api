// src/utilities/debugAuth.ts
import axios, { AxiosError } from "axios";

export const api = axios.create({
  baseURL: "http://localhost:3000", // APIは3000固定
  withCredentials: true,
  headers: { Accept: "application/json" },
  // 念のため明示
  xsrfCookieName: "XSRF-TOKEN",
  xsrfHeaderName: "X-XSRF-TOKEN",
});

type DebugResult = {
  origin: string;
  baseURL: string;
  cookiesBefore: string;
  csrf: { ok: boolean; status?: number; headers?: Record<string, string> | null; error?: string };
  cookiesAfterCsrf: string;
  user: { ok: boolean; status?: number; data?: any; headers?: Record<string, string> | null; error?: string };
};

function pickHeaders(h: any): Record<string, string> {
  const keys = [
    "access-control-allow-origin",
    "access-control-allow-credentials",
    "set-cookie",
    "vary",
    "content-type",
  ];
  const out: Record<string, string> = {};
  for (const k of keys) if (h?.[k] != null) out[k] = String(h[k]);
  return out;
}

export async function runAuthDebug(): Promise<DebugResult> {
  const result: DebugResult = {
    origin: window.location.origin,
    baseURL: api.defaults.baseURL || "",
    cookiesBefore: document.cookie || "",
    csrf: { ok: false, headers: null },
    cookiesAfterCsrf: "",
    user: { ok: false, headers: null },
  };

  console.group("[AuthDebug] start");
  console.log("origin           :", result.origin);
  console.log("api baseURL      :", result.baseURL);
  console.log("cookies(before)  :", result.cookiesBefore);

  // 1) CSRF Cookie を取得
  try {
    const r = await api.get("/sanctum/csrf-cookie");
    result.csrf.ok = r.status === 204;
    result.csrf.status = r.status;
    result.csrf.headers = pickHeaders(r.headers);
    console.log("csrf status      :", r.status, r.statusText);
    console.log("csrf headers     :", result.csrf.headers);
  } catch (e) {
    const err = e as AxiosError;
    result.csrf.ok = false;
    result.csrf.status = err.response?.status;
    result.csrf.headers = err.response ? pickHeaders(err.response.headers) : null;
    result.csrf.error = err.message;
    console.warn("csrf error       :", err.message, err.response?.status, err.response?.data);
  }

  // 2) 取得後の Cookie を確認
  result.cookiesAfterCsrf = document.cookie || "";
  console.log("cookies(after)   :", result.cookiesAfterCsrf);

  // 3) /api/user を叩く
  try {
    const r = await api.get("/api/user");
    result.user.ok = r.status === 200;
    result.user.status = r.status;
    result.user.data = r.data;
    result.user.headers = pickHeaders(r.headers);
    console.log("user status      :", r.status);
    console.log("user data        :", r.data);
  } catch (e) {
    const err = e as AxiosError;
    result.user.ok = false;
    result.user.status = err.response?.status;
    result.user.headers = err.response ? pickHeaders(err.response.headers) : null;
    result.user.error = err.message;
    console.warn("user error       :", err.message, err.response?.status, err.response?.data);
  }

  console.groupEnd();
  return result;
}
