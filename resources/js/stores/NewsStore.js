import {defineStore} from 'pinia'
import axios from "axios";

const useNewsStore = defineStore('NewsStore', {
    state: () => {
        return {
            activeTab: 'Все',
            currentActiveSlide: 0,
            allNews: [],
            previews: [],
            news: [],
            events: [],
            totalPage: Number,
        }
    },
    actions: {
        async fetchNews() {
            try {
                const response = await axios.get(`/api/publications?page=1`);
                this.totalPage = response.data.data.meta.pagination.total_pages
                const data = response.data.data.data;
                this.allNews = data;
                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        async ShowMore(page) {
            try {
                const response = await axios.get(`/api/publications?page=${page}`);
                const data = response.data.data.data;
               data.forEach((elem)=>{
                    this.allNews.push(elem)
                })
                console.log(this.allNews)

                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/
            } catch (error) {
                console.error('Failed to fetch news:', error);c
            }
        },
         sliceItem(page) {
           this.allNews.slice(0,-10)
        },
    },
})

export default useNewsStore
