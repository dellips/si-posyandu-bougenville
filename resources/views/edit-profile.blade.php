<x-layout>
    <x-slot:title>Profile</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-purple-800">Ubah Profile</p>

        <!-- alert error -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
            <strong class="font-bold">Terdapat kesalahan!</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- form -->
        <form action="{{ route('profile.update', $user->id) }}" method="POST" class="m-1 p-4">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nik" class="block text-gray-700 font-semibold mb-2">NIK</label>
                <input type="text" id="nik" value="{{ isset($user) ? $user->nik : old('nik') }}" name="nik" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" value="{{ isset($user) ? $user->nama : old('nama') }}" name="nama" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="tgl_lahir" class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ isset($user) ? $user->tgl_lahir : old('tgl_lahir') }}" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="alamat" class="block text-gray-800 font-semibold mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ isset($user) ? $user->alamat : old('alamat') }}" placeholder="Masukkan Alamat" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rt" class="block text-gray-800 font-semibold mb-2">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ isset($user) ? $user->rt : old('rt') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rw" class="block text-gray-800 font-semibold mb-2">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ isset($user) ? $user->rw : old('rw') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="no_telp" class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ isset($user) ? $user->no_telp : old('no_telp') }}" placeholder="Masukkan Nomor Telepon" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                <input type="text" id="username" value="{{ isset($user) ? $user->username : old('username') }}" name="username" placeholder="Masukkan Username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" value="{{ isset($user) ? $user->password : old('password') }}" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                <p class="pl-2 font-thin text-sm">* Password harus memiliki minimal 8 karakter</p>
                <p class="pl-2 font-thin text-sm">* Password harus mengandung huruf besar dan kecil</p>
                <p class="pl-2 font-thin text-sm">* Password harus mengandung setidaknya satu huruf, angka, dan simbol</p>
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600">{{ isset($user) ? 'Update' : 'Submit' }}</button>
            </div>
        </form>
    </section>
</x-layout>