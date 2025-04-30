<template>
    <div>
      <h1>Mis Compras</h1>
      <ul>
        <li v-for="purchase in purchases" :key="purchase.id">
          Id de Curso: {{ purchase.course_id }} - Fecha: {{ purchase.date }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import api from '@/services/api';
  
  export default {
    data() {
      return {
        purchases: [],
      };
    },
    created() {
      const email = localStorage.getItem('userEmail');
      api.getClientPurchases(email)
        .then((response) => {
          this.purchases = response.data;
        })
        .catch((error) => {
          console.error('Error al cargar las compras:', error);
        });
    },
  };
  </script>