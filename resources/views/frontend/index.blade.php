@extends('frontend.layouts.app')

@section('title', config('app.name')  . ' | ' . __('navs.general.home'))

@section('content')
    <!-- navbar-main -->
    <nav class="navbar navbar-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="">
                <div class="logo">
                    <img src="{{asset('/img/frontend/logo.svg')}}" alt="logo">
                </div>
            </a>

            <div class="action d-flex align-items-center">
                <a href="{{route('dashboard.login.clink')}}" class="btn btn-user mr-md-4 mr-3">
                    <img src="{{asset('/img/frontend/user.svg')}}" class="mr-3" alt="">
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
                <div class="col-xl-5 col-md-8">
                    <div class="form-contetnt pt-lg-5" data-aos="fade-up" data-aos-delay="3000">
                        <div class="form-box p-lg-4">
                            <form action="{{route('frontend.auth.register.post')}}" method="post" class="needs-validation" novalidate>
                          @csrf
                                <div class="form-group text-center">
                                    <img src="{{asset('/img/frontend/logo.svg')}}" alt="logo">
                                </div>
                                <div class="form-group text-center">
                                    <h1 class="title">
                                        3 פרטים והתחלנו!
                                    </h1>
                                </div>
                                <div class="form-group">

                                    <input type="text" name="first_name" class="form-control" placeholder="שם:" required>
                                    <div class="invalid-feedback">  Validation message </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="uid" class="form-control" placeholder="ת.ז:" required>
                                    <div class="invalid-feedback">  Validation message </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" placeholder="מס׳ נייד:" required>
                                    <div class="invalid-feedback">  Validation message </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block shadow-sm">שלח</button>
                                </div>
                            </form>
                        </div>

                        <p class="text-dark mt-4 text-center mb-0">
                            פרטי החשבון נועדו לניהול החשבון בתוך המערכת, והם לא חייבים להיות אותם פרטי עסק/חברה שדרושה עבורה התכנית העסקית. ניתן תחת אותו חשבון ליצור יותר מתכנית אחת.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
