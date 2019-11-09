@if (session()->has('success_message'))
<div class="alert alert-success">
    {{session()->get('success_message')}}
</div>
@endif

@if (count($errors) >0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
