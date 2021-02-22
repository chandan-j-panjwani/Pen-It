@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('tags.create')}}" class="btn btn-primary">Add Tag</a>
    </div>
    <div class="card">
        <div class="card-header">Tags</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Post Count</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{$tag->name}}
                            </td>
                            <td>
                                {{$tag->posts->count()}}
                            </td>
                            
                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-sm btn-primary" >Edit</a>
                                <a href="#" class="btn btn-sm btn-danger"
                                    onclick="displayModalForm({{$tag}})"
                                    data-toggle="modal"
                                    data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--DELETE MODAL-->
    <div class="modal fade" tabindex="-1" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete tag?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Tag</button>
                </div>
            </div>
        </div>
    </div>

    <!--END DELETE MODAL-->
@endsection

@section('page-level-scripts')
    <script type="text/javascript">
        function displayModalForm($tag){
            var url = '/tags/' + $tag.id;
            $("#deleteForm").attr('action',url);
        }
    </script>
@endsection


