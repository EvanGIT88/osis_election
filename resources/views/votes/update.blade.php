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
            <form class="card card-md" action="{{ url('/votes/update/'.$vote->id) }}" method="post" autocomplete="off" >
            @csrf
               @method("PUT")
                              <!--
                        protected $fillable = [
                            'user_id',
                            'osis_candidate_team_id',
                            'role'
                        ];
                    -->
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">User id</label>
                    <!--
                    Source - https://stackoverflow.com/a/19779010
                    Posted by edigu, modified by community. See post 'Timeline' for change history
                    Retrieved 2026-02-09, License - CC BY-SA 3.0
                    -->
                    <input type="search" list="users_id" name="user_id"  class="form-control @error('user_id') is-invalid @enderror" placeholder="Enter user name" value={{ $vote->user_id ? $vote->user_id : old('user_id') }}>
                    <datalist id="users_id">
                       @foreach ($users as $user )
                            <option value={{ $user->id }}>{{ $user->name }}</option>
                       @endforeach
                    </datalist>
                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Candidate Team's id</label>
                    <input type="search" list="teams_id" name="osis_candidate_team_id"  class="form-control @error('osis_candidate_team_id') is-invalid @enderror" placeholder="Enter team id" value={{ $vote->osis_candidate_team_id ? $vote->osis_candidate_team_id : old('osis_candidate_team_id') }}>
                    <datalist id="teams_id">
                       @foreach ($teams as $team )
                            <option value={{ $team->id }}>{{ $team->id }}</option>
                       @endforeach
                    </datalist>
                    @error('osis_candidate_team_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Create new account</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
