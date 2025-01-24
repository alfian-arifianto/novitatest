/**
 * Page Shift List
 */

'use strict';
// Datatable (jquery)
$(function () {
    // let modalEmpty = `<div class="modal-header">
    // <h5 class="modal-title" id="matrixModalLabel">Tambah Matrix</h5>
    // <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    // </div>
    // <div class="modal-body">
    // </div>
    // <div class="modal-footer">
    // <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    // </div>`;
    var orderTable = 0;
    $('#matrix-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { 
            url: "/api/matrix/data",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.page = d.start / d.length + 1;
            }
        },
        columns: [
            { data: 'id' },
            { data: 'length' },
            { data: 'height' },
            { data: 'action' }
        ],
        language: {
            paginate: {
                previous: "Prev",
                next: "Next"
            }
        },
        columnDefs: [
            {
                searchable: true,
                orderable: true,
                targets: 0,
                render: function (data, type, full, meta) {
                    // let id = full['id'];
                    return '<div style="width: 10px;">'+meta.row + 1 + meta.settings._iDisplayStart+'</div>'; // Hitung nomor urut
                }
            },
            {
                targets: -1,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    var id = full['id'];
                    return `<div style="width: 200px;">` +
                        `<button class="btn btn-success btn-sm detail-matrix" style="margin-right: 5px;" onclick="matrixClick('/matrix/show/`+id+`')" data-bs-toggle="modal" data-bs-target="#matrixModal">` +
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">` +
                            `<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>` +
                            `<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>` +
                        `</svg>` +
                        `</button>` +
                        `<button class="btn btn-warning text-white btn-sm update-matrix" style="margin-right: 5px;" onclick="matrixClick('/matrix/edit/`+id+`')" data-bs-toggle="modal" data-bs-target="#matrixModal">` +
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">` +
                            `<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>` +
                        `</svg>` +
                        `</button>` +
                        `<button class="btn btn-danger btn-sm delete-matrix" style="margin-right: 5px;" onclick="matrixDelete('/api/matrix/`+id+`')">` +
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">` +
                            `<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>` +
                        `</svg>` +
                        `</button>` +
                    `</div>`;
                }
            }
        ],
        order: [[0, 'asc']],
    });
});

function matrixClick(url) {
    $('.matrix-modal').html(modalEmpty);
    $.ajax({
        url: url,
        method: 'GET',
        success: function(data) {
            $('.matrix-modal').html(data);
        },
        error: function(xhr, status, error) {
            $('.matrix-modal').html(modalEmpty);
        }
    });
}
function matrixDelete(url) {
Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
        method: "POST",
        url: url,
        data: {
            '_method': 'DELETE',
            '_token': '{{ csrf_token() }}',
        },
        success: function (data) {
            Swal.fire({
            title: "Deleted!",
            text: data.message,
            allowOutsideClick: false,
            icon: "success"
            }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); 
            }
            });
        }         
        });
    }
});
}

function saveMatrixCreate() {
    let inputLength = $('#input-length').val();
    let inputHeight = $('#input-height').val();
    if((inputLength < 1 || inputLength > 50) || (inputHeight < 1 || inputHeight > 50)) {
    swalWarning('Panjang atau Tinggi lebih dari 50 dan kurang dari 1');
    return;
    }
    $.ajax({
    method: "POST",
    url: '/api/matrix',
    data: {
        'length': inputLength,
        'height': inputHeight,
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ambil token CSRF
    },
    success: function(data, textStatus, jqXHR){
        Swal.fire({
        title: "Success",
        text: data.message,
        allowOutsideClick: false,
        icon: "success"
        }).then((result) => {
        if (result.isConfirmed) {
            location.reload(); 
        }
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {
        swalError(jqXHR.responseJSON.message);
    }
    });
}
function saveMatrixUpdate(url) {
    let inputLength = $('#input-length').val();
    let inputHeight = $('#input-height').val();
    if((inputLength < 1 || inputLength > 50) || (inputHeight < 1 || inputHeight > 50)) {
    swalWarning('Panjang atau Tinggi lebih dari 50 dan kurang dari 1');
    return;
    }
    $.ajax({
    method: "POST",
    url: url,
    data: {
        '_token': '{{ csrf_token() }}',
        '_method': 'PUT',
        'length': inputLength,
        'height': inputHeight,
    },
    success: function(data, textStatus, jqXHR){
        Swal.fire({
        title: "Success",
        text: data.message,
        allowOutsideClick: false,
        icon: "success"
        }).then((result) => {
        if (result.isConfirmed) {
            location.reload(); 
        }
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {
        swalError(jqXHR.responseJSON.message);
    }
    });
}