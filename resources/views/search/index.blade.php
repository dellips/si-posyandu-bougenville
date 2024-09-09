<x-layout>
  <x-slot:title>Hasil Pencarian</x-slot:title>

  <section class="m-1 p-8 rounded-md bg-white">
    <h1 class="font-semibold text-lg uppercase text-purple-800">Hasil Pencarian</h1>
    @if($results->isEmpty())
      <div class="m-1 p-2 divide-y">
        <p>Tidak ada hasil yang ditemukan.</p>
      </div>
    @else
      <div class="m-1 p-2 rounded-md">
        <ul>
        @foreach($results as $result)
          <li>
            <div class="m-1 p-2 border-x-2 my-4 rounded-md hover:shadow-md hover:font-semibold">
              <a href="{{ strtolower(class_basename($result)) }}\{{ $result->id }}">
                {{ $result->nama ?? '' }}  
              </a>
              @if(isset($result->nik))
                <p class="ml-4 text-sm font-light">{{ $result->nik }}</p>
                <p class="ml-4 text-sm font-light">{{ $result->alamat }} RT {{ $result->rt }} RW {{ $result->rw }}</p>
              @endif
            </div>
          </li>
        @endforeach
        </ul>
      </div>
    @endif
  </section>
</x-layout>
