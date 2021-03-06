@extends('layouts.global')

@section('title') Create event @endsection

@section('content')
<form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
        @csrf

    <div class="container kons">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <div class="continaer box shadow-lg rounded">
            
            
      <br>
      <input id="cover" name="cover" type="file" class="form-control {{$errors->first('cover') ? "is-invalid" : ""}}">
      <div class="invalid-feedback">
        {{$errors->first('cover')}}
      </div>
            <div class="tols">
                <div class="col-sm-12">
                    <input value="{{old('name')}}" type="text" class="form-control noborder input-title nospace {{$errors->first('name') ? "is-invalid" : ""}} " name="name" placeholder="Event name*">
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                    <br>
                </div>
                <div class="container-fluid row nospace">
                    <div class="col-sm-12">
                        <label for="categories">Categories: </label>
                        <select name="categories[]" multiple id="categories" class="form-control {{$errors->first('categories') ? "is-invalid" : ""}}"></select>
                        
                <div class="invalid-feedback">
                    {{$errors->first('categories')}}
                </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid row nospace">
                    <div class="col-sm-6">
                        <p>Date & Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Stock & Lokation</p>
                    </div>
                </div>
                <div class="container-fluid row nospace">
                    <div class="col-sm-6">
                        <input id="timepicker" width="100%" value="{{old('time')}}" class="form-control {{$errors->first('time') ? "is-invalid" : ""}} " name="time">
                        <script>
                            $('#timepicker').timepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>
                        <input id="datepicker" width="100%" value="{{old('date')}}" class="form-control {{$errors->first('date') ? "is-invalid" : ""}} " name="date">
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>
                        <br>
                        
                        
                    </div>
                    <div class="col-sm-6">
                        <input value="{{old('stock')}}" type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}} " id="stock" name="stock" min=0 value=0 placeholder="Stock">
                        <div class="invalid-feedback">
                            {{$errors->first('stock')}}
                        </div>
                        <br>
                        <input value="{{old('location')}}" type="text" class="form-control {{$errors->first('location') ? "is-invalid" : ""}} " id="location" name="location" placeholder="Location">
                        <div class="invalid-feedback">
                            {{$errors->first('location')}}
                        </div>
                        <br>
                    </div>

                </div>
                <div class="col-sm-12">
                    <input value="{{old('link')}}" type="text" class="form-control noborder input-title nospace {{$errors->first('link') ? "is-invalid" : ""}} " name="link" placeholder="Event link*">
                    <div class="invalid-feedback">
                    {{$errors->first('link')}}
                    </div>
                    <br>
                </div>
            </div>


        </div>

        <div style="margin: 10%;">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2>Event Description</h2>
            </div>
            <textarea id="froala-editor" style="background-color: #000" name="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}} " placeholder="Give a description about this event" placeholder="Give a description about this event">{{old('description')}}</textarea>
            <br><br>
            <button class="btn btn-primary" type="submit" value="Save">Create</button>
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
