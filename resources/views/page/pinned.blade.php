@extends('layouts.master')
@push('cssjsexternal')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
@endpush
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-hurricane">PinMe</h3>
        </div>
    </section>
    <section class="mt-10">
        <div class="max-w-screen-md mx-auto">
            @csrf
            <div class="flex flex-wrap items-center flex-container" id="pinnedfoto">

            </div>
        </div>
    </section>
@endsection
@push('footerjsexternal')
    <script src="/javascript/pinned.js"></script>
@endpush
