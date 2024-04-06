import { defineStore } from 'pinia'
// import postcode from '@/data/postcode.json'

const usePostcodeStore = defineStore('PostcodeStore', {
    state: () => {
        return {
            checkAddress: {}
        }
    },

})

export default usePostcodeStore