{!! csrf_field() !!}

<div class="card-block">
    <h3 class="col-sm-offset-1">Student Information</h3>
    <hr>
    <div class="col-sm-8 col-sm-offset-1">

        @if($errors->has('lastname'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('lastname') }}
            </div>
        @endif

        <label>Lastname <small class="required">(required)</small></label>
        <input type="text" class="form-control" name="lastname"
            value="{{ (old('lastname') == '' AND isset($lastname)) ? $lastname : old('lastname') }}">

        @if($errors->has('firstname'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('firstname') }}
            </div>
        @endif

        <label>Firstname <small class="required">(required)</small></label>
        <input type="text" class="form-control" name="firstname"
            value="{{ (old('firstname') == '' AND isset($firstname)) ? $firstname : old('firstname') }}">

        @if($errors->has('middlename'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('middlename') }}
            </div>
        @endif

        <label>Middlename <small class="required">(required)</small></label>
        <input type="text" class="form-control" name="middlename"
            value="{{ (old('middlename') == '' AND isset($middlename) ? $middlename : old('middlename')) }}">
        <br/>
        <hr>
        <br/>

        @if($errors->has('course'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('course') }}
            </div>
        @endif

        <label>Course</label>
        <select class="form-control" name="course">

            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ ( (isset($course_student) AND $course_student == $course->id) OR (old('course') == $course->id) ) ? 'selected' : '' }} >
                    {{ $course->description }}
                </option>
            @endforeach

        </select>

        <label>Major <small class="optional">(optional)</small></label>
        <select class="form-control" name="major">
            <option value="0">None</option>

            @foreach($majors as $major)
                <option value="{{ $major->id }}"
                    {{ ( (isset($major_student) AND $major_student == $major->id ) OR (old('major') == $major->id) ) ? 'selected' : '' }} >
                    {{ $major->description }}
                </option>
            @endforeach

        </select>

        @if($errors->has('gender'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('gender') }}
            </div>
        @endif

        <label>Gender</label>
        <select class="form-control" name="gender">
            <option value="1"
            {{ ( (isset($gender) AND $gender == 1) OR old('gender') == 1 ) ? 'selected' : '' }}>
                Male
            </option>
            <option value="0"
            {{ ( (isset($gender) AND $gender == 0) OR old('gender') == 0 ) ? 'selected' : '' }} >
                Female
            </option>
        </select>

        @if($errors->has('maritalstatus'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('maritalstatus') }}
            </div>
        @endif

        <label>Marital Status</label>
        <select class="form-control" name="maritalstatus">
            <option value="0"
                {{ ( (isset($maritalstatus) AND $maritalstatus == 0) OR old('maritalstatus') == 0 ) ? 'selected' : '' }} >
                SINGLE
            </option>
            <option value="1"
                {{ ( (isset($maritalstatus) AND $maritalstatus == 1) OR old('maritalstatus') == 1 ) ? 'selected' : '' }} >
                MARRIED
            </option>
            <option value="2"
                {{ ( (isset($maritalstatus) AND $maritalstatus == 2) OR old('maritalstatus') == 2 ) ? 'selected' : '' }} >
                SEPARATED
            </option>
            <option value="3"
                {{ ( (isset($maritalstatus) AND $maritalstatus == 3) OR old('maritalstatus') == 3 ) ? 'selected' : '' }} >
                WIDOWED
            </option>
        </select>

        @if($errors->has('religion'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('religion') }}
            </div>
        @endif

        <label>Religion</label>
        <select class="form-control" name="religion">

            @foreach($religions as $religion)
                <option value="{{ $religion->id }}"
                    {{ ( (isset($religion_student) AND $religion_student == $religion->id) OR old('religion') == $religion->id ) ? 'selected' : '' }} >
                    {{ $religion->description }}
                </option>
            @endforeach

        </select>

        @if($errors->has('nationality'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('nationality') }}
            </div>
        @endif

        <label>Nationality</label>
        <select class="form-control" name="nationality">
            {{-- stick nationality --}}
            <option value="0">Filipino</option>
        </select>

        @if($errors->has('dob'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('dob') }}
            </div>
        @endif

        <label>Date Of Birth <small class="required">(required)</small></label>
        <input type="date" class="form-control" name="dob" value="{{  (old('dob') == '' AND isset($dob)) ? $dob : old('dob') }}">

        @if($errors->has('pob'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('pob') }}
            </div>
        @endif

        <label>Place Of Birth <small class="required">(required)</small></label>
        <textarea name="pob" class="form-control" style="resize:vertical;">{{ (old('pob') == '' AND isset($pob)) ? $dob : old('pob') }}</textarea>

        @if($errors->has('mailing_add'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('mailing_add') }}
            </div>
        @endif

        <label>Mailing Address <small class="required">(required)</small></label>
        <textarea name="mailing_add" class="form-control" style="resize:vertical;">{{ (old('mailing_add') == '' AND isset($mail_add)) ? $mail_add : old('mailing_add') }}</textarea>

        @if($errors->has('town_city'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('town_city') }}
            </div>
        @endif

        <label>Town / City <small class="required">(required)</small></label>
        <input type="text" class="form-control" name="town_city"
            value="{{ (old('town_city') == '' AND isset($town_city)) ? $town_city : old('town_city') }}">

        @if($errors->has('province'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('province') }}
            </div>
        @endif

        <label>Province</label>
        <input type="text" class="form-control" name="province"
            value="{{ (old('province') == '' AND isset($province)) ? $province : old('province') }}">

        @if($errors->has('zip_code'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('zip_code') }}
            </div>
        @endif

        <label>Zip Code</label>
        <select class="form-control" name="zip_code">

            {{-- sticky here --}}

            @for($i = 6500; $i < 6510; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor

        </select>

        @if($errors->has('contact'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('contact') }}
            </div>
        @endif

        <label>Contact Number</label>
        <input type="text" class="form-control" name="contact"
            value="{{ (old('contact') == '' AND isset($contact)) ? $contact : old('contact') }}">

        @if($errors->has('emailadd'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('emailadd') }}
            </div>
        @endif

        <label>Email Address</label>
        <input type="email" class="form-control" name="emailadd"
            value="{{ (old('emailadd') == '' AND isset($emailadd)) ? $emailadd : old('emailadd') }}">
        <br/>
    </div>
    <span class="clearfix"></span>
</div>

{{-- Does the guardian info needs to be updated ? --}}

<div class="card-block">
    <h3 class="col-sm-offset-1">Guardian Information</h3>
    <hr>
    <div class="col-sm-8 col-sm-offset-1">

        @if($errors->has('father_name'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('father_name') }}
            </div>
        @endif

        <label>Father's Name</label>
        <input type="text" class="form-control" name="father_name" value="{{ old('father_name') }}">

        @if($errors->has('father_occupation'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('father_occupation') }}
            </div>
        @endif

        <label>Occupation</label>
        <input type="text" class="form-control" name="father_occupation" value="{{ old('father_occupation') }}">

        @if($errors->has('mother_name'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('mother_name') }}
            </div>
        @endif

        <label>Mother's Name</label>
        <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}">

        @if($errors->has('mother_occupation'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('mother_occupation') }}
            </div>
        @endif

        <label>Occupation</label>
        <input type="text" class="form-control" name="mother_occupation" value="{{ old('mother_occupation') }}">
        <br/>
        <span class="clearfix"></span>
    </div>
    <span class="clearfix"></span>
</div>

<div class="card-block">
    <h3 class="col-sm-offset-1">User Account Information</h3>
    <hr>
    <div class="col-sm-8 col-sm-offset-1">

        @if($errors->has('username'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('username') }}
            </div>
        @endif

        <label>Username</label>
        <input type="text" class="form-control" name="username" value="{{ old('username') }}">

        @if($errors->has('password'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('password') }}
            </div>
        @endif

        <label>Password</label>
        <input type="text" class="form-control" name="password" value="{{ old('password') }}">

        @if($errors->has('repeat_password'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('repeat_password') }}
            </div>
        @endif

        <label>Repeat Password</label>
        <input type="text" class="form-control" name="repeat_password" value="{{ old('repeat_password') }}">
        <span class="clearfix"></span>
    </div>
    <span class="clearfix"></span>
    <input type="submit" class="btn btn-primary btn-raised pull-right" name="name" value="Submit">
</div>
