import api from "@/dbquery/dbConnect";


// Функция для выполнения GET-запроса для получения партнеров
export const getAffiche = async () => {
    try {
        console.log(import.meta.env)
        const response = await api.get('api/afishas');
        console.log(response)
        return response.data;
    } catch (error) {
        console.error('Ошибка при запросе===:', error);
        throw error;
    }
};
