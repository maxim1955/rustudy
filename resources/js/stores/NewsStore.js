import { defineStore } from 'pinia'
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
        }
    },
    actions: {

        reset() {
            this.new.splice(0, this.new.length);
        },

        async fetchNews() {
            try {
                const response = await axios.get(`/api/publications`);
                this.totalPage = response.data.data.meta.pagination.total_pages
                const data = response.data.data.data;
                this.allNews = data;

                console.log(response.data.data.data)
                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/



                this.allNews.forEach(async (el) => {
                    const response = await axios.get(`/api/publications/${el.id}`);
                    const data = response.data.data;

                    this.new.push(data);


                    // console.log(this.new)

                })


            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        async ShowMore(page) {
            try {
                const response = await axios.get(`/api/publications?page=${page}`);
                const data = response.data.data.data;
                data.forEach((elem) => {
                    this.allNews.push(elem);

                })
                // console.log(this.allNews)

                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        sliceItem(page) {
            this.allNews.slice(0, -10)
        },

        // async getNew() {
        //     try {
        //         this.allNews.forEach(async (el) => {
        //             const response = await axios.get(`/api/publications/${el.id}`);
        //             const data = response.data.data;

        //                 this.new.push(data);
        //             // console.log(this.new)

        //         })

        //     } catch (error) {
        //         console.log(error)
        //     }
        // },

    },
})

export default useNewsStore
