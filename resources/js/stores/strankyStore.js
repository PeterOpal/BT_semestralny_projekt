import { defineStore } from 'pinia';
import axios from 'axios';

export const useStrankyStore = defineStore('strankyStore', {
    state: () => ({
        stranky: [],
        error: null,
    }),
    actions: {
        async fetchStranky() {
            try {
                const response = await axios.get('/api/stranky');
                this.stranky = response.data;
            } catch (error) {
                this.error = error;
                console.error('Error fetching stranky:', error);
            }
        },
    },

});
