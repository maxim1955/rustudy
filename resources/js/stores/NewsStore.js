import {defineStore} from 'pinia'
import axios from "axios";

const useNewsStore = defineStore('NewsStore', {
    state: () => {
        return {
            activeTab: 'Все',
            currentActiveSlide: 0,
            allNews: [],
            previews: [],
            // news: [],
            events: [],
            totalPage: Number,
            new: [],
            ids: []
        }
    },
    actions: {
        async fetchNews() {
            try {
                const response = await axios.get(`/api/publications`);
                this.totalPage = response.data.data.meta.pagination.total_pages
                const data = response.data.data.data;
                this.allNews = data;

                data.forEach(el => {
                    this.ids.push(el.id)
                })

                // this.ids = response.data.data.data

                console.log(response.data.data.data)
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
                    this.allNews.push(elem);

                    if (this.ids.includes(elem.id)) {
                        this.ids.push(elem.id);
                    }

                })
                console.log(this.allNews)

                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
         sliceItem(page) {
           this.allNews.slice(0,-10)
        },

        async getNew() {
            try {
                this.ids.forEach(async (el) => {
                    const response = await axios.get(`/api/publications/${el}`);
                    const data = response.data.data;

                    // console.log(data)
                    this.new.push(data);
                })

            } catch (error) {
                console.log(error)
            }
        },

    },
})

export default useNewsStore
