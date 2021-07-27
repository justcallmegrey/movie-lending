<script type="text/javascript">
    const table = '#table-returns';
    const modal = '.modal-returns';
    const filterMovie = '.table-search-movie';
    const filterMember = '.table-search-member';
    const btnFilter = '#btn-filter';
    const btnReset = '#btn-reset';
    let activeTable = null;

    const showDatatables = () => {
        activeTable = $(table).DataTable({
            processing: true,
            serverSide: true,
            dom: 'C<"clear">lfrtip<"bottom">',
            searching : true,
            scrollX : true,
            scrollCollapse : true,
            dom: "lrtip",
            ajax: {
                url: "{{ route('returns.datatable') }}",
                data: function (d) {
                    d.keyword = $('#keyword').val();
                    d.name = $('[name="name"]').val();
                    d.slug = $('[name="slug"]').val();
                    d.sort = $('#sort').val();
                    d.movie_title = $(filterMovie).val();
                    d.member_name = $(filterMember).val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', orderable: false },
                { data: 'member_id', name: 'member_id', className: 'break' },
                { data: 'movie_id', name: 'movie_id', className: 'break' },
                { data: 'lending_date', name: 'lending_date' },
                { data: 'due_date', name: 'due_date' },
                { data: 'returned_date', name: 'returned_date' },
                { data: 'lateness_charge', name: 'lateness_charge' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
            ],
            drawCallback: (settings) => {
                if ($(btnFilter).prop('disabled') === true) {
                    $(btnFilter).prop('disabled', false);
                }
                if ($(btnReset).prop('disabled') === true) {
                    $(btnReset).prop('disabled', false);
                }
            },
            order: [[7,'desc']]
        });

        $('.search-table').on('click' ,function () {
            activeTable.search($('.table-search').val()).draw();
        });
    };

    $(function () {

        showDatatables();

        $(document).on('click', btnFilter, function (e) {
            e.preventDefault();
            const me = $(this);
            if (me.prop('disabled') === false) {
                me.prop('disabled', true);
                $(table).DataTable().ajax.reload();
            }
        });

        $(document).on('click', btnReset, function (e) {
            e.preventDefault();
            const me = $(this);
            if (me.prop('disabled') === false) {
                me.prop('disabled', true);
                $(filterMovie).val('');
                $(filterMember).val('');
                $(table).DataTable().ajax.reload();
            }
        });

        $(document).on('click', '.btn-action', function (e) {
            if (!$(this).attr('disabled')) {
                const href = $(this).data('href');
                const type = $(this).data('type');

                $.ajax({
                    url: href,
                    type: 'GET',
                    dataType: 'HTML',
                    success: function (data) {
                        $(document).find('.main-modal-container').html(data);
                        $(`#modal-${type}`).modal('show');
                    }
                });
                e.preventDefault();
            }
        });

        $(document).on('click', modal + ' [type="submit"]', function (e) {
            const btnSubmit  = $(this);
            const form = $(this).parents('form');
            const action = $(form).attr('action');
            const formData = new FormData($(form)[0]);

            btnSubmit.prop('disabled', true);

            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: (data) => {
                    removeErrorBox();
                },
                success: (data) => {
                    $(modal).modal('hide');
                    $(table).DataTable().ajax.reload();
                    showToast(data?.type, '', data?.message);
                },
                error: (data) => {
                    const res = data?.responseJSON;
                    showToast(res?.type, '', res?.message);
                    handleAjaxValidationError(data);
                }
            });
            btnSubmit.prop('disabled', false);
            e.preventDefault();
        });

        $('.table-search').keypress(function(event){
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                activeTable.search($(this).val()).draw();
            }
        });
    });
</script>
