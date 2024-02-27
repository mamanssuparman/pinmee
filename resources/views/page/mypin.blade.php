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
    <section>
        <div class="flex flex-col items-center max-w-screen-md px-2 mx-auto mt-4">
            <div>
                <img src="/assets/users.png" alt="" class="w-24">
            </div>
            <h3 class="text-xl font-semibold" id="namauser">
                OmenSoft
            </h3>
            <small class="text-xs " id="bio">In this link, I present my services as well as all the tools that help me in
                drawing</small>
            <div class="flex flex-row mt-3">
                <a href="" id="link-pengikut">
                    <small class="mr-4 text-abuabu" id="pengikut">1000 Pengikut</small>
                </a>
                <a href="" id="link-mengikuti">
                    <small class="text-abuabu" id="mengikuti">6 Mengikuti</small>
                </a>

            </div>
            <button class="px-4 mt-4 text-white bg-black rounded-full">Pengikut</button>
        </div>
    </section>
    <section class="mt-10">
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap justify-center gap-2" id="data-follower">

            </div>
        </div>
    </section>
@endsection
@push('footerjsexternal')
    <script src="/javascript/mypin.js"></script>
@endpush

