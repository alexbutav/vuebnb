import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import axios from 'axios';
import router from './router';

export default new Vuex.Store({
    state: {
        auth: false,
        saved: [],
        listings: [],
        listing_summaries: []
    },
    mutations: {
        appData(state, { route, data }) {
            if(data.auth) state.auth = true;
            if(route === 'listing') {
                state.listings.push(data.listing);
            } else {
                state.listing_summaries = data.listings;
            }
        }, 
        toggleSaved(state, id) {
            let index = state.saved.findIndex(saved => saved === id);
            if(index === -1) {
                state.saved.push(id);
            } else {
                state.saved.splice(index, 1);
            }
        }
    },
    actions: {
        toggleSaved({ commit, state }, id) {
            if(state.auth) {
                axios.post('/api/user/toggle_saved', { id })
                    .then( () => commit('toggleSaved', id)
                );
            } else {
                router.push('/login');
            }
        }
    },
    getters: {
        savedSummaries(state) {
            return state.listing_summaries.filter(
                item => state.saved.indexOf(item.id) > -1
            );
        },
        getListing(state) {
            return id => state.listings.find(listing => id == listing.id);
        }
    }
});