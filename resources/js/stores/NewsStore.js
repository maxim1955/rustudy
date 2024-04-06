import { defineStore } from 'pinia'
import allNews from '@/data/news.js'
 const useNewsStore = defineStore('NewsStore', {
    state: () => {
        return {
            activeTab: 'Все',
            currentActiveSlide: 0,
            allNews,
            previews: allNews.filter(item => item.tag == 'Анонсы'),
            news: allNews.filter(item => item.tag == 'Новости'),
            events: allNews.filter(item => item.tag == 'Мероприятия'),
        }
    },

})

export default useNewsStore
