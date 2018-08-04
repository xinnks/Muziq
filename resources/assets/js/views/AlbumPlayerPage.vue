<template>
    <div class="uk-section">
        <div class="uk-container uk-container-expand">
            <span v-if="!AllSongs" class="uk-margin-small-right mu-spinner" uk-spinner="ratio: 3"></span>
            <div v-if="AllSongs" class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-align-center">
                <h1 class="uk-heading-bullet">{{AlbumName+' - '+ArtistName}}</h1>
                <!--<h3 class="uk-card-title">Dashboard</h3>-->
                <aplayer autoplay :music="FirstSong" :list="AllSongs" theme="pic" controls />
            </div>

        </div>
    </div>
</template>

<script>
    import Aplayer from 'vue-aplayer'
    export default {
        name: "AlbumPlayerPage",
        components: { Aplayer },
        data(){
            return {
                AllSongs: '',
                FirstSong: '',
                AlbumName: '',
                ArtistName: ''
            }
        },
        mounted(){
            this.fetchAllMusic()
        },
        methods: {
            fetchAllMusic(){
                let mu = this
                this.axios.get('http://127.0.0.1:8000/api/getalbummusic/'+mu.$route.params.unique_id)
                    .then( response => {
                        console.log(response.data)
                        mu.AllSongs = response.data.files
                        mu.AlbumName = response.data.album_name
                        mu.ArtistName = response.data.artist_name
                        mu.FirstSong = mu.AllSongs[0]
                        console.log(mu.FirstSong)
                    })
                    .catch( error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>
    .mu-spinner{
        color: #ffffff !important;
    }
</style>