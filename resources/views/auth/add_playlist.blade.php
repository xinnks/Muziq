@extends('layouts.app')

@section('content')

    <div class="uk-section" id="app">
        <div class="uk-container uk-container-center">

            <div class="uk-width-1-2@m uk-align-center">

                <div class="uk-padding uk-box-shadow-large">
                    @if(session('success'))
                        <div class="uk-alert-success" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>{{session('success')}}.</p>
                        </div>
                    @endif
                    @if(session('failure'))
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>{{session('failure')}}.</p>
                        </div>
                    @endif

                    <h2>Add Song</h2>

                    <form enctype="multipart/form-data" class="uk-form-stacked" role="form" method="POST" action="{{ route('add.song') }}">

                        {{ csrf_field() }}

                        <div class="uk-margin">
                            <div uk-form-custom>
                                <input type="file" name="audio_file" accept="audio/*">
                                <button class="uk-button uk-button-default" type="button" tabindex="-1">Select Music File</button>
                            </div>
                        </div>

                        <div>
                            <label class="uk-form-label">Song Title</label>
                            <input id="name" type="text" class="uk-input{{ $errors->has('song_title') ? ' uk-form-danger' : '' }}" name="song_title" value="{{ old('song_title') }}" required autofocus>

                            @if ($errors->has('song_title'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('song_title') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Artist</label>
                            <div uk-form-custom="target: > * > span:first-child">
                                <select type="email" class="uk-input{{ $errors->has('artist_id') ? ' uk-form-danger' : '' }}" name="artist_id" value="{{ old('artist_id') }}" >
                                    <option value="">Please select...</option>
                                    <option value="1">Option 01</option>
                                    <option value="2">Option 02</option>
                                    <option value="3">Option 03</option>
                                    <option value="4">Option 04</option>
                                </select>
                                <button class="uk-button uk-button-default" type="button" tabindex="-1">
                                    <span></span>
                                    <span uk-icon="icon: chevron-down"></span>
                                </button>
                            </div>

                            @if ($errors->has('artist_id'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('artist_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Album</label>
                            {{--<input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                            <div uk-form-custom="target: > * > span:first-child">
                                <select type="email" class="uk-input{{ $errors->has('album_id') ? ' uk-form-danger' : '' }}" name="album" value="{{ old('album_id') }}" >
                                    <option value="">Please select...</option>
                                    <option value="1">Option 01</option>
                                    <option value="2">Option 02</option>
                                    <option value="3">Option 03</option>
                                    <option value="4">Option 04</option>
                                </select>
                                <button class="uk-button uk-button-default" type="button" tabindex="-1">
                                    <span></span>
                                    <span uk-icon="icon: chevron-down"></span>
                                </button>
                            </div>

                            @if ($errors->has('album_id'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('album_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Cover Art</label>
                            {{--<input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                            <div uk-form-custom>
                                <input type="file">
                                <button class="uk-button uk-button-default{{ $errors->has('cover_art') ? ' uk-form-danger' : '' }}" name="cover_art" type="button" tabindex="-1">Select</button>
                            </div>

                            @if ($errors->has('cover_art'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('cover_art') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Lyrics</label>
                            {{--<input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                            <textarea class="uk-textarea{{ $errors->has('lyrics') ? ' uk-form-danger' : '' }}" name="lyrics" value="{{ old('lyrics') }}" rows="5" placeholder="Textarea" required></textarea>

                            @if ($errors->has('lyrics'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('lyrics') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" name="button">Add Song</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    {{--<script src="{{asset('js/admin.js')}}"></script>--}}

    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data(){
                return {
                    file:'',
                    resultingAudioId: '',
                    progress: 0,
                    failed: false
                }
            },
            methods:{
                addFile() {
                    this.file = this.$refs.music_file;
                    this.uploadAudioFile()
                },
                uploadAudioFile(){

                    let mu = this
                    let formData = new FormData();
                    formData.append('music_file', this.file)
                    for (var key of formData.entries()) {
                        console.log(key[0] + ', ' + key[1]);
                    }

                    axios.post( 'http://127.0.0.1:8000/add_music_file',
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            onUploadProgress: function(progressEvent) {
                                mu.progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                            }
                        }
                    ).then(function(response){
                        console.log('SUCCESS!!');
                        console.log(response.data);
                        mu.resultingAudioId = response.data.audio_id;
                        mu.progress = 0
                        mu.failed =false
                    })
                        .catch(function(error){
                            console.log('FAILURE!!');
                            console.log(error)
                            mu.progress = 2
                            mu.failed =true
                        });
                }
            }
        });
    </script>

    <style>
        .failed{
            background-color: #d66d66;
        }
    </style>


   {{-- <script>
        (function () {
            var output = document.getElementById('output');
            document.getElementById('upload').onclick = function () {
                var data = new FormData();
                data.append('foo', 'bar');
                data.append('file', document.getElementById('file').files[0]);
                var config = {
                    onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
                };
                axios.put('/upload/server', data, config)
                    .then(function (res) {
                        output.className = 'container';
                        output.innerHTML = res.data;
                    })
                    .catch(function (err) {
                        output.className = 'container text-danger';
                        output.innerHTML = err.message;
                    });
            };
        })();
    </script>--}}

@endsection
