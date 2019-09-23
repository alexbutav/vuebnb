<template>
    <div class="listing-summary-group">
        <h1>Places in {{ country }}</h1>
        <div class="listing-carousel">
            <div class="controls">
                <carousel-control @change-image="change" dir="left" :style="leftArrowStyle"></carousel-control>
                <carousel-control @change-image="change" dir="right" :style="rightArrowStyle"></carousel-control>
            </div>
            <div class="listing-summaries-wrapper">
                <div class="listing-summaries" :style="style">
                    <listing-summary
                        v-for="listing in listings"
                        :listing="listing"
                        :key="listing.id"
                    ></listing-summary>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ListingSummary from './ListingSummary';
import CarouselControl from './CarouselControl';

const rowSize = 3;
const listingSummaryWidth = 365; //px

export default {
    data() {
        return {
            offset: 0
        }
    },
    methods: {
        change(val) {
            this.offset = (this.offset + val + (this.listings.length - rowSize)) % (this.listings.length - rowSize);
        }
    },
    props: ['country', 'listings'],
    components: {
        ListingSummary,
        CarouselControl
    },
    computed: {
        style() {
            return { transform: `translateX(${this.offset * -365}px)` }
        },
        leftArrowStyle() {
            return { visibility: (this.offset > 0) ? 'visible' : 'hidden' }
        },
        rightArrowStyle() {
            return { visibility: (this.offset < this.listings.length - this.offset) ? 'visible' : 'hidden' }
        }
    }
}
</script>

<style>
    .listing-summary-group {
        padding-bottom: 20px;
    }

    .listing-summaries {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        transition: transform .5s ease-in-out;
    }

    .listing-summaries > .listing-summary {
        margin-right: 15px;
    }

    .listing-summaries > .listing-summary:last-child {
        margin-right: 0;
    }

    .listing-carousel {
        position: relative;
    }

    .listing-carousel .controls {
        display: flex;
        justify-content: space-between;
        position: absolute;
        top: calc(50% - 45px);
        left: -45px;
        width: calc(100% + 90px);
    }

    .listing-carousel .controls .carousel-control {
        color: #c5c5c5;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .listing-summaries-wrapper {
        overflow: hidden;
    }
</style>