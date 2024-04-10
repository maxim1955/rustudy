// api.js
import axios from 'axios';

// Создаем экземпляр Axios с нужной конфигурацией
const api = axios.create({
    baseURL: 'http://localhost:8000/', // RL
    headers: {
        'Content-Type': 'application/json',
    },
});

export default api;
