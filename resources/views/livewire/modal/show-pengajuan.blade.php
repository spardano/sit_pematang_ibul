<div>
   <h1 class="text-3xl font-bold mb-4">Detail Pengajuan Layanan</h1>

   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
    <div class="p-4 rounded-md shadow-md">
      <h2 class="text-lg font-medium mb-4">Informasi Data Pengaju</h2>
      <dl class="grid grid-cols-2 gap-4">
        <dt class="font-thin text-sm">Nama :</dt>
        <dd id="productName" class="font-bold">{{$data_pengajuan->user->penduduk->nama_lengkap}}</dd>
        <dt class="font-thin text-sm">NIK:</dt>
        <dd id="productDescription" class="font-bold">
            {{$data_pengajuan->user->penduduk->nik}}
        </dd>
        <dt class="font-thin text-sm">KK:</dt>
        <dd id="productDescription" class="font-bold">
            {{$data_pengajuan->user->penduduk->nokk}}
        </dd>
        <dt class="font-thin text-sm">Pas Foto:</dt>
        
        <dd id="productImage">
          <div style="width: 100px; height:100px; border:1px solid gray; border-radius:20px;">
            @if ($data_pengajuan->user->penduduk->getFirstMediaUrl('pas-foto'))
              <img style="width: 100%; height:100%; object-fit:cover; border-radius:20px;" id="productImagePlaceholder" src="{{ $data_pengajuan->user->penduduk->getFirstMediaUrl('pas-foto') }}" class="object-cover">
            @endif
          </div>
        </dd>
        
        <dt class="font-thin text-sm">Foto KK:</dt>
        <dd id="productCategory">
          <dd id="productImage">
            <div style="width: 100px; height:100px; border:1px solid gray; border-radius:20px;">
              @if ($data_pengajuan->user->penduduk->getFirstMediaUrl('kk'))
                <img style="width: 100%; height:100%; object-fit:cover; border-radius:20px;" id="productImagePlaceholder" src="{{ $data_pengajuan->user->penduduk->getFirstMediaUrl('kk') }}" class="object-cover">
              @endif
            </div>
          </dd>
        </dd>
        <dt class="font-thin text-sm">Foto KTP:</dt>
        <dd id="productBrand">
          <dd id="productImage">
            <div style="width: 100px; height:100px; border:1px solid gray; border-radius:20px;">
              @if ($data_pengajuan->user->penduduk->getFirstMediaUrl('ktp'))
                <img style="width: 100%; height:100%; object-fit:cover; border-radius:20px;" id="productImagePlaceholder" src="{{ $data_pengajuan->user->penduduk->getFirstMediaUrl('ktp') }}" class="object-cover">
              @endif
            </div>
          </dd>
        </dd>
      </dl>
    </div>
    <div class="p-4 rounded-md shadow-md">
      <h2 class="text-lg font-medium mb-4">Informasi Data Layanan</h2>
      <dl class="grid grid-cols-2 gap-4">
        <dt class="font-thin text-sm">Layanan Yang Diajukan:</dt>
        <dd id="orderId" class="font-bold">
            {{$data_pengajuan->layanan_desa->nama_layanan}}
        </dd>
        <dt class="font-thin text-sm">Tanggal Pengajuan:</dt>
        <dd id="orderDate" class="font-bold">
            {{ Carbon\Carbon::parse($data_pengajuan->created_at)->format('d-m-Y') }}
        </dd>

        @foreach ($data_pengajuan->getFieldData() as $key => $item)
            <dt class="font-thin text-sm">{{$key}}:</dt>
            <dd id="quantity">{{$item}}</dd>
        @endforeach

        {{-- @foreach ($data_pengajuan->getDocument() as $key => $item)
           
        @endforeach --}}

        <dt class="font-thin text-sm">Berkas Syarat:</dt>
        <dd id="quantity" style="border: 1px solid rgb(187, 185, 185); border-radius:10px; padding:5px;">
            <a style="color: rgb(70, 70, 243);" href="{{$data_pengajuan->getDocument()->file}}">{{$data_pengajuan->getDocument()->field_name}}</a>
        </dd>
       
      </dl>
    </div>

</div>
