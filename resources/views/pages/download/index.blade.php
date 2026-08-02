@extends('layouts.full')
@section('title', __('Downloads'))

@section('content')
    <section class="card">
        <div class="card-body">
            <h2 class="mt-0">{{ __('Downloads') }}</h2>
            <div class="row">
                @forelse($data as $row)
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-body d-flex flex-row align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if ($row->image)
                                        <img class="d-block mx-auto me-2" src="{{ $row->image }}" alt="" width="60">
                                    @endif
                                    <div>
                                        <h4 class="mb-0">{{ $row->name }}</h4>
                                        <p class="mb-0">{{ $row->desc }}</p>
                                    </div>
                                </div>
                                <a href="{{ $row->url }}" target="_blank" class="btn btn-primary">{{ __('Download') }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger text-center" role="alert">
                            {{ __('No Downloads Available!') }}
                        </div>
                    </div>
                @endforelse
            </div>

            <h2 class="mt-5">{{ __('System Requirements') }}</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Minimum Requirements') }}</th>
                                <th>{{ __('Recommended Requirements') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ __('CPU') }}</td>
                                <td>{{ __('Pentium 3 800MHz or higher') }}</td>
                                <td>{{ __('Intel i3 or higher') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('RAM') }}</td>
                                <td>{{ __('2GB') }}</td>
                                <td>{{ __('4GB') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('VGA') }}</td>
                                <td>{{ __('3D speed over GeForce2 or ATI 9000') }}</td>
                                <td>{{ __('3D speed over GeForce FX 5600 or ATI9500') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('SOUND') }}</td>
                                <td>{{ __('DirectX 9.0c Compatibility card') }}</td>
                                <td>{{ __('DirectX 9.0c Compatibility card') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('HDD') }}</td>
                                <td>{{ __('5GB or higher(including swap and temporary file)') }}</td>
                                <td>{{ __('8GB or higher(including swap and temporary file)') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('OS') }}</td>
                                <td>{{ __('Windows 7') }}</td>
                                <td>{{ __('Windows 10') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
