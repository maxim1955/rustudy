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
                /*
                this.previews = allNews.filter(item => item.tag === 'Анонсы');
                this.news = allNews.filter(item => item.tag === 'Новости');
                this.events = allNews.filter(item => item.tag === 'Мероприятия');
                */


                // Проходимся по всем новостям
                for (const el of this.allNews) {
                    // Проверяем, есть ли уже новость с таким идентификатором в массиве `new`
                    const index = this.new.findIndex(item => item.id === el.id);
                    // Если индекс элемента равен -1, значит элемента нет в массиве `new`
                    if (index === -1) {
                        console.log('new push');
                        const response = await axios.get(`/api/publications/${el.id}`);
                        const data = response.data.data;
                        this.new.push(data);
                    }
                }
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        async ShowMore(page) {
            try {
                const response = await axios.get(`/api/publications?page=${page}`);
                const data = response.data.data.data;
                for (const elem of data) {
                    this.allNews.push(elem);
                    // Проверяем, есть ли уже новость с таким идентификатором в массиве `new`
                    const index = this.new.findIndex(item => item.id === elem.id);
                    // Если индекс элемента равен -1, значит элемента нет в массиве `new`
                    if (index === -1) {
                        console.log('new push');
                        const result = await axios.get(`/api/publications/${elem.id}`);
                        const data = result.data.data;
                        this.new.push(data);
                    }
                }
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        sliceItem(page) {
            console.log(this.allNews.length)
            let test = this.allNews.slice(0, -10)
            this.allNews = test
            console.log(test.length)
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
