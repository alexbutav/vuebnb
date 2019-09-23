<template>
    <div class="listing-save" @click.stop="toggleSaved()">
        <button v-if="button">
            <i class="fa fa-lg" :class="[isListingSaved ? 'fa-heart' : 'fa-heart-o']"></i>
            {{ message }}
        </button>
        <i v-else class="fa fa-lg" :class="[isListingSaved ? 'fa-heart' : 'fa-heart-o']"></i>
    </div>
</template>

<script>
    export default {
        props: [ 'id', 'button' ],
        methods: {
            toggleSaved() {
                this.$store.commit('toggleSaved', this.id);
            }
        },
        computed: {
            isListingSaved() {
                return this.$store.state.saved.find(saved => saved === this.id);
            },
            message() {
                return this.isListingSaved ? 'Saved' : 'Save';
            }
        }
    }
</script>

<style>
    .listing-save {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
    }

    .listing-save .fa-heart-o { color: #fff; }
    .listing-save .fa-heart { color: #ff5a5f; }

    .listing-save i { padding-right: 4px; }
    .listing-save button .fa-heart-o { color: #808080; }
</style>