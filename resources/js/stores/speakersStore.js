import { defineStore } from 'pinia';
import axios from 'axios';

export const useSpeakerStore = defineStore('speakerStore', {
    state: () => ({
        speakers: [],
        error: null,
    }),
    actions: {
        async fetchSpeakers() {
            try {
                const response = await axios.get('/api/speakers');
                this.speakers = response.data;
            } catch (error) {
                this.error = error;
                console.error('Error fetching speakers:', error);
            }
        },
    },

});
