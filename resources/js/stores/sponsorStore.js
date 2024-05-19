import { defineStore } from 'pinia';
import axios from 'axios';

export const useSponsorStore = defineStore('sponsorStore', {
    state: () => ({
        sponsors: [],
        error: null,
    }),
    actions: {
        async fetchSponsors() {
            try {
                const response = await axios.get('/api/sponsors');
                this.sponsors = response.data;
            } catch (error) {
                this.error = error;
                console.error('Error fetching sponsors:', error);
            }
        },
    },

});
