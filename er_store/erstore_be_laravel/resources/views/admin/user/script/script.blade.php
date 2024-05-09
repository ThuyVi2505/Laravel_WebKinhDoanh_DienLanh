<!-- scripts -->
<script type="text/javascript">
    // Start page
    $(document).ready(function() {
        // e.preventDefault();
        // set up csrf-token ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //open-close child row in table
        toggle_show();
    });

    function toggle_show() {
        //open-close child row in table
        $('.toggle-btn').html('<i class="fa-solid fa-circle-chevron-right"></i>');
        $('.child-row').addClass('d-none');
        $('.toggle-btn').click(function() {
            var childRow = $(this).closest('.parent-row').next('.child-row');
            if (childRow.is(':visible')) {
                $(this).html('<i class="fa-solid fa-circle-chevron-right"></i>'); // Change button content to plus
                childRow.fadeOut(); // Add fade-out animation
                childRow.addClass('d-none');
            } else {
                $(this).html('<i class="fa-solid fa-circle-chevron-down text-primary"></i>'); // Change button content to minus
                childRow.fadeIn();
                childRow.removeClass('d-none'); // Add fade-in animation
            }
        });
    }

</script>