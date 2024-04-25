<!-- scripts -->
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

    function start() {
        // block enter
        // $(document).keypress(
        //     function(event) {
        //         if (event.which == '13') {
        //             event.preventDefault();
        //         }
        //     }
        // );
        //  delete item
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let deleteId = $(this).data('id');
            let name = $(this).data('name');
            if (confirm('Bạn có chắc muốn xóa Thương hiệu ' + name + ' không?')) {
                $.ajax({
                    url: "{{ route('brand.delete') }}",
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
                            toastr.success('Đã xóa thương hiệu ' + name, 'Thành công!!!');
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
                url: "{{ route('brand.changeStatus') }}",
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
    }
</script>