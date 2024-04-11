// api.js
import axios from 'axios';

// Создаем экземпляр Axios с нужной конфигурацией
const api = axios.create({
<<<<<<< HEAD
    baseURL: 'https://rustudy.sprint.1t.ru/', // RL
=======
    baseURL: 'http://localhost:8000/', // RL
>>>>>>> 4dc915241025ad6c35266f8529aed3074e7b8fbf
    headers: {
        'Content-Type': 'application/json',
    },
});

export default api;
