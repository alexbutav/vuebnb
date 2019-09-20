<template>
  <div>
    <header-image 
        @header-clicked='openModal' 
        :image-url="this.images[0]"
    ></header-image>
    <div class="container">
        <h1>{{ title }}</h1>
        <p>{{ address }}</p>
        <hr>
        <div class="about">
            <h3>About this listing</h3>
            <expandable-text>{{ about }}</expandable-text>
        </div>
        <div class="lists">
            <feature-list title="Amenities" :items="amenities"  v-slot='item'>
                <i class="fa fa-lg" :class="item.icon"></i>
                <span>{{ item.title }}</span>
            </feature-list>
            <feature-list title="Prices"  :items="prices"  v-slot='item'>
                {{ item.title }}: <strong>{{ item.value }}</strong>
            </feature-list>
        </div>
    </div>
    <modal-window ref="imagemodal">
        <image-carousel :images="images"></image-carousel>
    </modal-window>
  </div>
</template>

<script>

import { populateAmenitiesAndPrices } from '../helpers';

import ImageCarousel from './ImageCarousel';
import HeaderImage from './HeaderImage';
import FeatureList from './FeatureList';
import ModalWindow from './ModalWindow';
import ExpandableText from './ExpandableText';

let model = populateAmenitiesAndPrices(JSON.parse(window.vuebnb_listing_model));

export default {
    data() {
        return model;
    },    
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    components: {
        ImageCarousel,
        FeatureList,
        HeaderImage,
        ModalWindow,
        ExpandableText
    }
}
</script>

<style>
    .about {
        margin-top: 2em;
    }

    .about h3 {
        font-size: 22px;
    }
</style>