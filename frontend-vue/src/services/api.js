import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8080',
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
  },
});

export default {
    // Obtener todos los cursos
    getCourses() {
        return apiClient.get('/courses');
    },

    // Registrar una nueva compra
    registerPurchase(data) {
        return apiClient.post('/shopping', data);
    },

    // Obtener las compras de un cliente
    getClientPurchases(email) {
        return apiClient.get('/shopping/client', { params: { email } });
    },

    // Obtener estadísticas de compras para el administrador
    getStatisticsAdmin() {
        return apiClient.get('/shopping/admin');
    },
};