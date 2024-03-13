@extends('pages.dashboard.appstudent')
@section('content')
@if (Auth::check())
@if (Auth::user()->role_id == '4')
@include('layouts.studentnav')
@elseif (Auth::user()->role_id == '3')
@include('layouts.tutornav')
@elseif (Auth::user()->role_id == '5')
@include('layouts.parentnav')

@elseif (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
@include('layouts.navbar')
@endif
@else
@include('layouts.navbar')
@endif
<script src="{{ asset('js/jsdelivrcore.js') }}"></script>
<script src="{{ asset('js/jsdelivr.js') }}"></script>
<style>
  .profileeditdiv {
    opacity: 0;
  }

  .profileeditdiv:hover {
    opacity: 0.8;
  }
</style>
<div class="container-fluid">
  <div class="container">

    @if (session('failed'))
    <div class="alert alert-danger">
      {{ session('failed') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    {{-- <div class="row mt-5 mb-5 flex-row">
      <div class="col-12 col-md-3 image1">
        <img src="{{ url(Auth::user()->image ?? '') }}" alt="" class="img-fluid">
      </div>
      <div class="col-12 col-md-9">
        <div class="row">
          <div class="col-md-6 mt-lg-5 ard">
            <h5>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}<img src="/assets/images/Verified-p.png"
                alt=""></h5>
            <p>Spreading knowledge everywhere that's all I do</p>
          </div>
          <div class="col-md-6 mt-lg-5 text-end hr pe-4">
            <h5>£25 /hr</h5>
          </div>

          <div class="row mt-lg-3">
            <div class="col-md-9 student-home justify-content-center">
              <a href=""><img src="/assets/images/location.png" alt=""> Student's
                home</a>
              <a href=""><img src="/assets/images/Vector (2).png" alt=""> Online</a>
            </div>
            <div class="col-md-3 saved text-end">
              <p><img src="/assets/images/heart.png" alt=""> Saved</p>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="row mt-5 mb-5">
        
        
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<div class="container" style="margin-top:30px;">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row" style="display: block;">
                <div class="col-md-4 text-center">
                    <div id="cropie-demo" style="width:250px"></div>
                </div>
                <div class="col-md-4">
                    <label for="file-upload" class="btn btn-primary" id="file-upload-label">File</label>
                    <input type="file" id="file-upload" style="display: none;">
                    <br>
                    <div class="text-center"> <!-- Centering both buttons -->
                        <button class="btn btn-success upload-result" style="display: none;">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $uploadCrop = $('#cropie-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#file-upload').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#file-upload-label').hide(); // Hide the "Choose File" button when a file is selected
        $('.upload-result').show(); // Show the "Upload Image" button when a file is selected
    });

    $('.upload-result').on('click', function(ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(resp) {
            $.ajax({
                url: "{{ url('imageCrop') }}",
                type: "POST",
                data: {
                    "image": resp
                },
                success: function(data) {
                    html = '<img src="' + resp + '" />';
                    $("#image-preview").html(html);
                }
            });
        });
    });

    $('.btn-primary').on('click', function() {
        $('#file-upload').click();
    });
</script>






      <div class="col-12 col-lg-3 col-xl-2 image1 d-flex justify-content-lg-center position-relative">
        <div class="profileeditdiv d-flex justify-content-center align-items-center"
          style="width: 170px;height: 170px;background-color: #cfcfcf;border-radius: 50%; position: absolute;top:0px;">
          <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn px-4" style="background-color: #080808;
                        color: white;">Edit</button>
        </div>
        @if (!empty(Auth::user()->image) && file_exists(public_path(Auth::user()->image)))
        <img src="{{ asset(Auth::user()->image) }}" alt="" style="width: 170px;height: 170px;
                        border-radius: 50%;">
        @else
        <img src="{{ asset('assets/images/default.png') }}" alt="" style="    width: 170px;
                        height: 170px;
                        border-radius: 50%;">
        @endif
      </div>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Upload Profile</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form1" runat="server" action="{{ url('/Upload/Image') }}" method="post"
              enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="row gap-4">

                  <div class="col-12 my-3" style="position: relative;">
                    <div class="btn text-center btn-primary w-100 p-1">
                      <h5>Upload Image</h5>
                    </div>
                    <div class="btn btn-primary w-100 p-1" style="position: absolute;top:0px;left:0px;opacity: 0;">
                      <input id="imgInp" type="file" name="image" placeholder="Select Your picture" class="w-100">
                    </div>
                  </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class=" col-md-8 col-12 ps-lg-0 mt-2 ms-2 ms-md-0">
        <div class="d-flex justify-content-between mt-lg-4 hr align-items-center">

          <h4>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}<img src="./assets/images/Verified-p.png"
              alt=""></h4>

        </div>
        <div class="Spreading">
          <h6 style="font-weight: 500;color:#3d3d3d;">{{ Auth::user()->facebook_link }}</h6>
        </div>

        <div class="mt-md-3 mt-lg-5 d-flex gap-2">
          <a class="btn btn-outline-primary text-dark" href="">Student's home</a>

          <a class="mb-0 one alert alert-{{ Auth::user()->status == 'Active' ? 'success' : 'danger' }}" href="">{{
            Auth::user()->status }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        {{-- <div class="col-md-8 d-flex justify-content-between align-items-center book mt-3 ms-3 ms-md-0">
          <p><img src="./assets/images/heart.png" alt=""> Saved</p>

        </div> --}}

      </div>
    </div>
    <div class="mt-3 about">
      <h2>About</h2>
      {{-- <p>Hi! My name is {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} </p> --}}
      <p>{{ Auth::user()->profile_description }}</p>
    </div>

    <!-- Arman D end -->

    <!-- General Detail start -->
    <div class="row gende">
      <div class="col-md-12 general mt-5 mb-2">
        <h2>General Detail</h2>
      </div>
      <div class="row general-detail mb-5">
        {{-- start --}}
        <div class="col-md-12">
          <form action="{{ url('update_student_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5 mt-3">
              <div class="col-md-6 mb-3 mb-md-0">

                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control" id=""
                  required placeholder="Type Your First Name">

              </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Surname</label>
                <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" id=""
                  required placeholder="Type Your Surname">

              </div>
            </div>

            <div class="row mt-md-5 mt-3">
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="" required
                  placeholder="Type Your Email Address">
              </div>
              <!--<div class="col-md-6 mb-3 mb-md-0">-->
              <!--    <label for="exampleFormControlInput1" class="form-label">Password</label>-->
              <!--    <input type="password" name="password" value="" class="form-control"-->
              <!--        id="" required placeholder="Type Your Password">-->
              <!--</div>-->
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" id="" required
                  placeholder="Type Your Phone">
              </div>
            </div>

            <div class="row mt-md-5 mb-md-5 mt-3">
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <input type="text" name="gender" value="{{ Auth::user()->gender }}" class="form-control" id="" required
                  placeholder="Type Your gender">
              </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">DOB</label>
                <input type="date" name="dob" value="{{ Auth::user()->dob }}" class="form-control" id="" required
                  placeholder="Type Your dob" max="9999-12-31">
              </div>
            </div>
            <div class="row mt-md-5 mb-md-5 mt-3">
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Tagline</label>
                <input type="text" name="facebook_link" value="{{ Auth::user()->facebook_link }}" class="form-control"
                  id="" placeholder="Type Your Tag Line For Profile">
              </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Postcode</label>
                <input type="text" name="zipcode" class="form-control" id="zipcode" required
                  placeholder="Type Your Postcode" value="{{ Auth::user()->zipcode }}"
                  title="Please enter only numbers">
              </div>
            </div>
            <div class="row mt-md-5 mb-md-5 mt-3">
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Biography</label>
                <textarea name="profile_description" class="form-control" id="profile_description" cols="30"
                  rows="3">{{ Auth::user()->profile_description }}</textarea>
              </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <textarea name="address" class="form-control" id="address" cols="30"
                  rows="3">{{ Auth::user()->address }}</textarea>
              </div>
            </div>
            <div class="row mt-md-5 mb-md-5 mt-3 justify-content-md-center">
              <div class="col-md-3 text-md-center mb-3 mb-md-0">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </form>
        </div>
        {{-- end --}}

      </div>
    </div>


    <div class="row my-4">
      <form action="{{ url('user-card-create') }}" method="post" class="ps-0">
        @csrf
        <div class="col-12 col-md-7 col-lg-6 col-xl-5 mt-2 billing about">
          <h2 class="mb-1">Configure Your Paypal Account</h2>
          <div>
            <h4 class="text-left text-secondary fs-4 my-3">We will use this paypal account to send you money when you
              initiate withdrawl.</h4>

          </div>
        </div>

        <div class="col-12">

          <div class="row mb-3">
            <div class="col-md-5 col-11 col-lg-4">
              <div class='form-group required'>
                <label class='control-label'>Paypal account email</label>
                <input class=" w-100 p-2 mt-1" type='email' value="{{\Auth::user()->paypal_email}}" required
                  name="paypal_email">
              </div>
            </div>

          </div>

          <div class="row  mb-3">
            <div class="col-md-5 col-11 col-lg-4">
              <div class='form-group required'>
                <label class='control-label'>Confirm email</label><br>
                <input class=" w-100 p-2 mt-1" type='email' required name="paypal_email_confirm">
              </div>
            </div>

          </div>

          <div class="row my-3">
            <div class="col-2">
              <button class="btn bg-primary  px-4 py-2 text-white">Save</button>
            </div>
          </div>


        </div>

      </form>

    </div>
  </div>
</div>
<!-- main js file -->
<script src="./assets/js/main.js"></script>
<!-- jquery file -->
<script src="{{asset('vendor/jquery/jquery3.7.0.js')}}"></script>
<!-- Bootstrap js file -->
<script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script>
  // $(document).ready(function() {
  //     $('#zipcode').on('input', function() {
  //         // Remove non-numeric characters using a regular expression
  //         $(this).val($(this).val().replace(/\D/g, ''));
  //     });
  // });
</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function () {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
      '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  $('#cvcInput').on('input', function () {
    const cvcInput = $(this).val().replace(/\D/g, '').substring(0, 3);
    const formattedDisplay = cvcInput.replace(/(\d{4})(?=\d)/g, '$1 ');
    $(this).val(formattedDisplay);
  });

  $('#cardInput').on('input', function () {
    const cardInput = $(this).val().replace(/\D/g, '').substring(0, 16);
    const formattedDisplay = cardInput.replace(/(\d{4})(?=\d)/g, '$1 ');
    $(this).val(formattedDisplay);
  });

  $(function () {
    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function (e) {
      var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
          'input[type=text]', 'input[type=file]',
          'textarea'
        ].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
      $errorMessage.addClass('hide');

      $('.has-error').removeClass('has-error');
      $inputs.each(function (i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });

      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error')
          .removeClass('hide')
          .find('.alert')
          .text(response.error.message);
      } else {
        /* token contains id, last4, and card type */
        var token = response['id'];

        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
      }
    }

  });
</script>
<script>
  const currentYear = new Date().getFullYear();
  const expYearInput = document.getElementById("exp_year_input");

  expYearInput.addEventListener("input", () => {
    expYearInput.value = expYearInput.value.replace(/\D/g, '');
    expYearInput.value = expYearInput.value.slice(0, 2);

    const inputValue = expYearInput.value;

    if (/^\d{2}$/.test(inputValue)) {
      if (inputValue < currentYear % 100) {
        expYearInput.setCustomValidity("Expiration year should be this year or later.");
      } else {
        expYearInput.setCustomValidity("");
      }
    } else {
      expYearInput.setCustomValidity("Please enter a valid 2-digit year.");
    }
  });
</script>
@endsection