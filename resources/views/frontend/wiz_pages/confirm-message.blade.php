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
                <a href="" class="btn btn-user mr-md-4 mr-3">
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
                {{--                <a href="#!" class="btn-lang" title="en language"> En</a>--}}
            </div>
        </div>
    </nav>
    <!-- End navbar-main -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-8 col-md-10">
                        <div class="form-contetnt pt-lg-5 mt-lg-5" data-aos="fade-up">
                            <div class="form-box p-lg-4">
                                <form action="{{route('frontend.user_check_validate')}}" method="post" class="needs-validation" novalidate>
                                 @csrf

                                    <div class="form-group text-center">
                                        <h1 class="title-2"> שלחנו לכם קוד בהודעת SMS <br>
                                            נא להזין את הקוד שקיבלתם</h1>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirmation_code" class="form-control text-center" placeholder="******" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block shadow-sm">התחבר</button>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="#!" class="text-second">שלחו לי קוד חדש</a>
                                        <a href="index.html" class="text-second">חזרה לעמוד קודם</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
