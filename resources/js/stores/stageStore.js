import { defineStore } from 'pinia';
import axios from 'axios';

export const useStageStore = defineStore('useStageStore', {
    state: () => ({
        stages: [],
        error: null,
    }),
    actions: {
        async fetchStages() {
            try {
                const response = await axios.get('/api/stages');
                this.stages = response.data;
            } catch (error) {
                this.error = error;
                console.error('Error fetching stages:', error);
            }
        },
    },

});
