@extends('layouts.master')
@section('content')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto ">
            <h3 class="text-5xl text-center font-hurricane">PinMe</h3>
        </div>
    </section>
    <section class="max-w-screen-md mx-auto ">
        <div class="flex flex-wrap justify-between flex-container">
            <div class="flex flex-col items-center w-2/6 bg-white rounded-md shadow-md max-[480px]:w-full">
                <img src="/assets/users.png" alt="" class="rounded-full w-36 h-36">
                <input type="file" class="items-center w-48 h-10 mt-4 border rounded-md">
                <button class="w-48 py-1 mt-4 text-white rounded-md bg-biru">Ubah Photo</button>
            </div>
            <div class="w-3/5 max-[480px]:w-full">
                <div class="bg-white rounded-md shadow-md ">
                    <div class="flex flex-col px-4 py-4 ">
                        <h5 class="text-3xl text-center font-hurricane">Your Profile</h5>
                        <h5>Nama Lengkap</h5>
                        <input type="text" class="py-1 rounded-md">
                        <h5>No Telepon</h5>
                        <input type="text" class="py-1 rounded-md">
                        <h5>Jenis Kelamin</h5>
                        <select name="" id="" class="py-1 rounded-md">
                            <option value="">Laki-laki</option>
                            <option value="">Perempuan</option>
                        </select>
                        <h5>Alamat</h5>
                        <textarea type="text" class="py-1 rounded-md">

                    </textarea>
                        <h5>Bio</h5>
                        <textarea type="text" class="py-1 rounded-md">

                    </textarea>
                        <button class="py-2 mt-4 text-white rounded-md bg-biru">Perbaharui</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
