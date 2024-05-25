import { defineStore } from 'pinia';
import axios from 'axios';

export const useProgramStore = defineStore('programStore', {
    state: () => ({
        program: [],
        error: null,
    }),
    actions: {
        async fetchPrograms() {
            try {
                const response = await axios.get('/api/programs');
                this.program = response.data;
            } catch (error) {
                this.error = error;
                console.error('Error fetching programs:', error);
            }
        },
    },

});
