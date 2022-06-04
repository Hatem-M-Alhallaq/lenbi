@extends('layouts.leno_app')
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
                        <a href="form-wizard-1-1.blade.php" class="nav-link first">
                            <div class="nav-wizard-box"> תיאור העסק </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="form-wizard-1-2.blade.php" class="nav-link">
                            <div class="nav-wizard-box">פרטי בעלות</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="form-wizard-1-3.blade.php" class="nav-link">
                            <div class="nav-wizard-box">הסטוריית אשראי</div>
                        </a>
                    </li>
                </div>

                <div class="form-contetnt pt-lg-5" data-aos="fade-up">
                    <div class="form-wizard">
                        <form action="form-wizard-1-2.blade.php" method="post" class="needs-validation" novalidate>
                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-lg-8 col-md-10">
                                    <div class="form-group form-question text-center mb-5">
                                        <h1 class="wizard-title">היסטורית אשראי</h1>
                                        <p class="wizard-details">יש לענות בנתוני אמת, שכן בהמשך נבקש ממך לספק דוח נתוני אשראי לצורך אימות הנתונים עוד לפני שהבקשה תועבר לגוף מימון</p>
                                        <h2 class="wizard-info">האם יש לך או לעסק שלך תיקי הוצאה לפועל פתוחים כיום ?</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="#confirm_modal" data-toggle="modal" class="btn btn-primary mr-4">כן</a>
                                <a href="form-wizard-1-4.html" class="btn btn-primary">לא</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- confirm modal -->
        <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-md-5 p-4">
                    <div class="text-right">
                        <a href="#!" data-dismiss="modal" class="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="text-center form-wizard">
                            <h4 class="title text-danger py-4">בעקבות מידע זה, סיכויי אישור הבקשה שלך הם נמוכים, האם ברצונך להמשיך ?</h4>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="form-wizard-1-4.html" class="btn btn-primary mr-4">כן</a>
                                <a href="index.html" class="btn btn-primary">לא</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
