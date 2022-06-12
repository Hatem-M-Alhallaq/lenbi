@extends('layout.default')
@section('content')
    <html direction="rtl" dir="rtl" style="direction: rtl">
@section('styles')
    <style>
        .display-none {

            display: none;

        }

        .cursor-pointer {

            cursor: pointer;

        }


        table {

            table-layout: fixed;

            overflow: hidden;

            border-spacing: 10px;

        }


        table,
        tr,
        td {

            width: 100%;

        }


        .inline-item-input {

            width: 60px;

        }


        .card-header {

            padding: 1.1rem 2.25rem;

        }


        .cards-container {

            display: grid;

            overflow: hidden;

            grid-template-columns: repeat(4, 1fr);

            grid-auto-rows: 1fr;

            grid-column-gap: 5px;

            grid-row-gap: 5px;

        }


        .popup-cards-container {

            display: grid;

            overflow: hidden;

            grid-template-columns: repeat(2, 1fr);

            grid-auto-rows: 1fr;

            grid-column-gap: 5px;

            grid-row-gap: 5px;

        }


        table th {

            color: white;

        }


        .center {

            display: block;

            margin-left: auto;

            margin-right: auto;

            width: 50%;

        }


        @media screen and (max-width: 480px) {
            .wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step {
                justify-content: center;
            }

            .only-desktop {

                display: none;

            }


            .cards-container {

                grid-template-columns: repeat(2, 1fr);

            }


            .products-list-container {

                padding-left: 0 !important;

                padding-right: 0 !important;

            }


            .card-header {

                padding: 10px;

            }

        }


        .show-product-quick-info {

            top: 0;

        }


        .quick-actions {

            font-size: 11px;

        }

        .text-end {

            text-align: left
        }


        .text-start {

            text-align: right
        }

        .svg-icon.wizard-arrow {

            -webkit-transform: scaleX(-1);

            transform: scaleX(-1);

        }
    </style>


    <style>
        /* By Mohammed Eisa for registration */
        .step {
            margin: auto;
            opacity: 0;
            height: 0 !important;
            -webkit-transition: opacity 1s linear;
            -moz-transition: opacity 1s linear;
            -o-transition: opacity 1s linear;
            transition: opacity 1s linear;
            transition: transform .8s cubic-bezier(0.42, 0, 0.15, 1.4);
            transform: translate(116%, 0px) rotate(0deg);
            width: 80%;
            /* overflow-y: scroll; */
        }

        .float-end {
            float: left;
        }

        .float-start {
            float: left;
        }

        .step.current-step {
            opacity: 1;
            transform: translate(0px, 0px) rotate(0deg);
            height: 100% !important;
        }

        #wizard-container {
            overflow: hidden;
            /* height: 43vh; */
        }

        .wizard-item.current::after,
        .wizard-item.done::after {
            background-color: #3E3E3E;
        }

        .wizard-item-container:first-of-type .wizard-item::after,
        .wizard-item-container:last-of-type .wizard-item::after {
            width: 50%;
        }

        .wizard-item-container:last-of-type .wizard-item::after {
            left: 0;
            right: inherit;
        }

        .svg-container>div {
            border-radius: 16px;
            padding: 8px;
        }

        .wizard-item.done .svg-container>div,
        .wizard-item.current .svg-container>div {
            background-color: #3E3E3E;
        }

        #wizard-progress svg {
            width: 50px;
            height: 50px;
        }


        .svg-container.done svg {
            padding: 7px;
            background-color: #3E3E3E;
        }

        .wizard-item-container p {
            font-size: 10px;
        }


        .inner-container {
            width: 85%;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: #F0F0F0 !important;
            border: none !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            margin: 0.5rem 1rem;
        }


        .image-upload-container {
            border: 1px dashed #707070;
        }

        .theme-preview-image {
            max-width: 100px;
            margin-right: 1% !important;
        }

        .theme-preview-image:nth-of-type(1) {
            padding-left: 0 !important;
        }

        .theme-preview-image.disabled {
            opacity: .7;
        }

        .gray-background {
            background-color: #F0F0F0;
        }

        #logo-input-container {
            height: 77px;
            width: 77px !important;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        #logo-input-container img {
            cursor: pointer;
        }

        #logo-input-preview {
            height: 100%;
            width: 100%;
            margin: 1px;
        }

        map {
            height: 238px;
            width: 100%;
        }


        .form-check-input:checked {
            background-color: #3E3E3E;
        }


        .form-check-input {
            border: 1px solid #3E3E3E !important;
        }

        .step .select2-container {
            width: 100% !important;
        }

        .parsley-errors-list {
            color: red;
            margin: 0;
        }

        .rotate {
            transform: rotate(-180deg);
        }

        .btn-secondary:hover {
            color: #565e64;
        }


        #wizard-progress {
            margin-top: 25px;
        }

        /* Mobile */
        @media only screen and (max-width: 600px) {
            .check-link {
                width: 100% !important;
                margin-top: 10px;
            }

            .launchers button {
                width: 100% !important;
            }

            .info-input-container {
                margin-bottom: 5px;
            }

            .wizard.wizard-1 .wizard-nav .wizard-steps .wizard-step .wizard-label .wizard-icon {
                font-size: 2.5rem !important;
            }

            h3.wizard-title {
                width: 85px;
            }

            h1 {
                font-size: 40px;
                line-height: 40px;
            }

            .section.one {
                text-align: center;
            }

            .section.one #phone-number {
                /* width: 100%; */
                /* margin-bottom: 5px; */
            }

            .section.one .input-group {
                justify-content: center;
            }

            .wizard-item-container {
                margin-right: 7px;
            }

            div#navigation-container button {
                font-size: 11px;
            }

            #theme-setup-step select {
                width: 160px !important;
                margin-bottom: 5px;
            }
        }

        /* End mobile */

        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio]+img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked+img {
            outline: 4px solid #4c4c4c;
        }

        img {
            max-height: 100%;
            max-width: 100%;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            /* display: block; */
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            min-height: auto;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container .selection .select2-selection--multiple,
        .select2-container .selection .select2-selection--multiple .select2-selection__choice {
            padding: 0;
        }

        .select2-container .selection .select2-selection--multiple .select2-selection__choice {
            padding-left: 20px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            min-height: auto;
        }

        .form-control {
            font-size: 1.25rem !important;
        }

        .full-height {
            height: 100vh;
        }

        .flag {
            width: 25px;
        }

        .country-selector {
            background-color: #F0F0F0 !important;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            box-shadow: inset 0 1px 0px rgb(0 0 0 / 10%);
            border-right: 0;
            border-left: 0;
        }

        .registration-first-step {
            width: 90%;
        }

        .step .dropdown-menu {
            min-width: auto !important;
        }

        .thumb-bar {
            background-color: #fffcfc56;
            height: 23px;
            padding: 3px;
            text-align: center;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thumb-bar .expand-theme {
            outline: 0 !important;
            cursor: pointer;
        }

        #applytoall {
            font-size: 9px;
        }

        .overlay {
            display: none;
        }

        option:checked {
            background-color: #fff;
        }

        .wizard label {
            margin-bottom: 0.5rem;
            margin-right: 5px;
        }

        .hours-label {
            width: 50px;
        }

        #release-menu label {
            text-align: center !important;
        }
    </style>
@endsection


<div class="card card-custom mx-auto">

    <div class="card-body p-0">

        <!--begin::Wizard-->

        <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">

            <!--begin::Wizard Nav-->

            <div class="wizard-nav border-bottom">

                <div class="wizard-steps p-8 p-lg-10">

                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">

                        <div class="wizard-label">

                            <i class="wizard-icon flaticon-responsive"></i>

                            <h3 class="wizard-title">{{ __('Phases 1') }}</h3>

                        </div>

                        <span class="svg-icon svg-icon-xl wizard-arrow">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                    <polygon points="0 0 24 0 24 24 0 24" />

                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                        x="11" y="5" width="2" height="14" rx="1" />

                                    <path
                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />

                                </g>

                            </svg>

                            <!--end::Svg Icon-->

                        </span>

                    </div>

                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="">

                    </div>


                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="">

                        <div class="wizard-label">

                            <i class="wizard-icon flaticon-responsive"></i>

                            <h3 class="wizard-title">{{ __('اعدادات القالب') }}</h3>

                        </div>

                        <span class="svg-icon svg-icon-xl wizard-arrow">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                    <polygon points="0 0 24 0 24 24 0 24" />

                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                        x="11" y="5" width="2" height="14" rx="1" />

                                    <path
                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />

                                </g>

                            </svg>

                            <!--end::Svg Icon-->

                        </span>

                    </div>


                    <div class="wizard-step" data-wizard-type="step">

                        <div class="wizard-label">

                            <i class="wizard-icon flaticon-list"></i>

                            <h3 class="wizard-title"> {{ __('انتهاء التسجيل') }}</h3>

                        </div>

                        <span class="svg-icon svg-icon-xl wizard-arrow last">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                    <polygon points="0 0 24 0 24 24 0 24" />

                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                        x="11" y="5" width="2" height="14" rx="1" />

                                    <path
                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />

                                </g>

                            </svg>

                            <!--end::Svg Icon-->

                        </span>

                    </div>


                    <!--end::Wizard Step 5 Nav-->

                </div>

            </div>

            <!--end::Wizard Nav-->

            <!--begin::Wizard Body-->

            <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">

                @if (session()->has('message'))
                    <div class="alert {{ session()->get('status') }} alert-dismissible fade show" role="alert">

                        {!! Session::get('message') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>
                @endif

                <div class="col-xl-12 col-xxl-12">

                    <!--begin::Wizard Form-->

                    {{-- <form class="form" id="kt_form"> --}}

                    <form class="form" method="post" id='kt_form' enctype="multipart/form-data">

                        <div class="pb-5 wizard-single-steps account-information" data-wizard-type="step-content"
                            data-wizard-state="current">
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700 ">
                                <div class="body">

                                    <div class="row mb-3">
                                        <div class="col-md-5 align-items-center d-flex info-input-container">
                                            {{-- <img class="me-2" src="{{url('icons/rest-name.svg')}}" /> --}}
                                            <label for="restaurant-name" class="">
                                                company name
                                            </label>
                                        </div>
                                        <div class="col-md-7 align-items-center d-flex">
                                            <div class="input-group input-group-lg">
                                                <input type="email" required=""
                                                    class="form-control inputGroup-sizing-lg rounded-3 w-100"
                                                    name="company_name" id="company_name">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="email" required=""
                                        class="form-control inputGroup-sizing-lg rounded-3 w-100" name="phase1s_id"
                                        id="phase1s_id" value="1" hidden>

                                    <div class="row mb-3">
                                        <div class="col-md-5 align-items-center d-flex info-input-container">
                                            {{-- <img class="me-2" src="{{url('icons/rest-name.svg')}}" /> --}}
                                            <label for="restaurant-name" class="">
                                                company number </label>
                                        </div>
                                        <div class="col-md-7 align-items-center d-flex">
                                            <div class="input-group input-group-lg">
                                                <input type="text" required=""
                                                    class="form-control inputGroup-sizing-lg rounded-3 w-100"
                                                    name="company_number" id="company_number">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-5 align-items-center d-flex info-input-container">
                                            {{-- <img class="me-2" src="{{url('icons/num-employees.svg')}}" /> --}}
                                            <label for="number-of-employees" class="">
                                                bank name</label>
                                        </div>
                                        <div class="col-md-7 align-items-center d-flex">
                                            <div class="input-group input-group-lg">
                                                <input required="" type="text"
                                                    class="form-control inputGroup-sizing-lg rounded-3 w-100"
                                                    id="bank_name" name="bank_name">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="pb-5 wizard-single-steps theme-settings" data-wizard-type="step-content"
                            data-wizard-state="current">
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700 ">
                                <div class="body">

                                    <div class="row mb-3">
                                        <div class="ps-0"><label class="ps-0">
                                                Upload The Logo
                                            </label></div>
                                        <div class="col-md-3 col-2 ">
                                            <div id="logo-input-container"
                                                class="d-flex rounded-3 image-upload-container p-0">
                                                <img id="image-select-icon" class="m-4"
                                                    src="{{ url('icons/upload-the-logo.svg') }}" />
                                                <img id="logo-input-preview" src="" class="display-none" />
                                            </div>
                                            <input id="logo-input" type="file" class="display-none" />
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="pb-5" data-wizard-type="step-content">

                            {{-- <h4 class="mb-10 font-weight-bold text-dark">{{ __('Coupun and Points') }}</h4> --}}

                            <!--begin::Select-->

                            <div class="p-3 mt-2 mb-5 ">

                                <div id="release-menu">

                                    <div class="flex-column d-flex text-center">

                                        <img class="mb-2 m-auto w-auto"
                                            src="https://dashboard.metaemenu.com/congratulations.png">

                                        <h1 class="">تهانينا</h1>

                                        <p class="mb-3">

                                            المنيو الخاص بك جاهز

                                        </p>

                                    </div>

                                    <div class="row mb-3 text-center">

                                        <div class="col-md-3 text-start align-items-center d-flex">


                                        </div>

                                        <div class="col-md-6 my-5">

                                            <div class="row">

                                                <div class="col-md-8 align-items-center d-flex">

                                                    <div class="form-group row m-0">


                                                        <div class="">

                                                            <div class="input-group">

                                                                <label
                                                                    class="col-lg-3 col-form-label text-right">الرابط</label><input
                                                                    type="text" class="form-control"
                                                                    placeholder="Enter your Url" name="url" id="url">

                                                                <div class="input-group-append"><span
                                                                        class="input-group-text">metaemenu.com</span>
                                                                </div>

                                                            </div>

                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="col-md-4 align-items-center d-flex">

                                                    <button type="button"
                                                        class="btn btn-primary font-weight-bolder text-uppercase check-link"
                                                        onclick="performCheckUrl()">افحص الرابط
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-3"></div>

                                    </div>

                                    <div class="row mb-5 launchers">

                                        <div class="col-md-6 text-end col-6">

                                            <button class="btn btn-secondary w-50 disableButton" id="disableButton"
                                                type="button" onclick="storeRouteBlock()">

                                                اضغط هنا للانطلاق

                                            </button>

                                        </div>

                                        <div class="col-md-6 text-start col-6">

                                            <button class="btn btn-secondary w-50 uNDisableButton" id="uNDisableButton"
                                                disabled type="button" onclick="performCheckQR()">انشاء QR
                                            </button>

                                        </div>

                                    </div>

                                    <div class="row mb-3 text-center" id="disableImage" style="display: none;">

                                        <div id="" style="/* display: block; */" class="row">

                                            <div class="col-md-12"><img
                                                    src="https://dashboard.metaemenu.com/images/111.svg" alt="QR"
                                                    class="center pushImage mb-5" id="pushImage"
                                                    style="width: 100px;height: 100px"></div>

                                            <div class="col-md-6 text-right">

                                                <a href="https://dashboard.metaemenu.com/en/dashboard/download/qr"
                                                    class="btn btn-primary mb-3 w-50" style="clear: both;">تحميل</a>

                                            </div>

                                            <div class="col-md-6 text-left">

                                                <a href="https://dashboard.metaemenu.com/ar/dashboard/home"
                                                    class="btn btn-secondary w-50" type="button">الذهاب للرئيسية</a>

                                            </div>


                                        </div>

                                    </div>


                                </div>


                            </div>

                            <!--end::Select-->

                            <!--begin::Select-->

                            <!--end::Select-->

                            <!--begin::Select-->

                            <!--end::Select-->

                        </div>

                        <!--end::Wizard Step 3-->

                        <!--begin::Wizard Step 5-->


                        <!--end::Wizard Step 5-->

                        <!--begin::Wizard Actions-->

                        <div class="d-flex justify-content-between border-top mt-5 pt-10">

                            <div class="mr-2">

                                <button type="button"
                                    class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                    id="previous-step-button" data-wizard-type="action-prev">السابق
                                </button>

                            </div>

                            <div>

                                {{-- <button type="button" onclick="performStore()"
                                        class="btn btn-primary mr-2">Submit</button> --}}

                                {{-- <input type="button"
                                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                        onclick="performStoreData()" value="حفظ"> --}}


                                <button type="button" id="next-step-button"
                                    class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                    data-wizard-type="action-next">التالي
                                </button>

                            </div>

                        </div>

                        <!--end::Wizard Actions-->

                    </form>

                    <!--end::Wizard Form-->

                </div>

            </div>

            <!--end::Wizard Body-->

        </div>

        <!--end::Wizard-->

    </div>

    <!--end::Wizard-->

</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('crudjs/crud.js') }}"></script>
<link href="{{ asset('css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}"></script>
<script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>

<!--begin::Global Config(global config for global JS scripts)-->

<script>
    var KTAppSettings = {

        "breakpoints": {

            "sm": 576,

            "md": 768,

            "lg": 992,

            "xl": 1200,

            "xxl": 1400

        },

        "colors": {

            "theme": {

                "base": {

                    "white": "#ffffff",

                    "primary": "#3699FF",

                    "secondary": "#E5EAEE",

                    "success": "#1BC5BD",

                    "info": "#8950FC",

                    "warning": "#FFA800",

                    "danger": "#F64E60",

                    "light": "#E4E6EF",

                    "dark": "#181C32"

                },

                "light": {

                    "white": "#ffffff",

                    "primary": "#E1F0FF",

                    "secondary": "#EBEDF3",

                    "success": "#C9F7F5",

                    "info": "#EEE5FF",

                    "warning": "#FFF4DE",

                    "danger": "#FFE2E5",

                    "light": "#F3F6F9",

                    "dark": "#D6D6E0"

                },

                "inverse": {

                    "white": "#ffffff",

                    "primary": "#ffffff",

                    "secondary": "#3F4254",

                    "success": "#ffffff",

                    "info": "#ffffff",

                    "warning": "#ffffff",

                    "danger": "#ffffff",

                    "light": "#464E5F",

                    "dark": "#ffffff"

                }

            },

            "gray": {

                "gray-100": "#F3F6F9",

                "gray-200": "#EBEDF3",

                "gray-300": "#E4E6EF",

                "gray-400": "#D1D3E0",

                "gray-500": "#B5B5C3",

                "gray-600": "#7E8299",

                "gray-700": "#5E6278",

                "gray-800": "#3F4254",

                "gray-900": "#181C32"

            }

        },

        "font-family": "Poppins"

    };
</script>




<script>
    $(document).ready(function() {

        // Add smooth scrolling to all links

        $("a").on('click', function(event) {


            // Make sure this.hash has a value before overriding default behavior

            if (this.hash !== "") {

                // Prevent default anchor click behavior

                event.preventDefault();


                // Store hash

                var hash = this.hash;


                // Using jQuery's animate() method to add smooth page scroll

                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area

                $('html, body').animate({

                    scrollTop: $(hash).offset().top

                }, 800, function() {


                    // Add hash (#) to URL when done scrolling (default click behavior)

                    window.location.hash = hash;

                });

            } // End if

        });

    });
</script>

<script>
    $(function() {
        async function storeInfo(url, data) {
            var result = await axios.post(url, data)

                .then(function(response) {

                    showMessage(response.data);
                    return response.data.state
                })
                .catch(function(error) {
                    if (error.response.data.errors !== undefined) {

                        showErrorMessages(error.response.data.errors);

                    } else {
                        console.log(error.response)
                        Swal.fire({
                            position: 'center',
                            icon: error.response.data.icon,
                            title: error.response.data.title,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    return false
                });
            return result

        }

        $('#next-step-button').on('click', function() {

            var currentStepContainer = $('.wizard-single-steps[data-wizard-state="current"]').prev();
            var formData = new FormData()

            if (currentStepContainer.hasClass('account-information')) {
                let formData = new FormData();

                formData.append('company_name', $('#company_name').val())
                formData.append('company_number', $('#company_number').val())
                formData.append('bank_name', $('#bank_name').val())
                formData.append('phase1s_id', $('#phase1s_id').val())

                storeInfo("{{ route('update.phases1') }}", formData).then((res) => {

                    if (res == false) {

                        $('#previous-step-button').trigger('click')
                    }
                })
            }

            if (currentStepContainer.hasClass('branches')) {
                let formData = new FormData();
                formData.append('branch_id', document.getElementById('branch_id').value);
                formData.append('longLocation', document.getElementById('longLocation').value);
                formData.append('latLocation', document.getElementById('latLocation').value);
                formData.append('branch_name_en', document.getElementById('branch_name_en').value);
                formData.append('branch_name', document.getElementById('branch_name').value);

            }

            if (currentStepContainer.hasClass('theme-settings')) {
                console.log(hbhhbbjhb);
                let formData = new FormData();
                formData.append('logo', $('#logo-input')[0].files[0])
                if ($('#day0').is(':checked')) {
                    formData.append('0_from', $('#0_from').val())
                    formData.append('0_to', $('#0_to').val())
                }
                if ($('#day1').is(':checked')) {
                    formData.append('1_from', $('#1_from').val())
                    formData.append('1_to', $('#1_to').val())
                }

                if ($('#day2').is(':checked')) {
                    formData.append('2_from', $('#2_from').val())
                    formData.append('2_to', $('#2_to').val())
                }
                if ($('#day3').is(':checked')) {
                    formData.append('3_from', $('#3_from').val())
                    formData.append('3_to', $('#3_to').val())
                }
                if ($('#day4').is(':checked')) {
                    formData.append('4_from', $('#4_from').val())
                    formData.append('4_to', $('#4_to').val())
                }
                if ($('#day5').is(':checked')) {
                    formData.append('5_from', $('#5_from').val())
                    formData.append('5_to', $('#5_to').val())
                }
                if ($('#day6').is(':checked')) {
                    formData.append('6_from', $('#6_from').val())
                    formData.append('6_to', $('#6_to').val())
                }


                // saveThemeSettings();
            }
        })

    });
</script>
@endsection
