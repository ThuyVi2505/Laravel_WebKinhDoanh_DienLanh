<script type="text/javascript">
    // Start page
        $(document).ready(function() {
            // e.preventDefault();
            start();
            // set up csrf-token ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        function start(){
            //  delete item
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let deleteId = $(this).data('id');
                let name = $(this).data('name');
                if (confirm('Bạn có chắc muốn xóa sản phẩm ' + name + ' không?')) {
                    $.ajax({
                        url: "{{ route('product.delete') }}",
                        method: 'POST',
                        data: {
                            id: deleteId
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                $.get(location.href, function(data) {
                                    var tableContent = $(data).find('#div-table').html();
                                    $('#div-table').html(tableContent);
                                });
                                toastr.success('Đã xóa sản phẩm ' + name, 'Thành công!!!');
                            }
                        }
                    });
                }
            });
            //  change status
            $(document).on('click', '.change-status', function(e) {
                e.preventDefault();
                let Id = $(this).data('id');
                let name = $(this).data('name');
                $.ajax({
                    url: "{{ route('product.changeStatus') }}",
                    method: 'POST',
                    data: {
                        id: Id
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $.get(location.href, function(data) {
                                var tableContent = $(data).find('#div-table').html();
                                $('#div-table').html(tableContent);
                            });
                            toastr.success('Đã thay đổi trạng thái', 'Thành công!!!');
                        }
                    }
                });
            });
            //  delete image product
            $(document).on('click', '.btn-img-delete', function(e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let imgId = $(this).data('img-id');
                let imgName = $(this).data('img-name');
                if (confirm('Bạn có chắc muốn xóa ảnh này không?')) {
                    $.ajax({
                        url: "{{ route('product.deleteImg') }}",
                        method: 'POST',
                        data: {
                            productId: productId,
                            imgId:imgId,
                            imgName: imgName
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                $.get(location.href, function(data) {
                                    var tableContent = $(data).find('#img-div').html();
                                    $('#img-div').html(tableContent);
                                });
                                toastr.success('Đã xóa ảnh', 'Thành công!!!');
                            }
                        }
                    });
                }
            });
        }
    // reload table
    
    
    </script>