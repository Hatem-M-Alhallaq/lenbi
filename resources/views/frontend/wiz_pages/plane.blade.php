@extends('frontend.layouts.app')
@section('content')
    <!-- navbar-main -->
    <nav class="navbar navbar-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="{{route('frontend')}}">
                <div class="logo">
                    <img src="{{asset('frontend/img/frontend/logo.svg')}}" alt="logo">
                </div>
            </a>

            <div class="action d-flex align-items-center">
                <a href="#" class="btn btn-user mr-md-4 mr-3">
                    <img src="{{asset('frontend/img/frontend/user.svg')}}" class="mr-3" alt="">
                    <span>כניסה לחשבון</span>
                </a>

                <div class="dropdown user-dropdown d-none">
                    <a href="#!" class="dropdown-toggle mr-md-4 mr-3" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-pic">
                            <img src="https://image.flaticon.com/icons/png/512/149/149071.png" alt="user-pic">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="#"></a>
                        <a class="dropdown-item" href="#"></a>
                        <a class="dropdown-item" href="#"></a>
                        <a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"></a>
                    </div>
                </div>
                <a href="#!" class="btn-lang" title="en language"> En</a>
            </div>
        </div>
    </nav>
    <!-- End navbar-main -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">
                        <div class="form-contetnt pt-lg-5 mt-lg-5" data-aos="fade-up">
                            <div class="form-box ">
                                <div class="form-group text-center">
                                    <h1 class="title"> לאיזה צורך מיועדת התכנית העסקית?</h1>
                                </div>
                                <div class="px-5">
                                    <div class="form-group">
                                        <a href="{{ route('phase1.index') }}" class="btn btn-primary btn-block shadow-sm mb-4">הקמת עסק חדש</a>
                                    </div>
                                    <div class="form-group">
                                        <a href="form-wizard-2-1.html" class="btn btn-primary btn-block shadow-sm">פיתוח עסק קיים</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
