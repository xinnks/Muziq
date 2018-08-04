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

                    <h2>Add Album</h2>

                    <form enctype="multipart/form-data" class="uk-form-stacked" role="form" method="POST" action="{{ route('add.album.post') }}">

                        {{ csrf_field() }}

                        <div>
                            <label class="uk-form-label">Album Title</label>
                            <input id="name" type="text" class="uk-input{{ $errors->has('name') ? ' uk-form-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Year</label>
                            <div uk-form-custom="target: > * > span:first-child">
                                <select type="email" class="uk-input{{ $errors->has('year') ? ' uk-form-danger' : '' }}" name="year" value="{{ old('year') }}" >
                                    {{--<option value="">Please select...</option>--}}
                                    @for($i = date('Y'); $i >= date('Y') - 100; $i --)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <button class="uk-button uk-button-default" type="button" tabindex="-1">
                                    <span></span>
                                    <span uk-icon="icon: chevron-down"></span>
                                </button>
                            </div>

                            @if ($errors->has('year'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('year') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Artist</label>
                            <div uk-form-custom="target: > * > span:first-child">
                                <select type="email" class="uk-input{{ $errors->has('artist_id') ? ' uk-form-danger' : '' }}" name="artist_id" value="{{ old('artist_id') }}" >
                                    @if($artists)
                                        <option value="" disabled>Please select Artist</option>
                                        @foreach($artists as $artist)
                                            <option value="{{$artist->id}}">{{$artist->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No Artists</option>
                                    @endif
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
                            <label class="uk-form-label">Cover</label>
                            {{--<input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                            <div uk-form-custom>
                                <input type="file" name="cover">
                                <button class="uk-button uk-button-default{{ $errors->has('cover') ? ' uk-form-danger' : '' }}" type="button" tabindex="-1">Select Album Cover</button>
                            </div>

                            @if ($errors->has('cover'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('cover') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" name="button">Add Album</button>
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
