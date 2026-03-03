@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Create
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="/users/index" class="btn btn-white">
                      Back
                    </a>
                  </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
                                    @If (session('status'))
                               <div class="alert alert-info">{{ session('status') }}</div>
                            @endif
        <div class="container-xl">
            <form class="card card-md" action="/users/create" method="post" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Full name</label>
                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Enter name" value="{{ old('full_name') }}">
                    @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="number" name="nis" class="form-control @error('nis') is-invalid @enderror" placeholder="Enter email" value="{{ old('nis') }}">
                    @error('nis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                        <select name="role" id="role" class="form-select">
                        @foreach ($roleEnum as $key => $value )
                           @if ($value == old("role")) 
                            <option value={{ $key }} selected>{{ $value }}</option>
                           @else
                            <option value={{ $key }}>{{ $value }}</option>
                           @endif
                        @endforeach
                        </select>
                    @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Major</label>
                        <select name="major" id="major" class="form-select">
                        @foreach ($majorEnum as $key => $value )
                           @if ($value == old("major")) 
                            <option value={{ $key }} selected>{{ $value }}</option>
                           @else
                            <option value={{ $key }}>{{ $value }}</option>
                           @endif
                        @endforeach
                        </select>
                    @error('major')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                                <div class="mb-3">
                    <label class="form-label">Class</label>
                        <select name="class" id="class" class="form-select">
                        @foreach ($classEnum as $key => $value )
                           @if ($value == old("class")) 
                            <option value={{ $key }} selected>{{ $value }}</option>
                           @else
                            <option value={{ $key }}>{{ $value }}</option>
                           @endif
                        @endforeach
                        </select>
                    @error('class')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <!-- old() deleted because the previous update's password can get unhashed/still in old() history -->
                          <!-- CAUTION HTML PASSWORD INPUT CAN REMEMBER USER'S UNHASHED PASSWORD-->
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                               autocomplete="off">
                        <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12"
                                                                                                            cy="12"
                                                                                                            r="2"/><path
                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/></svg>
                  </a>
                </span>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group input-group-flat">
                                                <!-- old() deleted because the previous update's password conf can get unhashed/still in old() history -->
                            <!-- CAUTION HTML PASSWORD INPUT CAN REMEMBER USER'S UNHASHED PASSWORD-->
                                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password">
                        <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12"
                                                                                                            cy="12"
                                                                                                            r="2"/><path
                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/></svg>
                  </a>
                </span>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Create new account</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
