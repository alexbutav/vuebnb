<template>
  <div>
    <header-image 
        v-if="listing.images[0]"
        @header-clicked='openModal' 
        :image-url="listing.images[0]"
        :id="listing.id"
    ></header-image>
    <div class="container">
        <h1>{{ listing.title }}</h1>
        <p>{{ listing.address }}</p>
        <hr>
        <div class="about">
            <h3>About this listing</h3>
            <expandable-text>{{ listing.about }}</expandable-text>
        </div>
        <div class="lists">
            <feature-list title="Amenities" :items="listing.amenities"  v-slot='item'>
                <i class="fa fa-lg" :class="item.icon"></i>
                <span>{{ item.title }}</span>
            </feature-list>
            <feature-list title="Prices"  :items="listing.prices"  v-slot='item'>
                {{ item.title }}: <strong>{{ item.value }}</strong>
            </feature-list>
        </div>
    </div>
    <modal-window ref="imagemodal">
        <image-carousel :images="listing.images"></image-carousel>
    </modal-window>
  </div>
</template>

<script>

// Helper
import { populateAmenitiesAndPrices } from '../helpers';

// components
import ImageCarousel from './ImageCarousel';
import HeaderImage from './HeaderImage';
import FeatureList from './FeatureList';
import ModalWindow from './ModalWindow';
import ExpandableText from './ExpandableText';

export default { 
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    computed: {
        listing() {
            return populateAmenitiesAndPrices(
                this.$store.getters.getListing(this.$route.params.listing)
            );
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