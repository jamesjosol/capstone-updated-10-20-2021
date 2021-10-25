<div class="mb-5">
    <div class="row">
        <div class="col-md-5">
            <div class="profile-card">
                <div class="row">
                    <div class="col-md-7">
                        <div class="profile">
                            @if(isset($student))
                            <img src="{{asset("images/" . $student->user->profile_pic)}}" id="upload-img">
                            @else 
                            <img src="{{asset('img/pp.png')}}" id="upload-img">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 mt-5">
                        <div class="upload-file">
                            <label for="fileupload">
                                <span class="links-name text-white"><i class="fad fa-camera" style="font-size: 0.95em"></i>{{isset($student) ? 'Change' : 'Upload'}} Photo</span>
                            </label>
                            {{-- <input type="file" id="fileupload"> --}}
                            {!! Form::file('profile_pic', ['id'=>'fileupload', 'accept' => "image/*"]) !!}
                        </div>
                    </div>
                </div> 
                
            </div>
        </div>
    </div>
</div>
<div class="mb-1">
    @if (Request::is('admin/students/create') || Request::is('admin/students/edit/'))
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="col form-group @error('user_id') has-error @enderror">
                <label for="user_id" class="form-label">User:</label>
                {{Form::select('user_id', \App\Models\User::usersNotStudent(), null, ['class'=>'form-control form-select', 'id'=>'user_id', 'required' => '', 'placeholder'=>'Select User'])}}
                <span class="errspan" id="errspan">{{ $errors->first('user_id') }}</span>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="col form-group @error('firstName') has-error @enderror">
                <label for="firstName" class="form-label">First Name:</label>
                {!! Form::text('firstName', Request::is('admin/students/create') || isset($student) ? null : auth()->user()->firstName, ['class'=>'form-control', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('firstName') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('lastName') has-error @enderror">
                <label for="lastName" class="form-label">Last Name:</label>
                {!! Form::text('lastName', Request::is('admin/students/create') || isset($student) ? null : auth()->user()->lastName, ['class'=>'form-control', 'required' => '', 'id'=>'modal-input-lname']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('lastName') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('middleName') has-error @enderror">
                <label for="middleName" class="form-label">Middle Name:</label>
                {!! Form::text('middleName', Request::is('admin/students/create') || isset($student) ? null : auth()->user()->middleName, ['class'=>'form-control', 'required' => '', 'id'=>'modal-input-mname']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('middleName') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="mb-1">
    <div class="row">
        <div class="col-md-2 @error('gender') has-error @enderror">
            {!! Form::label('gender','Gender:',[],false) !!}
            {{Form::select('gender', [
                'Male'   => 'Male',
                'Female' => 'Female',
            ], null, ['class'=>'form-control form-select', 'id'=>'gender'])}}
        </div>
        <div class="col-md-3">
            <div class="col form-group @error('birthDate') has-error @enderror">
                <label for="birthDate" class="form-label">Birth Date:</label>
                {!! Form::date('birthDate', null, ['class'=>'form-control', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('birthDate') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col form-group @error('birthPlace') has-error @enderror">
                <label for="birthPlace" class="form-label">Birth Place:</label>
                {!! Form::text('birthPlace', null, ['class'=>'form-control', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('birthPlace') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="mb-1">
    <div class="row">
        <label for="address" class="form-label">Address:</label>
        <div class="col-md-4">
            <div class="col form-group @error('barangay') has-error @enderror">
                {!! Form::text('barangay', null, ['class'=>'form-control', 'placeholder'=>'Barangay', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('barangay') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('town') has-error @enderror">
                {!! Form::text('town', null, ['class'=>'form-control', 'placeholder'=>'Town', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('town') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('province') has-error @enderror">
                {!! Form::text('province', null, ['class'=>'form-control', 'placeholder'=>'Province', 'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('province') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="mb-1">
    <div class="row">
        <div class="col-md-4">
            <div class="col form-group @error('civilStatus') has-error @enderror">
                <label for="civilStatus" class="form-label">Civil Status:</label>
                {{Form::select('civilStatus', [
                'Single'   => 'Single',
                'Married' => 'Married',
                'Widow' => 'Widow',
                'Widower' => 'Widower',
            ], null, ['class'=>'form-control form-select', 'id'=>'civilStatus', 'required' => '', 'placeholder'=>'Select Civil Status'])}}
                <span class="errspan" id="errspan">{{ $errors->first('civilStatus') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('nationality') has-error @enderror">
                <label for="nationality" class="form-label">Nationality:</label>
                {!! Form::text('nationality', null, ['class'=>'form-control',  'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('nationality') }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col form-group @error('religion') has-error @enderror">
                <label for="religion" class="form-label">Religion:</label>
                {!! Form::text('religion', null, ['class'=>'form-control',  'required' => '']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('religion') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="mb-1">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col form-group @error('fatherName') has-error @enderror">
                    <label for="fatherName" class="form-label">Father:</label><br>
                    {!! Form::text('fatherName', null, ['class'=>'form-control', 'placeholder'=>'Father Name', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('fatherName') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group @error('fatherOccup') has-error @enderror">
                    {!! Form::text('fatherOccup', null, ['class'=>'form-control', 'placeholder'=>'Father Occupation', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('fatherOccup') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group @error('fatherContact') has-error @enderror">
                    {!! Form::text('fatherContact', null, ['class'=>'form-control', 'placeholder'=>'Father Contact', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('fatherContact') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col form-group @error('motherName') has-error @enderror">
                    <label for="motherName" class="form-label">Mother:</label><br>
                    {!! Form::text('motherName', null, ['class'=>'form-control', 'placeholder'=>'Mother Name', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('motherName') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group @error('motherOccup') has-error @enderror">
                    {!! Form::text('motherOccup', null, ['class'=>'form-control', 'placeholder'=>'Mother Occupation', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('motherOccup') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group @error('motherContact') has-error @enderror">
                    {!! Form::text('motherContact', null, ['class'=>'form-control', 'placeholder'=>'Mother Contact', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('motherContact') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-1">
    <div class="row">
        <label for="guardianName" class="form-label">Guardian:</label>
        <div class="col-md-5">
            <div class="col form-group @error('guardianName') has-error @enderror">
                {!! Form::text('guardianName', null, ['class'=>'form-control', 'placeholder'=>'Guardian Name']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('guardianName') }}</span>
            </div>
        </div>
        <div class="col-md-5">
            <div class="col form-group @error('guardianContact') has-error @enderror">
                {!! Form::text('guardianContact', null, ['class'=>'form-control', 'placeholder'=>'Guardian Contact']) !!}
                <span class="errspan" id="errspan">{{ $errors->first('guardianContact') }}</span>
            </div>
        </div>
        
    </div>
</div>


<div class="mb-1">
    <div class="row">
        <div class="col-md-2 @error('grade_LVL') has-error @enderror">
            {!! Form::label('grade_LVL','Grade Level',[],false) !!}
            {{Form::select('grade_LVL', [
                7 => 'Grade 7',
                8 => 'Grade 8',
                9 => 'Grade 9',
                10 => 'Grade 10',
                11 => 'Grade 11',
                12 => 'Grade 12',
            ], null, ['class'=>'form-control form-select', 'id'=>'grade_LVL'])}}
        </div>
        
    </div>
</div>

<div class="mt-5">
    <div class="row">
        <label for="elementary" class="form-label">Elementary:</label><br>
        <div class="col-md-12">
            <div class="row">
                <div class="col form-group @error('elemSchool') has-error @enderror">
                    {!! Form::text('elemSchool', null, ['class'=>'form-control', 'placeholder'=>'Elementary School', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('elemSchool') }}</span>
                </div>  
            </div>
            <div class="row">
                <div class="col form-group @error('elemSchlAddr') has-error @enderror">
                    {!! Form::text('elemSchlAddr', null, ['class'=>'form-control', 'placeholder'=>'Elementary School Address', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('elemSchlAddr') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group @error('elemYrAttnd') has-error @enderror">
                    {!! Form::text('elemYrAttnd', null, ['class'=>'form-control', 'placeholder'=>'Elementary Year Attend', 'required' => '']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('elemYrAttnd') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <div class="row">
        <label for="secondary" class="form-label">Secondary:</label><br>
        <div class="col-md-12">
            <div class="row">
                <div class="col form-group @error('secondarySchool') has-error @enderror">
                    {!! Form::text('secondarySchool', null, ['class'=>'form-control', 'placeholder'=>'Secondary School']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('secondarySchool') }}</span>
                </div>  
            </div>
            <div class="row">
                <div class="col form-group @error('secondarySchlAddr') has-error @enderror">
                    {!! Form::text('secondarySchlAddr', null, ['class'=>'form-control', 'placeholder'=>'Secondary School Address']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('secondarySchlAddr') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col form-group mb-5 @error('secondaryYrAttnd') has-error @enderror">
                    {!! Form::text('secondaryYrAttnd', null, ['class'=>'form-control', 'placeholder'=>'Secondary Year Attend']) !!}
                    <span class="errspan" id="errspan">{{ $errors->first('secondaryYrAttnd') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary mb-5" id="submitBtn">Submit</button>