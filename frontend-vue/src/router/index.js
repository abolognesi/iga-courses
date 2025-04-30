// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import CoursesList from '@/components/CoursesList.vue';
import PurchaseForm from '@/components/PurchaseForm.vue';
import MyPurchasesView from '@/components/MyPurchases.vue';
import AdminPanel from '@/components/AdminPanel.vue';

const routes = [
  { path: '/', name: 'Home', component: CoursesList },
  { path: '/shopping', name: 'Shopping', component: PurchaseForm },
  { path: '/my-purchases', name: 'MyPurchases', component: MyPurchasesView },
  { path: '/admin', name: 'Admin', component: AdminPanel },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;