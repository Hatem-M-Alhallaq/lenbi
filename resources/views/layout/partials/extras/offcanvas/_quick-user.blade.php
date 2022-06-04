<?php
use App\Models\Admin;    
	$admin = auth()->user('id');
?>


@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			@if(Auth::guard('admin')->check())
			Admin Profile
			@elseif(Auth::guard('clink')->check())
			clink Profile
			@endif
			<small class="text-muted font-size-sm ml-2">12 messages</small>
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>

	{{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
		{{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
				@if(Auth::guard('admin')->check())
                <div class="symbol-label" style="background-image:url('{{asset('download.png')}}')"></div>
				 @elseif(Auth::guard('clink')->check())
			   <div class="symbol-label" style="background-image:url('{{asset('download.png')}}')"></div>

				 @endif
				{{--  --}}
				<i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
					     @if(Auth::guard('admin')->check())
                        {{auth('')->user()->username}}
                         @elseif(Auth::guard('clink')->check())
                        {{auth()->user()->Username}}
                        @endif  
				</a>
                <div class="text-muted mt-1">
              
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
                            <span class="navi-text text-muted text-hover-primary">
						@if(Auth::guard('admin')->check())
                       {{auth('admin')->user()->email}}
                        @elseif(Auth::guard('clink')->check())
                       {{auth('clink')->user()->email}}
                        @endif
								</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>

		{{-- Separator --}}
		<div class="separator separator-dashed mt-8 mb-5"></div>

		{{-- Nav --}}
		<div class="navi navi-spacer-x-0 p-0">
		    {{-- Item --}}
 

		    {{-- Item --}}
		    <a href="{{route('dashboard.auth.edit-profile')}}"  class="navi-item">
 

	 

		    {{-- Item --}}
		    <a href="{{route('dashboard.auth.logout')}}" class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Communication/Mail-opened.svg", "svg-icon-md svg-icon-primary") }}
						</div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Logout
		                </div>
		                 
		        </div>
		    </a>
			    {{-- <a href="{{route('admin.showResetPasswordView')}}" class="navi-item"> --}}
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Communication/Mail-opened.svg", "svg-icon-md svg-icon-primary") }}
						</div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    RestPassword
		                </div>
		                 
		        </div>
		    </a>
		</div>

		{{-- Separator --}}
		<div class="separator separator-dashed my-7"></div>

		{{-- Notifications --}}
	 
    </div>
</div>
