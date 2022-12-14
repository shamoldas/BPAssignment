@extends('layouts.layoutUser')
@section('content')




<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
            <!--
                <form action="" method="GET">
                    <input type="text" name="search" required/>
                    <button type="submit">Search</button>
                </form>
            -->

                <form action="{{ route('searchpost') }}" method="GET">

                  <div class="form-group mt-3">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Searching Content" required/>
                    <!--<button type="submit">Search</button>-->
                  </div>                   
                </form>
         
            </div> 
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
             @foreach($posts as $post)

                <div class="form-group">
                
                    <img src="image/{{ $post->image }}"  height="300px" width="500px">
                </div>

                    <h5><b>Title:</b>{{ $post->title }}</h5>
                    <h5><b>Slug:</b>{{ $post->slug }}</h5>
                    <p style="text-align: justify;"><strong>Description:</strong>{{$post->description}}</p>

                    <div class="pull-right">
                    	<a class="btn btn-info" href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Comment</a>
                    </div>

                    <hr>        

                @endforeach
            </div> 
        </div>
    </div>


    <ul class="pagination">
		<li class="page-item"><a class="page-link" href="{{$posts->previouspageUrl()}}">Previous</a></li>
		<li class="page-item"><a class="page-link" href="{{$posts->nextpageUrl()}}">Next</a></li>

	</ul>


</div>

<div class="container">



</div>
@endsection