import {defineStore} from 'pinia'
import axios from "axios";

const useNewsStore = defineStore('NewsStore', {
    state: () => {
        return {
            activeTab: 'allNews',
            currentActiveSlide: 0,
            allNews: [],
            publications: [],
            events: [],
            totalPage: Number,
            publication: [],
            activities: [],
            activity: [],
            event: [],
            currentPage: Number,

        }
    },
    actions: {

        async fetchAllNews() {
            try {
                 axios.all([
                    axios.get(`/api/publications`),
                    axios.get(`/api/activities`),
                    axios.get(`/api/events`),
                ]).then(axios.spread((newsData, activitiesData, eventsData) => {
                    console.log(newsData.data.data.data)
                    this.publications = newsData.data.data.data;
                    this.activities = activitiesData.data.data.data;
                    this.events = eventsData.data.data.data;

                    this.allNews = [...this.publications, ...this.activities, ...this.events];

                    // console.log(this.allNews)

                    for (const el of this.publications) {
                        // Проверяем, есть ли уже новость с таким идентификатором в массиве new
                        const exists = this.publication.some(item => item.id === el.id);
                        // Если такой новости еще нет, делаем запрос
                        if (!exists) {
                            // console.log('new push');
                            axios.get(`/api/publications/${el.id}`)
                            .then((response) => {
                                this.publication.push(response.data.data);
                            })


                        }
                    }
                }))



            }
            catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },

        async fetchNews() {
            try {
                const response = await axios.get(`/api/publications`);
                this.totalPage = response.data.data.meta.pagination.total_pages;
                this.currentPage = response.data.data.meta.pagination.current_page;
                const data = response.data.data.data;
                this.publications = data;

                console.log(response.data.data)
                /*      this.previews = allNews.filter(item => item.tag === 'Анонсы');
                      this.news = allNews.filter(item => item.tag === 'Новости');
                      this.events = allNews.filter(item => item.tag === 'Мероприятия');*/


                for (const el of this.publications) {
                    // Проверяем, есть ли уже новость с таким идентификатором в массиве new
                    const exists = this.publication.some(item => item.id === el.id);
                    // Если такой новости еще нет, делаем запрос
                    if (!exists) {
                        console.log('new push');
                        const response = await axios.get(`/api/publications/${el.id}`);
                        const data = response.data.data;
                        this.publication.push(data);
                    }
                }


                // this.allNews.forEach(async (el) => {
                //     const response = await axios.get(`/api/publications/${el.id}`);
                //     const data = response.data.data;

                //     this.new.push(data);
                //     // console.log(this.new)

                // })

            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        async ShowMore(page, name) {
            try {
                const response = await axios.get(`/api/${name}?page=${page}`);
                this.currentPage = response.data.data.meta.pagination.current_page;
                console.log(response)
                const data = response.data.data.data;
                let array;
                let newArray;

                if (name == 'activities') {
                    array = this.activities;
                    newArray = this.activity;
                }
                if (name == 'events') {
                    array = this.events;
                    newArray = this.event;
                }

                if (name == 'publications') {
                    array = this.publications;
                    newArray = this.publication;
                }

                console.log(array, newArray)

                data.forEach((elem) => {
                    array.push(elem);
                })

                for (const el of array) {
                    // Проверяем, есть ли уже новость с таким идентификатором в массиве new
                    const exists = newArray.some(item => item.id === el.id);
                    // Если такой новости еще нет, делаем запрос
                    if (!exists) {
                        console.log('new push');
                        const response = await axios.get(`/api/${name}/${el.id}`);
                        const data = response.data.data;
                        newArray.push(data);
                    }
                }

            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        sliceItem(name) {
            let array;

            this.currentPage = this.currentPage - 1;

            if (name == 'activities') {
                array = this.activities;
            }
            if (name == 'events') {
                array = this.events;
            }

            if (name == 'publications') {
                array = this.publications;
            }
            // console.log(this.allNews)
            array.slice(0, array.length)
        },

        async fetchActivities() {
            const response = await axios.get(`/api/activities`);
            this.totalPage = response.data.data.meta.pagination.total_pages;
            this.currentPage = response.data.data.meta.pagination.current_page;
            const data = response.data.data.data;
            this.activities = data;

            console.log(response.data.data)

            for (const el of this.activities) {
                // Проверяем, есть ли уже новость с таким идентификатором в массиве new
                const exists = this.activity.some(item => item.id === el.id);
                // Если такой новости еще нет, делаем запрос
                if (!exists) {
                    console.log('new push');
                    const response = await axios.get(`/api/activities/${el.id}`);
                    const data = response.data.data;

                    console.log(data)
                    this.activity.push(data);
                }
            }
        },

        async fetchEvents() {
            const response = await axios.get(`/api/events`);
            this.totalPage = response.data.data.meta.pagination.total_pages;
            this.currentPage = response.data.data.meta.pagination.current_page;
            const data = response.data.data.data;
            this.events = data;

            console.log(response.data.data.data)

            for (const el of this.events) {
                // Проверяем, есть ли уже новость с таким идентификатором в массиве new
                const exists = this.event.some(item => item.id === el.id);
                // Если такой новости еще нет, делаем запрос
                if (!exists) {
                    console.log('new push');
                    const response = await axios.get(`/api/events/${el.id}`);
                    const data = response.data.data;
                    this.event.push(data);
                }
            }
        },

    },
})

export default useNewsStore
