@extends('layouts.master')
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-hurricane">PinMe</h3>
        </div>
    </section>
    <section class="max-w-[500px] mx-auto ">
        <div class="max-[480px]:w-full">
            <div class="bg-white rounded-md shadow-md ">
                <div class="flex flex-col px-4 py-4 ">
                    <h5 class="text-3xl text-center font-hurricane">Change Your Password</h5>
                    <h5>Old Password</h5>
                    <input type="password" class="py-1 rounded-md">
                    <h5>New Password</h5>
                    <input type="password" class="py-1 rounded-md">
                    <h5>Confirm Password</h5>
                    <input type="password" class="py-1 rounded-md">
                    <button class="py-2 mt-4 text-white rounded-md bg-biru">Perbaharui</button>
                </div>
            </div>
        </div>
    </section>
@endsection
