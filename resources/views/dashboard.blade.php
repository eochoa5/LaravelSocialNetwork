@extends('layouts.master')

@section('title')
   Dashboard
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <h3>What's on your mind</h3>

            <form action="{{route('post.create')}}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your post"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Create post</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>

        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <h3>What others are saying</h3>

            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>{{$post->body}}</p>
                    <div class="info">posted by {{$post->user->first_name}} on {{$post->created_at}}</div>
                    <div class="interaction">
                        <a href="#">Like</a>
                        <a href="#">Dislike</a>
                        @if(Auth::user() == $post->user)
                            <a href="#" data-toggle="modal" data-target="#editModal" onclick="editPost(event)">Edit</a>
                            <a href="{{route('post.delete', ['id'=>$post->id])}}">Delete</a>
                        @endif
                    </div>
                </article>

            @endforeach

        </div>


    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit post</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="edit-area" rows="5" placeholder="Edit post"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="savePost()">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{Session::token()}}';
        var Url = '{{route('edit')}}';
    </script>

@endsection