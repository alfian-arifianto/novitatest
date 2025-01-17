$('.create-matrix').on('click', function() {
    matrixClick('/matrix/create');
});
$('.update-matrix').on('click', function() {
    let url = $(this).data('url');
    matrixClick(url);
});
$('.detail-matrix').on('click', function() {
    let url = $(this).data('url');
    matrixClick(url);
});
function matrixClick(url) {
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
$('.delete-matrix').on('click', function (e) {
    // e.preventDefault();
    var url = $(this).data('url');
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
});
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