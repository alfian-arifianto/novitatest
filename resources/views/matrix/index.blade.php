@extends('matrix.app')
@section('content')
<div class="d-flex justify-content-between">
  <h2>Data Matrix</h2>
  <div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary create-matrix" data-bs-toggle="modal" data-bs-target="#matrixModal">
      Create
    </button>
  </div>
</div>
<div class="table-responsive mt-4">
  <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th class="bg-secondary text-white">No</th>
        <th class="bg-secondary text-white">Panjang</th>
        <th class="bg-secondary text-white">Tinggi</th>
        <th class="bg-secondary text-white">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($matrices as $_matrix => $matrix)
        <tr>
          <td style="width: 50px;">{{ $_matrix+1 }}</td>
          <td style="width: 40%;">{{ $matrix->length }}</td>
          <td style="width: 40%;">{{ $matrix->height }}</td>
          <td>
            <div style="width: 200px;">
              <button class="btn btn-success btn-sm detail-matrix" data-url="{{ route('matrix.show', $matrix->id) }}" data-bs-toggle="modal" data-bs-target="#matrixModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
              </button>
              <button class="btn btn-warning text-white btn-sm update-matrix" data-url="{{ route('matrix.edit', $matrix->id) }}" data-bs-toggle="modal" data-bs-target="#matrixModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                </svg>
              </button>
              <button class="btn btn-danger btn-sm delete-matrix" data-url="{{ route('api.matrix.destroy', $matrix->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
              </button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="matrixModal" tabindex="-1" aria-labelledby="matrixModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content matrix-modal">
    </div>
  </div>
</div>

@endsection
@push('script')
<script src="{{ asset('assets/pages/matrix/indexMatrix.js') }}"></script>
@endpush