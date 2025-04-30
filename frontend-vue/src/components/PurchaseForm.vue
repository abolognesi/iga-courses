<!-- src/components/FormularioCompra.vue -->
<template>
    <div>
      <h1>Comprar Curso</h1>
      <form @submit.prevent="registerPurchase">
        <label for="name">Nombre:</label>
        <input v-model="name" id="name" required />
  
        <label for="email">Email:</label>
        <input v-model="email" id="email" type="email" required />
  
        <label for="cell_phone">Celular:</label>
        <input v-model="cell_phone" id="cell_phone" required />
  
        <button type="submit">Comprar</button>
      </form>
    </div>
  </template>
  
  <script>
  import api from '@/services/api';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        cell_phone: '',
        courseId: null,
      };
    },
    created() {
      this.courseId = this.$route.query.courseId;
    },
    methods: {
      registerPurchase() {
        const data = {
          name: this.name,
          email: this.email,
          cell_phone: this.cell_phone,
          course_id: this.courseId,
        };
  
        api.registerPurchase(data)
          .then(() => {
            localStorage.setItem('userEmail', this.email); 
            alert('Compra realizada con éxito');
            this.$router.push({ name: 'MyPurchases' });
          })
          .catch((error) => {
            console.error('Error al registrar la compra:', error);
          });
      },
    },
  };
  </script>