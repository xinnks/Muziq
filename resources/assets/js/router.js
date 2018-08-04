import Vue from 'vue'
import Router from 'vue-router'
import { HomePage, ArtistsPage, ArtistPlayerPage, PlaylistsPage, PlaylistPlayerPage, AlbumsPage, AlbumPlayerPage } from './views'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '*',
            name:'Home',
            component: HomePage
        },
        {
            path: '/artists',
            name:'Artists',
            component: ArtistsPage
        },
        {
            path: '/artist/:unique_id',
            name:'Artist',
            component: ArtistPlayerPage
        },
        {
            path: '/playlists',
            name:'Playlists',
            component: PlaylistsPage
        },
        {
            path: '/playlist/:unique_id',
            name:'Playlist',
            component: PlaylistPlayerPage
        },
        {
            path: '/albums',
            name:'Albums',
            component: AlbumsPage
        },
        {
            path: '/album/:unique_id',
            name:'Album',
            component: AlbumPlayerPage
        }
    ]
});