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
                <div class="nav nav-wizard">
                    <li class="nav-item">
                        <a href="{{ route('phase1.index') }}" class="nav-link first">
                            <div class="nav-wizard-box"> תיאור העסק </div>
                        </a>
                    </li>
                </div>

                <div class="form-contetnt pt-lg-5" data-aos="fade-up">
                    <div class="form-wizard">
                        <form action="{{route('phase1.store')}}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-xl-4 col-lg-8 col-md-10">
                                    <div class="form-group text-center mb-5">
                                        <h1 class="wizard-title"> סקירה עסקית</h1>
                                        <h2 class="wizard-sub-title"> בקשת אשראי לעסק</h2>
                                    </div>
                                    <div class="form-group">
                                        <label for="">שם חברה/עסק:</label>
                                        <input type="text" name="company_name" class="form-control"  placeholder="הקלד שם חברה/עסק" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">ע.מ / ח.פ</label>
                                        <input type="text" name="company_number" class="form-control"  placeholder="הקלד מס׳ ע.מ או ח.פ" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">מוגשת לבנק/גוף המימון</label>
                                        <input type="text" name="bank_name" class="form-control"  placeholder="הקלד שם הבנק/גוף המימון" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-5">
                                <a href="plane.blade.php" class="btn btn-secondary mr-4">הקודם</a>
                                <button type="submit" class="btn btn-secondary">הבא</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection
