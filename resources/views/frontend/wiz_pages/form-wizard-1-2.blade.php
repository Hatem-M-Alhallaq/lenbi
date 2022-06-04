@extends('frontend.layouts.app')
@section('content')
    <!-- navbar-main -->
    <nav class="navbar navbar-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="index.blade.php">
                <div class="logo">
                    <img src="assets/img/logo.svg" alt="logo">
                </div>
            </a>

            <div class="action d-flex align-items-center">
                <a href="../auth/login.blade.php" class="btn btn-user mr-md-4 mr-3">
                    <img src="assets/img/user.svg" class="mr-3" alt="">
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
                        <a href="{{ route('frontend.ph1_1.create') }}" class="nav-link first">
                            <div class="nav-wizard-box"> תיאור העסק </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('frontend.ph1_2.create') }}" class="nav-link">
                            <div class="nav-wizard-box">פרטי בעלות</div>
                        </a>
                    </li>
                </div>

                <div class="form-contetnt pt-lg-5" data-aos="fade-up">
                    <div class="form-wizard">
                        <form action="{{ route('frontend.ph1_2.store') }}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                           @csrf
                            <input type="hidden" name="app_id" value="1">
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="form-group text-center mb-5">
                                        <h1 class="wizard-title">פרטי בעלות</h1>
                                        <h2 class="wizard-sub-title"> בקשת אשראי לעסק</h2>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">שם מלא</label>
                                        <input type="text" name="full_namme" class="form-control" placeholder="שם מלא" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">מס’ ת.ז.</label>
                                        <input type="text" name="id_number" class="form-control" placeholder="מס’ ת.ז." required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">אחוז בעלות</label>
                                        <input type="text" name="owner_precentage" class="form-control" placeholder="% בעלות" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">גיל</label>
                                        <input type="date" name="dab" class="form-control" placeholder="גיל" required>

                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">שם בן/ בת הזוג</label>
                                        <input type="text" name="spouse_name" class="form-control" placeholder="שם בן/ בת הזוג" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">ת.ז. בן/ בת הזוג</label>
                                        <input type="text" name="spouse_id" class="form-control" placeholder="ת.ז. בן/ בת הזוג" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">עיסוק בן/ בת הזוג</label>
                                        <input type="text" name="spouse_ocupation" class="form-control" placeholder="עיסוק בן/ בת הזוג" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">כתובת מגורים</label>
                                        <input type="text" name="address" class="form-control" placeholder="כתובת מגורים" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">דואל (Email)</label>
                                        <input type="email" name="email" class="form-control" placeholder="דואל (Email)" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">טלפון נייד</label>
                                        <input type="text" name="phone" class="form-control" placeholder="טלפון נייד" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">האם ביתך בבעלות פרטית</label>
{{--                                        <input type="text" name="is_owned_house" class="form-control" placeholder="האם ביתך בבעלות פרטית" required>--}}
                                        <select name="is_owned_house" class="form-control" placeholder="האם ביתך בבעלות פרטית" required>
                                            <option value="1">{{__('Yes')}}</option>
                                            <option value="0">{{__('No')}}</option>
                                        </select>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">גובה משכנתא ב-ש”ח</label>
                                        <input type="text" name="amount" class="form-control" placeholder="גובה משכנתא ב-ש”ח" required>
                                        <div class="invalid-feedback">  Validation message </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-5">
                                <a href="{{route('frontend.plan')}}" class="btn btn-secondary mr-4">הקודם</a>
                                <button type="submit" class="btn btn-secondary">הבא</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection
