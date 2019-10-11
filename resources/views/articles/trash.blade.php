@extends('layouts.global')

@section('title') Trashed articles @endsection

@section('content')

<div class="container kons">
  <div class="row">
    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success">
          {{session('status')}}
        </div>
      @endif
      <div class="row">
          <div class="col-md-6">
            <form
              action="{{route('articles.index')}}"
            >

            <div class="input-group">
                <input name="keyword" type="text" value="{{Request::get('keyword')}}" class="form-control" placeholder="Filter by title">
                <div class="input-group-append">
                  <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>

            </form>
          </div>
          <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'articles' ? 'active' : ''}}" href="{{route('articles.index')}}">All</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{Request::path() == 'articles/trash' ? 'active' : ''}}" href="{{route('articles.trash')}}">Trash</a>
              </li>
            </ul>
          </div>
        </div>

      <hr class="my-3">

      <div class="row mb-3">
        <div class="col-md-12 text-right">
          <a
            href="{{route('articles.create')}}"
            class="btn btn-primary"
          >Create article</a>
        </div>
      </div>


      <table class="table table-bordered table-stripped">
        <thead>
          <tr>
            <th><b>Cover</b></th>
            <th><b>Title</b></th>
            <th><b>Author</b></th>
            <th><b>Categories</b></th>
            <th><b>Stock</b></th>
            <th><b>Price</b></th>
            <th><b>Action</b></th>
          </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
              <td>
                @if($article->cover)
                  <img src="{{asset('storage/' . $article->cover)}}" width="96px"/>
                @endif
              </td>
              <td>{{$article->name}}</td>
              <td>{{$article->organizer}}</td>
              <td>
                <ul class="pl-3">
                @foreach($article->categories as $category)
                  <li>{{$category->name}}</li>
                @endforeach
                </ul>
              </td>
              <td>{{$article->stock}}</td>
              <td>{{$article->price}}</td>
              <td>
                  <form
                    method="POST"
                    action="{{route('articles.restore', ['id' => $article->id])}}"
                    class="d-inline"
                  >

                    @csrf

                    <input type="submit" value="Restore" class="btn btn-success"/>
                  </form>

                  <form
                    method="POST"
                    action="{{route('articles.delete-permanent', ['id' => $article->id])}}"
                    class="d-inline"
                    onsubmit="return confirm('Delete this article permanently?')"
                  >

                  @csrf
                  <input type="hidden" name="_method" value="DELETE">

                  <input type="submit" value="Delete" class="btn btn-danger">
                  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="10">
              {{$articles->appends(Request::all())->links()}}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection
