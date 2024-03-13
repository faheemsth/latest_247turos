 <!-- Rotate Div Sec  -->
 @if(request()->segment(1) == '' || request()->segment(1) == 'faq' || request()->segment(1) == 'find-tutor' || request()->segment(1) == 'blogs' || request()->segment(1) == 'prices'|| request()->segment(1) == 'student-apply-steps'|| request()->segment(1) == 'tutor-apply-steps' || request()->segment(1) == 'organization-apply-steps' || request()->segment(1) == 'login-roles' || request()->segment(1) == 'login' || request()->segment(1) == 'videos-guides'|| request()->segment(1) == 'sitemap'|| request()->segment(1) == 'privacy-policy' || request()->segment(1) == 'testimonials'  )
<div class="first-rotate d-none d-lg-block">
    <a href='{{route('blogs')}}' class="btn fw-bold" id="btn-bg">Blog</a>
    <a href='{{route('faq')}}' class="btn fw-bold" id="btn-bg">FAQS</a>
</div>

<div class="second-rotate d-none d-lg-block">
    <a href='{{route('tutorApplySteps')}}' class="btn fw-bold" id="btn-bg">Become a Tutor</a>
    <a href='{{route('studentApplySteps')}}' class="btn fw-bold" id="btn-bg">Become a Student</a>
</div>
@endif
  <!-- Rotate Div Sec end -->
