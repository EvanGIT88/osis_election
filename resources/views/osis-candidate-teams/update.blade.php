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
            <form class="card card-md" action="{{ url('/osis-candidate-teams/update/'.$osisCandidateTeam->id) }}" method="post" autocomplete="off" >
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
                    <label class="form-label">Vision</label>
                    <!--
                    Source - https://stackoverflow.com/a/19779010
                    Posted by edigu, modified by community. See post 'Timeline' for change history
                    Retrieved 2026-02-09, License - CC BY-SA 3.0
                    -->
                    <input type="text" id="vision" name="vision" class="form-control @error('vision') is-invalid @enderror" placeholder="Enter vision" value="{{ $osisCandidateTeam->vision ? $osisCandidateTeam->vision : old('vision') }}">
                    @error('vision')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    <div class="mb-3">
                        <!-- select error only showed if there's form-control #error('pair') idk why, this solution from copilot -->
                    <label class="form-label">Osis Pair</label>
                        <select name="pair" id="pair" class="form-select form-control @error('pair') is-invalid @enderror">
                      @foreach ($pairs as $key => $value )
                           @if ( $value == $osisCandidateTeam->pair ? : old("pair")) 
                            <option value={{ $value }} selected>{{ $value }}</option>
                           @else
                            <option value={{ $value }}>{{ $value }}</option>
                           @endif
                        @endforeach
                        </select>
                        @error('pair')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                             <div class="mb-3"> 
                    <label class="form-label">Mission</label>
                    <!--
                    Source - https://stackoverflow.com/a/19779010
                    Posted by edigu, modified by community. See post 'Timeline' for change history
                    Retrieved 2026-02-09, License - CC BY-SA 3.0
                    -->
                    <input type="text" name="mission" class="form-control @error('mission') is-invalid @enderror" placeholder="Enter mission" value="{{ $osisCandidateTeam->mission ? $osisCandidateTeam->mission : old('mission') }}">
                    @error('mission')
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
