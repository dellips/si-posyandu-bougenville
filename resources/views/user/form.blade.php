<x-layout>
    <x-slot:title>Akun Pengguna</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/user" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <p class="font-semibold text-lg uppercase text-violet-600">Form {{ isset($user) ? 'Ubah' : 'Tambah' }} Akun</p>
        </div>
        
        <!-- alert error -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border border-red-600 text-red-700 px-4 py-3 rounded" role="alert">
            <strong class="font-bold">Terdapat kesalahan!</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- garis -->
        <div class="divider"></div>

        <!-- form -->
        <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST" class="m-1 p-4 text-stone-800">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif
            <div class="mb-4 ">
                <label for="nik" class="block font-semibold mb-2">NIK</label>
                <input type="text" id="nik" value="{{ isset($user) ? $user->nik : old('nik') }}" name="nik" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4 ">
                <label for="nama" class="block font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" value="{{ isset($user) ? $user->nama : old('nama') }}" name="nama" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4">
                <label for="jk" class="block font-semibold mb-2">Jenis Kelamin</label>
                <select id="jk" name="jk" class="w-1/3 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                    <option value="" disabled {{ old('jk', isset($user)) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" {{ old('jk', isset($user) && $user->jk) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jk', isset($user) && $user->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tgl_lahir" class="block font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ isset($user) ? $user->tgl_lahir : old('tgl_lahir') }}" class="w-1/4 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500 text-gray-700">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="alamat" class="block font-semibold mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ isset($user) ? $user->alamat : old('alamat') }}" placeholder="Masukkan Alamat" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rt" class="block font-semibold mb-2">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ isset($user) ? $user->rt : old('rt') }}" placeholder="00" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rw" class="block font-semibold mb-2">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ isset($user) ? $user->rw : old('rw') }}" placeholder="00" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="no_telp" class="block font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ isset($user) ? $user->no_telp : old('no_telp') }}" placeholder="Masukkan Nomor Telepon" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="posisi" class="block font-semibold mb-2">Posisi</label>
                <select id="posisi" name="posisi" class="w-1/3 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                    <option value="" disabled {{ old('posisi', isset($user)) ? '' : 'selected' }}>Pilih Posisi</option>
                    <option value="Ketua" {{ old('posisi', isset($user) && $user->posisi) == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                    <option value="Wakil Ketua" {{ old('posisi', isset($user) && $user->posisi) == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                    <option value="Sekertaris" {{ old('posisi', isset($user) && $user->posisi) == 'Sekertaris' ? 'selected' : '' }}>Sekertaris</option>
                    <option value="Bendahara" {{ old('posisi', isset($user) && $user->posisi) == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="Anggota" {{ old('posisi', isset($user) && $user->posisi) == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                    <option value="Admin" {{ old('posisi', isset($user) && $user->posisi) == 'Admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="mb-4">
                <div class="form-control flex flex-row items-center">
                    <input type="checkbox" name="is_admin" value="1" class="checkbox checkbox-primary" {{ old('is_admin', isset($user) && $user->is_admin ? 'checked' : '') }}>
                    <label class="ml-2 label cursor-pointer">
                        <span class="label-text font-semibold">Admin</span>
                    </label>
                </div>
            </div>                           
            <div class="mb-4">
                <label for="username" class="block font-semibold mb-2">Username</label>
                <input type="text" id="username" value="{{ isset($user) ? $user->username : old('username') }}" name="username" placeholder="Masukkan Username" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block font-semibold mb-2">Password</label>
                <input type="password" id="password" value="{{ isset($user) ? $user->password : old('password') }}" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                <p class="pl-2 font-thin text-sm">* Password harus memiliki minimal 8 karakter</p>
                <p class="pl-2 font-thin text-sm">* Password harus mengandung huruf besar dan kecil</p>
                <p class="pl-2 font-thin text-sm">* Password harus mengandung setidaknya satu huruf, angka, dan simbol</p>
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                    <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                        <path stroke="none" d="M0 0h24v24H0z"/>  
                        <path d="M5 12l5 5l10 -10" /></svg>
                    <span>{{ isset($user) ? 'Ubah' : 'Simpan' }}</span>
                </button>
            </div>
        </form>
    </section>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      var successAlert = document.getElementById('success-alert');
          
      if (successAlert) {
        successAlert.classList.remove('hidden'); 
              
        setTimeout(function () {
          successAlert.style.transition = "opacity 0.5s ease-out"; 
          successAlert.style.opacity = "0"; 
          setTimeout(function() {
            successAlert.remove(); 
          }, 500); 
        }, 5000); 
      }
    });

    function toggleAdminCheckbox() {
        const posisi = document.getElementById('posisi').value;
        const adminCheckbox = document.getElementById('adminCheckbox');
        
        if (posisi === 'Admin') {
            adminCheckbox.style.display = 'block';
        } else {
            adminCheckbox.style.display = 'none';
            document.getElementById('isAdminCheckbox').checked = false;
        }
    }

    // Jalankan saat halaman dimuat untuk memastikan kondisi yang benar jika ada data lama
    document.addEventListener('DOMContentLoaded', function () {
        toggleAdminCheckbox();
    });
  </script>