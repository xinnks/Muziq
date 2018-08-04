<template>
    <div class="uk-section">
        <div class="uk-container uk-container-expand">

            <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-align-center">
                <!--<h3 class="uk-card-title">Dashboard</h3>-->
                <aplayer autoplay :music="FirstSong" :list="AllSongs" theme="pic" controls />
            </div>

        </div>
    </div>
</template>

<script>
    import Aplayer from 'vue-aplayer'
    export default {
        name: "PlaylistsPage",
        components: { Aplayer },
        data(){
            return {
                AllSongs: '',
                SelectedSong: '',
                FirstSong: ''
            }
        },
        mounted(){
            this.fetchAllMusic()
        },
        methods: {
            fetchAllMusic(){
                let mu = this
                this.axios.get('http://127.0.0.1:8000/api/getallmusic')
                    .then( response => {
                        console.log(response.data)
                        mu.AllSongs = response.data.files
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

</style>