@extends('crud.modal')
@section('input-form')
    <div class="form-group">
        <div class="form-line">
            <label for="name">Pertanyaan</label>
            <Textarea class="form-control" name="question" required></Textarea>
        </div>
        <div class="form-line mt-2">
            <label for="name">Pilihan 1</label>
            <input type="text" name="option1" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Pilihan 2</label>
            <input type="text" name="option2" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Pilihan 3</label>
            <input type="text" name="option3" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Pilihan 4</label>
            <input type="text" name="option4" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Pilihan 5</label>
            <input type="text" name="option5" class="form-control" required>
        </div>
        <div class="form-line mt-2">
            <label for="name">Jawaban</label>
            <select class="form-control show-tick" name="answer" id="answer" required>
                <option disabled selected value>---- Pilih Salah Satu ----</option>
                <option value="1">Pilihan 1</option>
                <option value="2">Pilihan 2</option>
                <option value="3">Pilihan 3</option>
                <option value="4">Pilihan 4</option>
                <option value="5">Pilihan 5</option>

            </select>
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
