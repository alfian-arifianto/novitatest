<div class="modal-header">
    <h5 class="modal-title" id="matrixModalLabel">Detail Matrix</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="form-group mb-2">
        <label for="input-length">Panjang</label>
        <input type="text" class="form-control" id="input-length" value="{{ $matrix->length }}" readonly>
    </div>
    <div class="form-group mb-2">
        <label for="input-height">Tinggi</label>
        <input type="text" class="form-control" id="input-height" value="{{ $matrix->height }}" readonly>
    </div>
    <div class="table-responsive mt-5" style="height: 200px; overflow: scroll;">
        <table class="table table-bordered">
            @for($h = 0; $h < $matrix->height; $h++)
                <tr>
                    @for($l = 0; $l < $matrix->length; $l++)
                        <td>{{ rand(1, 50) }}</td>
                    @endfor
                </tr>
                
            @endfor
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>