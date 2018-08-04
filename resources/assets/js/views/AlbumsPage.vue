<template>
    <div class="uk-section">
        <div class="uk-container uk-container-expand">

            <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-align-center">
                <h1 class="uk-heading-bullet">Albums</h1>
                <ul class="uk-list uk-list-striped">
                    <li v-for="(album, key) in AllAlbums" :key="key"><router-link :to="'/album/'+album.link">{{album.name}}</router-link></li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    import Aplayer from 'vue-aplayer'
    export default {
        name: "AlbumsPage",
        components: { Aplayer },
        data(){
            return {
                AllAlbums: ''
            }
        },
        mounted(){
            this.fetchAllMusic()
        },
        methods: {
            fetchAllMusic(){
                let mu = this
                this.axios.get('http://127.0.0.1:8000/api/getallalbums')
                    .then( response => {
                        console.log(response.data)
                        mu.AllAlbums = response.data.files
                        console.log(mu.AllAlbums)
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