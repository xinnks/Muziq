<template>
    <div class="uk-box-shadow-medium uk-navbar-container uk-navbar-primary" uk-navbar="mode: click">
        <div class="uk-container uk-container-expand uk-width-1-1">

            <nav class="uk-navbar">

                <div class="uk-navbar-left">
                    <!-- Branding Image -->
                    <a class="uk-navbar-item uk-logo" href="/">
                        Muziq Player
                    </a>
                    <ul class="uk-navbar-nav">
                        <li>
                            <router-link to="/">Home</router-link>
                        </li>
                        <li>
                            <router-link to="/artists">Artists</router-link>
                        </li>
                        <li>
                            <router-link to="/albums">Albums</router-link>
                        </li>
                        <li>
                            <router-link to="/playlists">Playlists</router-link>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Nav"
    }
</script>

<style scoped>

</style>