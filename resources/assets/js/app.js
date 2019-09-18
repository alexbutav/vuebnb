
import Vue from 'vue';
import { populateAmenitiesAndPrices } from './helpers';

import ImageCarousel from './components/ImageCarousel';
import HeaderImage from './components/HeaderImage';
import ModalWindow from './components/ModalWindow';

let model = populateAmenitiesAndPrices(JSON.parse(window.vuebnb_listing_model));

// 
var app = new Vue({
    el: '#app',
    data: {    
        ...model,
        contracted: true
    },
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    components: {
        ImageCarousel,
        HeaderImage,
        ModalWindow
    }
});