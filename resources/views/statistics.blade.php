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
                        Dashboard
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

                        @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                              @error('osis_candidate_team_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                                   @error('user_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                                                            @If (session('status'))
                               <div class="alert alert-info">{{ session('status') }}</div>
                            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <!--
    protected $fillable = [
        'title',
        'publisher',
        'writer',
        'year',
        'total_pages',
        'isbn',
        'quantity',
        'url_front_cover',
        'url_back_cover',
    ];
                        -->
                        <div style="grid-template-columns: 1fr 1fr 1fr; " class="d-grid gap-5 p-5 align-self-center ">
                           <p>CANDIDATE ONE TOTAL: {{ $voteOne }}</p>
                             <p>CANDIDATE TWO TOTAL: {{ $voteTwo }}</p>
                               <p>CANDIDATE THREE TOTAL: {{ $voteThree }}</p>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span>
                                entries</p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="15 6 9 12 15 18"/>
                                        </svg>
                                        prev
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="9 6 15 12 9 18"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>

                            {{--
                                Built In Paginator Component
                                {!! $modelName->links('tablar::pagination') !!}
                                --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
