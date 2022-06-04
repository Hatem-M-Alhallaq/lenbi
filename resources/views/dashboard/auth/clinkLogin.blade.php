
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title>visits | Login</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{asset('css/pages/login/classic/login-1.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{asset('css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{asset('media/logos/favicon.ico')}}" />

<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">


	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: url('media/logos/bg151.jpg'); width: 600px;" >
					<!--begin: Aside Container-->
					<div class="d-flex flex-row-fluid flex-column justify-content-between">
						<!--begin: Aside header-->
						<a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">
							<img src="{{asset('media/logos/Untitled-11111.png')}}" class="max-h-70px" alt="" />
						</a>
						<!--end: Aside header-->
						<!--begin: Aside content-->
					 
						<!--end: Aside content-->
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
					<!--begin::Content header-->
					<div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
						<span class="font-weight-bold text-dark-50">Dont have an account yet?</span>
						<a href="javascript:;" class="font-weight-bold ml-2" id="kt_login_signup">Sign Up!</a>
					</div>
					<!--end::Content header-->
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
						<!--begin::Signin-->
						<div class="login-form login-signin">
							<div class="text-center mb-10 mb-lg-20">
								<h3 class="font-size-h1">Sign In</h3>
								<p class="text-muted font-weight-bold">Enter your username and password</p>
							</div>
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_login_signin_form">
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="email"  id="email" />
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Password" id="password" />
								</div>
								<!--begin::Action-->

                  <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="button" onclick="login()" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
								<!--end::Action-->
							</form>
							<!--end::Form-->

              
						</div>
						<!--end::Signin-->
						<!--begin::Signup-->

						<!--end::Signup-->
					</div>
					<!--end::Content body-->
					<!--begin::Content footer for mobile-->
					<div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
						<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 2020 Metronic</div>
						<div class="d-flex order-1 order-sm-2 my-2">
							<a href="#" class="text-dark-75 text-hover-primary">Privacy</a>
							<a href="#" class="text-dark-75 text-hover-primary ml-4">Legal</a>
							<a href="#" class="text-dark-75 text-hover-primary ml-4">Contact</a>
						</div>
					</div>
					<!--end::Content footer for mobile-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
	

{{-- Scripts Section --}}

	<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
		<script src="{{asset('js/scripts.bundle.js')}}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{asset('js/pages/custom/login/login-general.js')}}"></script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>

  <script>
  function login() {
    // var guard = '{{request('guard')}}';
    axios.post('', {
      email: document.getElementById('email').value,
      password: document.getElementById('password').value,
      remember_me: document.getElementById('remember').checked,
    //   guard: guard
    })
    .then(function (response) {
        window.location.href = '/cms/admin'
        // showToaster(response.data.message, true);
    })
        .catch(function (error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {
                showMessage(error.response.data);
            }
        });
  }
</script>


		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>





