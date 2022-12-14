

@extends('layouts.layoutUser')
@section('content')
<div class="container">
 	<div class="row justify-content-center">
 		<div class="col-md-10">
 			<div class="card mt-3">
				 <div class="card-body">

					<div class="form-group">
		               
		                <img src="image/{{ $post->image }}" height="300px" width="500px">
		            </div>

					 	<h5><b>Title:{{ $post->title }}</b></h5>
					 	<h5>Slug:{{ $post->slug }}</h5>
				 		<p><b>Description:</b>
				 		{{ $post->description }}
				 		</p>
				 		<hr />
				 		<h4>Display Comments</h4>
				 		  @foreach ($comments as $comment)

				 		     <div class="display-comment">
	                            <strong>{{ $comment->user->name }}</strong>
	                       	      <p>{{ $comment->body }}</p>
	                        </div>
	                        @include('_comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
		                          

		                @endforeach

				 		@include('_comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])



				 		 @foreach($post->comments as $comment)
                        <div class="display-comment">
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->body }}</p>
                        </div>
                    	@endforeach
                    

			 			@include('partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
				 		<hr />
				 		<h4>Add comment/Accent</h4>
				 		<!--include('partials._comment_replies')-->
								 <form method="post" action="{{ route('comment.add') }}">
								 @csrf
									<div class="form-group">
										<input type="text" name="comment_body" class="form-control"  required />
										<input type="hidden" name="post_id" value="{{ $post->id }}" />
									</div>
									<div class="form-group">
									 	<input type="submit" class="btn btn-warning" value="Add Comment" />
									</div>
								 </form>
				 </div>
 			</div>
 		</div>
 	</div>
</div>
@endsection