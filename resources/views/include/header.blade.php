
<style>
    #userDropdown:focus{
        border: none;
        outline: none;
        box-shadow: none;
    }
    .dropdown-menu{
        transform: translate(-130px, 47px) !important;
    }
    .dropdown-menu:after, .dropdown-menu::after {
    left: 140px !important;

    }
</style>


<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <div id="google_element"></div>
                <div class="header-search">
                    {{-- <div class="input-group">

                        <span class="input-group-addon search-close">
                            <i class="ik ik-x"></i>
                        </span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div> --}}
                </div>


            </div>
            <div class="top-menu d-flex ">
                <!-- A comment Icon in the Dashboard -->

                        <a href="{{ url('/') }}" style="background-color: #2222;
                        border-radius: 50%;
                        width: 33px;
                        height: 33px;
                        display: flex;
                        margin-right: 10px;
                        align-items: center;
                        justify-content: center;">
                            <img src="{{ asset('assets/images/icons8-web-50.png') }}" alt="" srcset="" width="20px">
                        </a>
                        <button type="button" class="nav-link right-sidebar-toggle"><i
                            class="ik ik-message-square"></i>
                            <span id="CountAppend"></span>
                        </button>
                <div class="dropdown">
                    <a class="btn dropdown-toggle rounded p-0" id="userDropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="avatar" src="{{ asset(Auth::user()->image) }}" alt="">
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li class=""><a class="dropdown-item" href="{{ url('/profile_details') }}">  {{ __('Profile') }}</a></li>
                      {{-- <li><a class="dropdown-item" href="#"> {{ __('Message') }}</a></li> --}}
                      <li><a class="dropdown-item" href="{{ url('logout') }}"> {{ __('Logout') }}</a></li>
                    </ul>
                  </div>

            </div>
        </div>
    </div>
</header>
<script src="{{ asset('vendor/jquery/jquery3.7.0.js') }}"></script>
<script>
setInterval(function() {
            refreshchat();
        }, 1000);
function refreshchat() {

$.ajax({
        url: "{{ url('get/notification') }}",
        type: 'GET',
        success: function(response) {
          $('#AppendNotification').html('');
          $('#CountAppend').text('');
          $('#AppendNotification').html(response.html);
        //   $('#CountAppend').text(response.count);
        if(response.count > 0)
        {
            $('#CountAppend').html('<span class="badge bg-success">' + response.count + '</span>');
        }


        },

    });

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

