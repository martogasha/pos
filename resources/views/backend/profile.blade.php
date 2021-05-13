@include('backendPartial.nav')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card car-transparent">
                        <div class="card-body p-0">
                            <div class="profile-image position-relative">
                                <img src="assets/images/page-img/profile.png" class="img-fluid rounded w-100" alt="profile-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-sm-0 px-3">
                <div class="col-lg-8 card-profile">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#profile1" role="tab" aria-selected="false">Personal Information</a>
                                </li>
                            </ul>
                            <div class="profile-content tab-content">

                                <div id="profile1" class="tab-pane fade active show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name *</label>
                                                    <input type="text" class="form-control" id="first_name" value="{{\Illuminate\Support\Facades\Auth::user()->first_name}}" placeholder="Enter First Name" data-errors="Please Enter First Name." required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name *</label>
                                                    <input type="text" class="form-control" id="last_name" value="{{\Illuminate\Support\Facades\Auth::user()->last_name}}" placeholder="Enter Last Name" data-errors="Please Enter Last Name." required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input type="email" class="form-control" id="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" placeholder="Enter Email Address" data-errors="Please Enter Email Address." required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number *</label>
                                                    <input type="text" class="form-control" id="phone" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" placeholder="Enter Phone Number" data-errors="Please Enter Phone Number." required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Role *</label>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role==1)
                                                    <input type="text" class="form-control" value="User" disabled>
                                                    @else
                                                        <input type="text" class="form-control" value="Adnin" disabled>
                                                    @endif
                                                        <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="floating-input form-control" type="password" id="password1" placeholder=" " required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input class="floating-input form-control" type="password" id="confirmPassword1" required>
                                                </div>
                                            </div>

                                        </div>
                                        <span class="badge badge-success" id="passwordMatch">Password match</span>
                                        <span class="badge badge-danger" id="passwordError">Password don't match match</span>
                                        <input type="hidden" id="user_role" value="{{\Illuminate\Support\Facades\Auth::user()->role}}">
                                        <input type="hidden" id="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                        <button type="button" class="btn btn-primary mr-2" id="UpdateUserInfo">Update</button>
                                    </div>
                                </div>
                                <div id="profile2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card card-block card-stretch mb-0">
                                                <div class="card-header px-4">
                                                    <div class="header-title">
                                                        <h4 class="card-title">Personal Skills</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="p-2 bg-warning rounded w-100 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="skill-number">1.</span>
                                                            <p class="mb-0">Creative spirit</p>
                                                        </div>
                                                    </div>
                                                    <div class="p-2 bg-danger rounded w-100 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="skill-number">2.</span>
                                                            <p class="mb-0">Management</p>
                                                        </div>
                                                    </div>
                                                    <div class="p-2 bg-info rounded w-100 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="skill-number">3.</span>
                                                            <p class="mb-0">Organized</p>
                                                        </div>
                                                    </div>
                                                    <div class="p-2 bg-success rounded w-100 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="skill-number">4.</span>
                                                            <p class="mb-0">Team Player</p>
                                                        </div>
                                                    </div>
                                                    <div class="p-2 bg-danger rounded w-100">
                                                        <div class="d-flex align-items-center">
                                                            <span class="skill-number">5.</span>
                                                            <p class="mb-0">Professional</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card card-block card-stretch">
                                                <div class="card-body p-3">
                                                    <div class="row align-items-center text-center py-2">
                                                        <div class="profile-info col-xl-3 col-lg-6">
                                                            <div class="profile-icon icon m-auto rounded bg-warning">
                                                                <svg class="svg-icon" width="22" height="22" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                                                                        fill="#d63a00" />
                                                                </svg>
                                                            </div>
                                                            <h5 class="mb-2 mt-3 icon-text-warning">15+</h5>
                                                            <p class="mb-0">Awards</p>
                                                        </div>
                                                        <div class="profile-info col-xl-3 col-lg-6">
                                                            <div class="profile-icon icon m-auto rounded bg-info">
                                                                <svg class="svg-icon" width="22" height="22" viewBox="0 0 60 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M23.9091 24.5297C24.495 25.1156 25.4447 25.1156 26.0306 24.5297L27.0909 23.4694C27.6769 22.8834 27.6769 21.9338 27.0909 21.3478L23.7422 18L27.09 14.6512C27.6759 14.0653 27.6759 13.1156 27.09 12.5297L26.0297 11.4694C25.4437 10.8834 24.4941 10.8834 23.9081 11.4694L18.4387 16.9387C17.8528 17.5247 17.8528 18.4744 18.4387 19.0603L23.9091 24.5297V24.5297ZM32.91 23.4703L33.9703 24.5306C34.5563 25.1166 35.5059 25.1166 36.0919 24.5306L41.5613 19.0613C42.1472 18.4753 42.1472 17.5256 41.5613 16.9397L36.0919 11.4703C35.5059 10.8844 34.5563 10.8844 33.9703 11.4703L32.91 12.5306C32.3241 13.1166 32.3241 14.0662 32.91 14.6522L36.2578 18L32.91 21.3488C32.3241 21.9347 32.3241 22.8844 32.91 23.4703V23.4703ZM58.5 39H35.7694C35.7 40.8572 34.3903 42 32.7 42H27C25.2478 42 23.9044 40.3622 23.9278 39H1.5C0.675 39 0 39.675 0 40.5V42C0 45.3 2.7 48 6 48H54C57.3 48 60 45.3 60 42V40.5C60 39.675 59.325 39 58.5 39ZM54 4.5C54 2.025 51.975 0 49.5 0H10.5C8.025 0 6 2.025 6 4.5V36H54V4.5ZM48 30H12V6H48V30Z"
                                                                        fill="#32BDEA" />
                                                                </svg>
                                                            </div>
                                                            <h5 class="mb-2 mt-3 icon-text-info">35+</h5>
                                                            <p class="mb-0">Certificate</p>
                                                        </div>
                                                        <div class="profile-info col-xl-3 col-lg-6">
                                                            <div class="profile-icon icon m-auto rounded bg-danger">
                                                                <svg class="svg-icon" width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M35.3676 11.2517C34.8398 11.2372 34.3256 11.3198 33.8438 11.4898V7.03125C33.8438 4.70503 31.9512 2.8125 29.625 2.8125C29.0759 2.8125 28.5517 2.91909 28.0701 3.11072C27.5821 1.32047 25.9428 0 24 0C22.0572 0 20.4179 1.32047 19.9299 3.11072C19.4483 2.91909 18.9241 2.8125 18.375 2.8125C16.0488 2.8125 14.1562 4.70503 14.1562 7.03125V11.4895C13.6747 11.3198 13.1607 11.2372 12.6324 11.2517C10.3711 11.3136 8.53125 13.2316 8.53125 15.5272V48H36.6562V41.2395L38.5637 36.4704C39.1643 34.9689 39.4688 33.3877 39.4688 31.7705V15.5272C39.4688 13.2316 37.6289 11.3136 35.3676 11.2517V11.2517ZM11.3438 45.1875V42.375H33.8438V45.1875H11.3438ZM36.6562 31.7705C36.6562 33.0283 36.4194 34.2581 35.9523 35.4261L34.2979 39.5625H11.3438V15.5272C11.3438 14.7405 11.9564 14.0837 12.7095 14.0631C13.0926 14.0504 13.4561 14.1937 13.7305 14.4607C14.0051 14.7278 14.1563 15.0858 14.1563 15.4687V21.9843H16.9688V7.03125C16.9688 6.25584 17.5997 5.625 18.3751 5.625C19.1505 5.625 19.7813 6.25584 19.7813 7.03125V21.9844H22.5938V4.21875C22.5938 3.44334 23.2247 2.8125 24.0001 2.8125C24.7755 2.8125 25.4063 3.44334 25.4063 4.21875V21.9844H28.2188V7.03125C28.2188 6.25584 28.8497 5.625 29.6251 5.625C30.4005 5.625 31.0313 6.25584 31.0313 7.03125V24.1714C24.712 24.8732 19.7812 30.2467 19.7812 36.75H22.5938C22.5938 31.3222 27.0097 26.9062 32.4375 26.9062H33.8438V15.4688C33.8438 15.0859 33.995 14.7278 34.2696 14.4608C34.544 14.1938 34.9067 14.0508 35.2906 14.0632C36.0436 14.0838 36.6562 14.7406 36.6562 15.5273V31.7705Z"
                                                                        fill="#e83e8c" />
                                                                </svg>
                                                            </div>
                                                            <h5 class="mb-2 mt-3 icon-text-danger">04+</h5>
                                                            <p class="mb-0">Experience</p>
                                                        </div>
                                                        <div class="profile-info col-xl-3 col-lg-6">
                                                            <div class="profile-icon icon m-auto rounded bg-success">
                                                                <svg class="svg-icon" width="22" height="22" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                                                                        fill="#336c47" />
                                                                </svg>
                                                            </div>
                                                            <h5 class="mb-2 mt-3 icon-text-success">90+</h5>
                                                            <p class="mb-0">Participated</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12">
                                                    <div class="card card-block card-stretch mb-0">
                                                        <div class="card-header px-3">
                                                            <div class="header-title">
                                                                <h4 class="card-title">Languages</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            <ul class="list-inline p-0 mb-0">
                                                                <li>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <p class="mb-0 font-size-16 mr-3">English</p>
                                                                        <h6>78%</h6>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                                        <p class="mb-0">German</p>
                                                                        <h6>55%</h6>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <p class="mb-0">Spanish</p>
                                                                        <h6>50%</h6>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <div class="card card-block card-stretch mb-0">
                                                        <div class="card-header px-3">
                                                            <div class="header-title">
                                                                <h4 class="card-title">Social</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            <ul class="list-inline p-0 m-0">
                                                                <li class="mb-2 d-flex">
                                                                    <span><i class="lab la-facebook-f icon-text-primary font-size-20 mr-3"></i></span>
                                                                    <p class="mb-0 line-height">fb.me/nataliedawson</p>
                                                                </li>
                                                                <li class="mb-2 d-flex">
                                                                    <span><i class="lab la-twitter icon-text-info font-size-20 mr-3"></i></span>
                                                                    <p class="mb-0 line-height">@nataliedawson</p>
                                                                </li>
                                                                <li class=" d-flex">
                                                                    <span><i class="lab la-instagram  icon-text-danger font-size-20 mr-3"></i></span>
                                                                    <p class="mb-0 line-height">@natalietweets</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile3" class="tab-pane fade">
                                    <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                        <ul class="list-inline p-0 m-0 w-100">
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">October, 2018</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">PhD of Science in computer Science</h6>
                                                                <p class="mb-0 font-size-14">South Kellergrove University</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">June, 2017</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Master of Science in Computer Science</h6>
                                                                <p class="mb-0 font-size-14">Milchuer College</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">August, 2014</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Bachelor of Science in Computer Science</h6>
                                                                <p class="mb-0 font-size-14">Beechtown Universityy</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">June, 2010</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-0 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Senior High School</h6>
                                                                <p class="mb-0 font-size-14">South Kellergrove High</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="profile4" class="tab-pane fade">
                                    <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                        <ul class="list-inline p-0 m-0 w-100">
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2020 - present</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Software Engineer at Mathica Labs</h6>
                                                                <p class="mb-0 font-size-14">Total : 02 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2018 - 2019</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Zimcore Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : 1.5 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2017 - 2018</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Skycare Ptv. Ltd</h6>
                                                                <p class="mb-0 font-size-14">Total : 0.5 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-3">
                                                        <h6 class="mb-2">06 Months</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="media profile-media pb-0 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Infosys Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : Freshers</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="profile5" class="tab-pane fade">
                                    <p>I'm Web Developer from California. I code and design websites worldwide. Mauris variustellus vitae
                                        tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus
                                        erat ac nulla.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis mattis nam ipsum pharetra porttitor eu
                                        orci, nisi. Magnis elementum vitae eu, dui et. Tempus etiam feugiat sem augue sed sed. Tristique
                                        feugiat mi feugiat integer consectetur sit enim penatibus. Quis sagittis proin fermentum tempus
                                        uspendisse ultricies. Tellus sapien, convallis proin pretium.</p>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis mattis nam ipsum pharetra porttitor eu.
                                        Tristique feugiat mi feugiat integer consectetur sit enim penatibus. Quis sagittis proin fermentum tempus
                                        uspendisse ultricies. Tellus sapien, convallis proin pretium.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->
<footer class="iq-footer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="backend/privacy-policy.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="backend/terms-of-service.html">Terms of Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1"><script data-cfasync="false" src="http://iqonic.design/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Backend Bundle JavaScript -->
<script src="assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="assets/js/chart-custom.js"></script>

<!-- app JavaScript -->
<script src="assets/js/app.js"></script>
</body>
<script>
    $(document).ready(function () {
        $('#passwordError').hide();
        $('#passwordMatch').hide();
    });
    $('#confirmPassword1').on('keyup',function () {
        if ($('#password1').val() == $('#confirmPassword1').val() ){
            $('#passwordMatch').show();
            $('#passwordError').hide();
        }
        else {
            $('#passwordError').show();
            $('#passwordMatch').hide();
        }
    });
    $('#UpdateUserInfo').click(function () {
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var user_role = $('#user_role').val();
        var user_id = $('#user_id').val();
        var password = $('#password1').val();
        $.ajax({
            type:"get",
            url:"{{url('update')}}",
            data:{'first_name':first_name,'last_name':last_name,'phone':phone,'email':email,'role':user_role,'user_id':user_id,'password':password},
            success:function (data) {
                location.reload();
                alert('SUCCESS PROFILE UPDATED SUCCESS')
            },
            error:function (error) {
                console.log(error)
                alert('error')

            }

        });
    });
</script>

<!-- Mirrored from iqonic.design/themes/posdash/html/app/user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Mar 2021 21:32:48 GMT -->
</html>
