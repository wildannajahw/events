@extends('layouts.global')

@section('title') Events list @endsection

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
              action="{{route('events.index')}}"
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
                <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'events' ? 'active' : ''}}" href="{{route('events.index')}}">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{Request::path() == 'events/trash' ? 'active' : ''}}" href="{{route('events.trash')}}">Trash</a>
              </li>
            </ul>
          </div>
        </div>

      <hr class="my-3">

      <div class="row mb-3">
        <div class="col-md-12 text-right">
          <a
            href="{{route('events.create')}}"
            class="btn btn-primary"
          >Create event</a>
        </div>
      </div>

      <table class="table table-bordered table-stripped">
        <thead>
          <tr>
            <th><b>Cover</b></th>
            <th><b>Name</b></th>
            <th><b>Organizer</b></th>
            <th><b>Categories</b></th>
            <th><b>Stock</b></th>
            <th><b>Price</b></th>
            <th><b>Action</b></th>
          </tr>
        </thead>
        <tbody>
          @foreach($events as $event)
            <tr>
              <td>
                @if($event->cover)
                  <img src="{{asset('storage/' . $event->cover)}}" width="96px"/>
                @endif
              </td>
              <td>{{$event->name}}</td>
              <td>{{$event->organizer}}</td>
              <td>
                <ul class="pl-3">
                @foreach($event->categories as $category)
                  <li>{{$category->name}}</li>
                @endforeach
                </ul>
              </td>
              <td>{{$event->stock}}</td>
              <td>{{$event->price}}</td>
              <td>
                  <a
                   href="{{route('events.edit', ['id' => $event->id])}}"
                   class="btn btn-info btn-sm"
                  > Edit </a>
                  <a
                   href="{{route('events.show', ['id' => $event->id])}}"
                   class="btn btn-info btn-sm"
                  > Show </a>

                  <form
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Move event to trash?')"
                    action="{{route('events.destroy', ['id' => $event->id ])}}"
                  >

                  @csrf
                  <input
                    type="hidden"
                    value="DELETE"
                    name="_method">

                  <input
                    type="submit"
                    value="Trash"
                    class="btn btn-danger btn-sm">

                  </form>

              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="10">
              {{$events->appends(Request::all())->links()}}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  </div>
@endsection
