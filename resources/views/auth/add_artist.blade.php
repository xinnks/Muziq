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

                    <h2>Add Artist</h2>

                    <form enctype="multipart/form-data" class="uk-form-stacked" role="form" method="POST" action="{{ route('add.artist.post') }}">

                        {{ csrf_field() }}

                        <div>
                            <label class="uk-form-label">Name</label>
                            <input id="name" type="text" class="uk-input{{ $errors->has('name') ? ' uk-form-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Cover Art</label>
                            <div uk-form-custom>
                                <input type="file" name="photo">
                                <button class="uk-button uk-button-default{{ $errors->has('photo') ? ' uk-form-danger' : '' }}" type="button" tabindex="-1">Select</button>
                            </div>

                            @if ($errors->has('photo'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Bio</label>
                            {{--<input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                            <textarea class="uk-textarea{{ $errors->has('bio') ? ' uk-form-danger' : '' }}" name="bio" value="{{ old('lyrics') }}" rows="5" placeholder="Textarea" required></textarea>

                            @if ($errors->has('bio'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('bio') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" name="button">Add Artist</button>
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
