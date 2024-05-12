<script type="text/javascript">
    // Start page
        $(document).ready(function() {
            // e.preventDefault();
            start();
            // priceChange();
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
            //  change category
            $(document).on('change', '.change-category', function(e) {
                e.preventDefault();
                let Id = $(this).data('id');
                var cat_id = $(this).val()
                $.ajax({
                    url: "{{ route('product.changeCategory') }}",
                    method: 'POST',
                    data: {
                        id: Id,
                        cat_id: cat_id
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $.get(location.href, function(data) {
                                var tableContent = $(data).find('#div-table').html();
                                $('#div-table').html(tableContent);
                            });
                            toastr.success('Đã thay đổi thương hiệu', 'Thành công!!!');
                        }
                    }
                });
            });
            //  change brand
            $(document).on('change', '.change-brand', function(e) {
                e.preventDefault();
                let Id = $(this).data('id');
                var brand_id = $(this).val()
                $.ajax({
                    url: "{{ route('product.changeBrand') }}",
                    method: 'POST',
                    data: {
                        id: Id,
                        brand_id: brand_id
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $.get(location.href, function(data) {
                                var tableContent = $(data).find('#div-table').html();
                                $('#div-table').html(tableContent);
                            });
                            toastr.success('Đã thay đổi thương hiệu', 'Thành công!!!');
                        }
                    }
                });
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
            //  change sale %
            $(document).on('blur', '.change-sale', function(e) {
                e.preventDefault();
                let Id = $(this).data('id');
                let value = $(this).val();
                $.ajax({
                    url: "{{ route('product.changeSalePercent') }}",
                    method: 'POST',
                    data: {
                        id: Id,
                        percent: value
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
            //  change price
            $(document).on('blur', '.change-price', function(e) {
                e.preventDefault();
                let Id = $(this).data('id');
                var price = $(this).val()
                $.ajax({
                    url: "{{ route('product.changePrice') }}",
                    method: 'POST',
                    data: {
                        id: Id,
                        price: price
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $.get(location.href, function(data) {
                                var tableContent = $(data).find('#div-table').html();
                                $('#div-table').html(tableContent);
                            });
                            toastr.success('Đã thay đổi thương hiệu', 'Thành công!!!');
                        }
                    }
                });
            });
        }
        // function priceChange(){
        //     const aPrices = document.querySelectorAll('.a-price');
        //     const inputs = document.querySelectorAll('.change-price');

        //     aPrices.forEach(aPrice => {
        //         aPrice.addEventListener('click', function() {
        //             const itemId = this.getAttribute('data-id');
        //             const correspondingInput = document.querySelector(`.change-price[data-id="${itemId}"]`);
        //             this.setAttribute('hidden', true);
        //             correspondingInput.removeAttribute('hidden');
        //             correspondingInput.focus();
        //         });
        //     });

        //     inputs.forEach(input => {
        //         input.addEventListener('blur', function() {
        //             const itemId = this.getAttribute('data-id');
        //             const correspondingA = document.querySelector(`.a-price[data-id="${itemId}"]`);
        //             this.setAttribute('hidden', true);
        //             correspondingA.removeAttribute('hidden');
        //         });
        //     });
        // }
        function toggleA_Input(element) {
            // Toggle visibility of the anchor and input
            const anchor = element.tagName === 'A' ? element : element.previousElementSibling;
            const input = element.tagName === 'INPUT' ? element : element.nextElementSibling;
            
            anchor.hidden = !anchor.hidden;
            input.hidden = !input.hidden;

            // If the input becomes visible, focus on it
            if (!input.hidden) {
                input.focus();
            }
        }
    </script>