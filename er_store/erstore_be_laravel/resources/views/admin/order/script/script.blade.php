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
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let deleteId = $(this).data('id');
            let name = $(this).data('name');
            if (confirm('Bạn có chắc muốn xóa Đơn hàng ' + name + ' không?')) {
                $.ajax({
                    url: "{{ route('order.delete') }}",
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
                            toastr.success('Đã xóa Đơn hàng ' + name, 'Thành công!!!');
                        }
                    }
                });
            }
        });
    }
</script>