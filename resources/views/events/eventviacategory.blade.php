<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
@extends('layouts.frontLayout.front_design')

@section('content')

	<!-- header-section-starts -->
	<div class="full">
		
    @include('layouts.frontLayout.front_menu')
		
        <div class="main">
		<div class="review-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="index.html"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="" /></a>
					<p>For All Events</p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			
            <div class="reviews-section">
					
                    <div class="col-md-9 reviews-grids">
					  
					  <?php
					   $noOfCategory = count($categoryDetails);
					   //dd($noOfCategory);
					  ?>
					  
				@if($noOfCategory)
					 @foreach($categoryDetails as $category)
					 <h3 class="head">Category: {{ $category->name }}</h3>
						
					@if($category)
						 @foreach($category->events as $event)
							
                            
							<div class="review">
                                <div class="movie-pic">
                                    <a href="{{ url('/events/') }}"><img src="{{ asset($event->image) }}" alt="{{ asset($event->name) }}" style = "width:70%; height:100%;"/></a>
                                </div>

    
                                <div class="review-info">
                                    <a class="span" href="{{ url('/events/' .$event->id) }}">{{ $event->name }}</a>
                                    
									<br>
                                                   
                                    <p class="">VENUE:&nbsp; {{ $event->venue }}</p>
									<p class="">DATE:&nbsp; {{ $event->date }}</p>
                                    <p class="">TIME:&nbsp; {{ $event->time }}</p>
                      
                                    <br>
									<!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{ $event->id }}" style="margin-bottom: 15px;">More Details</button>
                                    
									<a href="@guest{{ url('login') }}@else {{ url('/events/'.$event->id) }} @endif"><button type="button" class="btn btn-danger" style="margin-bottom: 15px;">Book Ticket</button></a>

										<!-- Modal -->
										<div id="myModal{{ $event->id }}" class="modal fade" role="dialog">
										  <div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">{{ $event->name }}</h4>
												</div>
												<div class="modal-body">

													<p><strong>Description: </strong> {{ $event->description }} </p>
													<br>
													<p><strong>Venue: </strong> {{ $event->venue }} </p>
													<br>
													<p><strong>Actors: </strong> {{ $event->actors }} </p>
													<br>
													<p><strong>Time: </strong> {{ $event->time }} </p>
													<br>
													<p><strong>Date: </strong> {{ $event->date }} </p>
													<br>
													<p><strong>Age: </strong> {{ $event->age }} </p> 
													<br>
													<p><strong>Dress Code: </strong>{{ $event->dresscode }} </p>
													<br>
													<h3>Available Tickets</h3>
													<br>
													 @foreach($event->tickets as $ticket)
														<p><strong>{{ optional($ticket)->tickettype.' ' ?? 'Free' }}</strong>{{ is_numeric(optional($ticket)->price) ? optional($ticket)->price.' '.'Naira' : 'Free' }}</p><br>
													 @endforeach

												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
												</div>

										  </div>
										</div>
									
                               
                                </div>
                    
                                
                                <div class="clearfix"></div>
                                
                            </div>

							@endforeach
								@else					
									<div class="">
										<div class="jumbotron">
											<h3>Oops! No Event(s) of this category at the moment</h3> 
										</div>
									</div>
							@endif
                       
					    @endforeach
					@else					
							<div class="">
								<div class="jumbotron">
									<h3>Oops! This category does not exist</h3> 
									
								</div>
							</div>
					@endif	

					
					@if($categoryDetails)
					<div class="pagenation">
							{{ $categoryDetails->render() }}

					</div>
					@else

					@endif
					

				
				
                    
                    </div>
                  
                    

			<div class="col-md-3 side-bar">
				
				<div class="entertainment">
					
					</div>	
				
							
						<div class="entertainment">
							<h3>Event Blog</h3>
							@foreach($allBlogPosts1 as $event)
								@include('layouts.frontLayout.front_entertainment2')
							@endforeach
						</div>

				</div>

					<div class="clearfix"></div>
			</div>

			</div>
		
		<div class="review-slider">
			 <ul id="flexiselDemo1">
				
				@foreach($eventsimage as $image)
					<li><img src="{{ asset($image->image) }}" alt=""/></li>
				@endforeach
		    </ul>

		@include('layouts.frontLayout.front_scripts2')		
		
		</div>		

		<br>
        <div class ="container" style="background:#f3f3f3;">
		<strong>Categories: </strong>
	    @foreach($allCategories as $category)
			<a href="{{ url('category/'.$category->id) }}" style="text-decoration: none;"><span class="label label-warning">{{ $category->name }}</span></a>
		@endforeach
	   </div>
	   @include('layouts.frontLayout.front_footer')
	

	</div>
	<div class="clearfix"></div>
	</div>

@endsection