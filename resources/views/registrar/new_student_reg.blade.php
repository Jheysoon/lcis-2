@extends('layouts.master')

@section('title', 'New Student Registration')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" media="screen" title="no title" charset="utf-8">
@endsection

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">New Student Registration</h3>
            </div>

            <div class="card-block">
                <h3 class="col-sm-offset-1">Student Information</h3>
                <hr>
                <div class="col-sm-8 col-sm-offset-1">
                    <label>Lastname <small class="required">(required)</small></label>
                    <input type="text" class="form-control" name="lastname" value="{{ request('lastname') }}">

                    <label>Firstname <small class="required">(required)</small></label>
                    <input type="text" class="form-control" name="firstname" value="{{ request('firstname') }}">

                    <label>Middlename <small class="required">(required)</small></label>
                    <input type="text" class="form-control" name="middlename" value="{{ request('middlename') }}">
                    <br/>
                    <hr>
                    <br/>
                    <label>Course</label>
                    <select class="form-control" name="course">

                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->description }}</option>
                        @endforeach

                    </select>

                    <label>Major <small class="optional">(optional)</small></label>
                    <select class="form-control" name="major">

                        @foreach($majors as $major)
                            <option value="{{ $major->id }}">{{ $major->description }}</option>
                        @endforeach

                    </select>

                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>Male</option>
                        <option value="0" {{ request('gender') == 0 ? 'selected' : '' }}>Female</option>
                    </select>

                    <label>Marital Status</label>
                    <select class="form-control" name="maritalstatus">
                        <option value="0" {{ request('maritalstatus') == 0 ? 'selected' : '' }}>SINGLE</option>
                        <option value="1" {{ request('maritalstatus') == 1 ? 'selected' : '' }}>MARRIED</option>
                        <option value="2" {{ request('maritalstatus') == 2 ? 'selected' : '' }}>SEPARATED</option>
                        <option value="3" {{ request('maritalstatus') == 3 ? 'selected' : '' }}>WIDOWED</option>
                    </select>

                    <label>Religion</label>
                    <select class="form-control" name="religion">

                        @foreach($religions as $religion)
                            <option value="{{ $religion->id }}">{{ $religion->description }}</option>
                        @endforeach

                    </select>

                    <label>Nationality</label>
                    <select class="form-control" name="nationality">
                        <option value="0">Filipino</option>
                    </select>

                    <label>Date Of Birth <small class="required">(required)</small></label>
                    <input type="date" class="form-control" name="dob" value="{{ request('dob') }}">

                    <label>Place Of Birth <small class="required">(required)</small></label>
                    <textarea name="pob" class="form-control" style="resize:vertical;">{{ request('pob') }}</textarea>

                    <label>Mailing Address <small class="required">(required)</small></label>
                    <textarea name="mailing_add" class="form-control" style="resize:vertical;">{{ request('mailing_add') }}</textarea>

                    <label>Town / City <small class="required">(required)</small></label>
                    <input type="text" class="form-control" name="town_city" value="{{ request('town_city') }}">

                    <label>Province</label>
                    <input type="text" class="form-control" name="province" value="{{ request('province') }}">

                    <label>Zip Code</label>
                    <select class="form-control" name="zip_code">
                        {{-- create a loop for increments in zip code --}}
                        <option value="6501">6501</option>
                    </select>

                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="contact" value="{{ request('contact') }}">

                    <label>Email Address</label>
                    <input type="email" class="form-control" name="emailadd" value="{{ request('emailadd') }}" required>
                    <br/>
                </div>

                <span class="clearfix"></span>
            </div>
            <div class="card-block">
                <h3 class="col-sm-offset-1">Guardian Information</h3>
                <hr>
                <div class="col-sm-8 col-sm-offset-1">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" name="father_name" value="{{ request('father_name') }}">
                    <label>Occupation</label>
                    <input type="text" class="form-control" name="father_occupation" value="{{ request('father_occupation') }}">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" name="mother_name" value="{{ request('mother_name') }}">
                    <label>Occupation</label>
                    <input type="text" class="form-control" name="mother_occupation" value="{{ request('mother_occupation') }}">
                    <br/>
                    <span class="clearfix"></span>
                </div>
                <span class="clearfix"></span>
            </div>
            <div class="card-block">
                <h3 class="col-sm-offset-1">User Account Information</h3>
                <hr>
                <div class="col-sm-8 col-sm-offset-1">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ request('username') }}">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" value="{{ request('password') }}">
                    <label>Repeat Password</label>
                    <input type="text" class="form-control" name="repeat_password" value="{{ request('repeat_password') }}">
                    <span class="clearfix"></span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name=course], select[name=major]').select2();
        });
    </script>
@endsection
