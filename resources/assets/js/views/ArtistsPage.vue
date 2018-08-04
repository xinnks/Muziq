<template>
    <div class="uk-section">
        <div class="uk-container uk-container-expand">

            <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-align-center">
                <h1 class="uk-heading-bullet">Artists</h1>
                <ul class="uk-list uk-list-striped">
                    <li v-for="(artist, key) in AllArtists" :key="key"><router-link :to="'/artist/'+artist.link">{{artist.name}}</router-link></li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    import Aplayer from 'vue-aplayer'
    export default {
        name: "ArtistsPage",
        components: { Aplayer },
        data(){
            return {
                AllArtists: ''
            }
        },
        mounted(){
            this.fetchAllArtists()
        },
        methods: {
            fetchAllArtists(){
                let mu = this
                this.axios.get('http://127.0.0.1:8000/api/getallartists')
                    .then( response => {
                        console.log(response.data)
                        mu.AllArtists = response.data.files
                        console.log(mu.AllArtists)
                    })
                    .catch( error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>

</style>