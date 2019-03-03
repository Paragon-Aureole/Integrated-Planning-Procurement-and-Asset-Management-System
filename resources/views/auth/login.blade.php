@extends('layouts.app')
@section('login')
{{--
    username,
    password,
    remember,
    <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
--}}
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row justify-content-center align-items-center">
                        <img src="{{asset('img/sfclogo.png')}}" class="w-25 h-25">
                        <h5 class="card-title text-center">
                            Integrated Procurement and Assets Management System
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" placeholder="Username" name="username"
                              class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                              value="{{old('username')}}" required autofocus>
                              <div class="invalid-feedback">  
                                @if ($errors->has('username'))
                                    {{$errors->first('username')}}
                                @else
                                    Username is required.
                                @endif  
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                              </div>
                              <input type="password" placeholder="Password" name="password" 
                              class="form-control input_pass {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               required autofocus>
                               <div class="invalid-feedback">  
                                  @if ($errors->has('password'))
                                    {{$errors->first('password')}}
                                  @else
                                    Password is required.
                                  @endif  
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" id="customControlInline" name="remember"
                              {{ old('remember') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        --}}
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" name="button" class="btn btn-primary login_btn w-100">Login</button>
                        </div>
                        {{--
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>
                        --}}
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection


