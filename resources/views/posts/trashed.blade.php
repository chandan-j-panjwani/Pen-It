@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('posts.create')}}" class="btn btn-primary">Add Post</a>
    </div>
    <div class="card">
        <div class="card-header">Trashed Posts</div>

        <div class="card-body">
            @if($posts->count()>0)
            <table class="table table-bordered">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{asset('storage/'.$post->image)}}" alt="Post Image" width="128">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                {{$post->excerpt}}
                            </td>
                            <td>
                                <form action="{{route('posts.restore', $post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                                </form>
                                <a href="#" class="btn btn-sm btn-danger"
                                    onclick="displayModalForm({{$post}})"
                                    data-toggle="modal"
                                    data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
             <h5>Nothing To Show!</h5>
            @endif
        </div>
        <div class="card-footer">
            {{$posts->links()}}
        </div>
    </div>

    <!--DELETE MODAL-->
    <div class="modal fade" tabindex="-1" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete Post?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Post</button>
                </div>
            </div>
        </div>
    </div>

    <!--END DELETE MODAL-->
@endsection

@section('page-level-scripts')
    <script type="text/javascript">
        function displayModalForm($post){
            var url = '/posts/' + $post.id;
            $("#deleteForm").attr('action',url);
        }
    </script>
@endsection


