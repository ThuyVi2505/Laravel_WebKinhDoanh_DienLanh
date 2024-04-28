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
            if (confirm('Bạn có chắc muốn xóa ' + name + ' không?')) {
                $.ajax({
                    url: "{{ route('attribute.delete') }}",
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
                            toastr.success('Đã xóa ' + name, 'Thành công!!!');
                        }
                    }
                });
            }
        });
        //  change status
    }
</script>