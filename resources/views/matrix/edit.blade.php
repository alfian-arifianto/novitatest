
<form method="POST" class="form" action="{{ route('matrix.update', $matrix->id) }}">
    <div class="modal-header">
      <h5 class="modal-title" id="matrixModalLabel">Ubah Matrix</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      @csrf
      @method('PUT')
      <div class="form-group mb-2">
          <label for="input-length">Panjang</label>
          <input type="number" class="form-control" id="input-length" placeholder="Masukkan Panjang" 
          name="length" min="1" max="50" value="{{ $matrix->length }}">
      </div>
      <div class="form-group mb-2">
          <label for="input-height">Tinggi</label>
          <input type="number" class="form-control" id="input-height" placeholder="Masukkan Tinggi" 
          name="height" min="1" max="50" value="{{ $matrix->height }}">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>