<script type="text/javascript">
    const table = '#table-members';
    const modal = '.modal-members';
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
                url: "{{ route('members.datatable') }}",
                data: function (d) {
                    d.keyword = $('#keyword').val();
                    d.name = $('[name="name"]').val();
                    d.slug = $('[name="slug"]').val();
                    d.sort = $('#sort').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', orderable: false },
                { data: 'name', name: 'name', className: 'break' },
                { data: 'age', name: 'age' },
                { data: 'address', name: 'address', className: 'break' },
                { data: 'telephone', name: 'telephone' },
                { data: 'identity_number', name: 'identity_number' },
                { data: 'date_of_joined', name: 'date_of_joined' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
            ],
            order: [[6,'desc']]
        });

        $('.search-table').on('click' ,function () {
            activeTable.search($('.table-search').val()).draw();
        });
    };

    $(function () {

        showDatatables();

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
