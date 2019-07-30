@extends('layouts.global')
@section('title') Edit article @endsection
@section('content')
<form
    enctype="multipart/form-data" method="POST" action="{{route('articles.update', ['id' => $article->id])}}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="container kons">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <div class="continaer box shadow-lg rounded">
            @if($article->cover)
                <img src="{{asset('storage/' . $article->cover)}}" width="100%"/>
            @endif
            <input type="file" class="{{$errors->first('cover') ? "is-invalid" : ""}} " name="cover"><small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
            <div class="invalid-feedback">
                {{$errors->first('cover')}}
            </div>
            <div class="tols">
                <div class="col-sm-12">
                    <input value="{{old('name') ? old('name') : $article->name}}" type="text" class="form-control noborder input-title nospace {{$errors->first('name') ? "is-invalid" : ""}} " name="name" placeholder="article name*">
                    <div class="invalid-feedback">
                    {{$errors->first('name')}}
                    </div>
                    <br>
                </div>
                <div class="container-fluid row nospace">
                    <div class="col-sm-12">
                        <label for="categories">Categories: </label>
                        <select name="categories[]" multiple id="categories" class="form-control" value="{{old('categories') ? old('categories') : $article->categories}}"></select>
                    </div>
                </div>
                <br>
                <div class="container-fluid row nospace">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                </div>
                <div class="container-fluid row nospace">
                    <div class="col-sm-6">
                        <input id="datepicker" width="100%" value="{{old('date') ? old('date') : $article->date}}" class="form-control {{$errors->first('date') ? "is-invalid" : ""}} " name="date">
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>
                    </div>
                </div>
            </div>

        </div>
        <div style="margin: 10%;">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2>article Description</h2>
            </div>
            <textarea id="froala-editor"  style="background-color: #000" name="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}} " placeholder="Give a description about this article">{{old('description') ? old('description') : $article->description}}</textarea>
            <br><br>
            <button class="btn btn-primary" type="submit" value="Save">Update</button>
        </div>
    </div>
</form>
@endsection
@section('footer-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>

$('#categories').select2({
  ajax: {
    url: 'http://127.0.0.1:8000/ajax/categories/search',
    processResults: function(data){
        placeholder:"Select a state"
        return {
            results: data.map(function(item){return {id: item.id, text: item.name} })
        }
    }
  }
});
$('.select2-selection').css('border-top','1px')
$('.select2-container').children().css('border-top','1px')
$('.select2-selection').css('border-left','1px')
$('.select2-container').children().css('border-left','1px')
$('.select2-selection').css('border-right','1px')
$('.select2-container').children().css('border-right','1px')
$('.select2-selection').css('border-radius','0px')
$('.select2-container').children().css('border-radius','0px')
</script>
<script>
  new FroalaEditor('textarea#froala-editor',{
    theme: 'dark',
    zIndex: 2003,
    colorsButtons: ["colorsBack", "|", "-"]
  })
</script>
@endsection
