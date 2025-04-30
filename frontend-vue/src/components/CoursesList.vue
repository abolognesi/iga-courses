<template>
    <div>
      <h1>Cursos Disponibles</h1>
      <ul>
        <li v-for="course in courses" :key="course.id">
          <strong>{{ course.name }}</strong> - ${{ course.price }}
          <button @click="purchaseCourse(course)">Comprar</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import api from '@/services/api';
  
  export default {
    data() {
      return {
        courses: [],
      };
    },
    created() {
      this.fetchCourses();
    },
    methods: {
      fetchCourses() {
        api.getCourses()
          .then((response) => {
            this.courses = response.data;
          })
          .catch((error) => {
            console.error('Error al cargar los cursos:', error);
          });
      },
      purchaseCourse(course) {
        this.$router.push({ name: 'Shopping', query: { courseId: course.id } });
      },
    },
  };
  </script>