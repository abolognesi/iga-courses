<template>
    <div>
      <h1>Estadísticas de Compras</h1>
      <ul>
        <li v-for="statistic in statistics" :key="statistic.course_id">
          Curso ID: {{ statistic.course_id }} - Total: {{ statistic.total }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import api from '@/services/api';
  
  export default {
    data() {
      return {
        statistics: [],
      };
    },
    created() {
      api.getStatisticsAdmin().then((response) => {
        this.statistics = response.data;
      });
    },
  };
  </script>