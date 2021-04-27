@extends('crud.modal')
@section('input-form')
    <div class="form-group">
        <div class="form-line">
            <label for="name">Nama Pengguna</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Password</label>
            <input type="text" name="password" class="form-control" minlength="8" required>
        </div>
    </div>

    {{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="name" class="form-control">
    </div>
</div> --}}

    {{-- <div class="form-group">
   <label for="type">Pilih Salah Satu</label>
   <select class="form-control show-tick" name="type_id" id="typeID" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
      @foreach ($type as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
      @endforeach
   </select>
</div> --}}

@endsection
