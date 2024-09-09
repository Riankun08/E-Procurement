<script>
    "use strict";

    var KTUsersList = function() {
        // Define shared variables
        var table = $('#kt_table_form_dynamic');
        var datatable;
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;

        var initUserTable = function() {
            datatable = table.DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "/forms-dynamies",
                    "type": "GET",
                    "dataSrc": function(json) {
                        return json.data;
                    }
                },
                'columnDefs': [{
                        orderable: false,
                        targets: 0
                    },
                    {
                        orderable: false,
                        targets: 4
                    },
                ],
                'columns': [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-between">
                                    <a href="/forms-dynamies/detail/${row.id}" class="btn btn-sm btn-primary p-3 m-1">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.375 15.7143H6.25V15C6.25 14.6071 5.96875 14.2857 5.625 14.2857H4.375C4.03125 14.2857 3.75 14.6071 3.75 15V15.7143H0.625C0.28125 15.7143 0 16.0357 0 16.4286V17.8571C0 18.25 0.28125 18.5714 0.625 18.5714H3.75V19.2857C3.75 19.6786 4.03125 20 4.375 20H5.625C5.96875 20 6.25 19.6786 6.25 19.2857V18.5714H19.375C19.7188 18.5714 20 18.25 20 17.8571V16.4286C20 16.0357 19.7188 15.7143 19.375 15.7143ZM19.375 8.57143H16.25V7.85714C16.25 7.46429 15.9688 7.14286 15.625 7.14286H14.375C14.0312 7.14286 13.75 7.46429 13.75 7.85714V8.57143H0.625C0.28125 8.57143 0 8.89286 0 9.28571V10.7143C0 11.1071 0.28125 11.4286 0.625 11.4286H13.75V12.1429C13.75 12.5357 14.0312 12.8571 14.375 12.8571H15.625C15.9688 12.8571 16.25 12.5357 16.25 12.1429V11.4286H19.375C19.7188 11.4286 20 11.1071 20 10.7143V9.28571C20 8.89286 19.7188 8.57143 19.375 8.57143ZM19.375 1.42857H11.25V0.714286C11.25 0.321429 10.9688 0 10.625 0H9.375C9.03125 0 8.75 0.321429 8.75 0.714286V1.42857H0.625C0.28125 1.42857 0 1.75 0 2.14286V3.57143C0 3.96429 0.28125 4.28571 0.625 4.28571H8.75V5C8.75 5.39286 9.03125 5.71429 9.375 5.71429H10.625C10.9688 5.71429 11.25 5.39286 11.25 5V4.28571H19.375C19.7188 4.28571 20 3.96429 20 3.57143V2.14286C20 1.75 19.7188 1.42857 19.375 1.42857Z" fill="white"/>
                                        </svg>
                                    </a>
                                    <a href="/forms-dynamies/edit/${row.id}" class="btn btn-sm btn-success p-3 m-1">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.43302 13.9171L6.69502 10.7621C6.89617 10.2594 7.19725 9.80289 7.58002 9.42006L14.5 2.50206C14.8978 2.10423 15.4374 1.88074 16 1.88074C16.5626 1.88074 17.1022 2.10423 17.5 2.50206C17.8978 2.89988 18.1213 3.43945 18.1213 4.00206C18.1213 4.56467 17.8978 5.10423 17.5 5.50206L10.58 12.4201C10.197 12.8031 9.74002 13.1051 9.23702 13.3061L6.08302 14.5681C5.99216 14.6044 5.89262 14.6133 5.79674 14.5937C5.70087 14.574 5.61287 14.5266 5.54366 14.4574C5.47446 14.3882 5.42708 14.3002 5.40742 14.2043C5.38775 14.1085 5.39665 14.0089 5.43302 13.9181V13.9171Z" fill="white"/>
                                            <path d="M3.5 5.75C3.5 5.06 4.06 4.5 4.75 4.5H10C10.1989 4.5 10.3897 4.42098 10.5303 4.28033C10.671 4.13968 10.75 3.94891 10.75 3.75C10.75 3.55109 10.671 3.36032 10.5303 3.21967C10.3897 3.07902 10.1989 3 10 3H4.75C4.02065 3 3.32118 3.28973 2.80546 3.80546C2.28973 4.32118 2 5.02065 2 5.75V15.25C2 15.9793 2.28973 16.6788 2.80546 17.1945C3.32118 17.7103 4.02065 18 4.75 18H14.25C14.9793 18 15.6788 17.7103 16.1945 17.1945C16.7103 16.6788 17 15.9793 17 15.25V10C17 9.80109 16.921 9.61032 16.7803 9.46967C16.6397 9.32902 16.4489 9.25 16.25 9.25C16.0511 9.25 15.8603 9.32902 15.7197 9.46967C15.579 9.61032 15.5 9.80109 15.5 10V15.25C15.5 15.94 14.94 16.5 14.25 16.5H4.75C4.06 16.5 3.5 15.94 3.5 15.25V5.75Z" fill="white"/>
                                        </svg>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete p-3 m-1" data-id="${row.id}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.74997 1C8.02062 1 7.32115 1.28973 6.80543 1.80546C6.2897 2.32118 5.99997 3.02065 5.99997 3.75V4.193C5.20497 4.27 4.41597 4.369 3.63497 4.491C3.53622 4.50445 3.44114 4.53745 3.35529 4.58807C3.26943 4.63869 3.19453 4.70591 3.13496 4.78581C3.07538 4.86571 3.03233 4.95668 3.00831 5.0534C2.98429 5.15013 2.97979 5.25067 2.99508 5.34916C3.01036 5.44764 3.04512 5.54209 3.09733 5.62699C3.14953 5.71189 3.21813 5.78553 3.29912 5.84361C3.38011 5.90169 3.47186 5.94305 3.56902 5.96526C3.66618 5.98748 3.76679 5.99011 3.86497 5.973L4.01397 5.951L4.85497 16.469C4.91003 17.1582 5.22267 17.8014 5.73063 18.2704C6.23859 18.7394 6.90458 18.9999 7.59597 19H12.403C13.0944 19.0002 13.7605 18.74 14.2686 18.2711C14.7768 17.8022 15.0897 17.1592 15.145 16.47L15.986 5.95L16.135 5.973C16.3297 5.99952 16.527 5.94858 16.6845 5.83111C16.8421 5.71365 16.9472 5.53906 16.9773 5.34488C17.0075 5.15071 16.9602 4.95246 16.8457 4.79278C16.7312 4.6331 16.5586 4.52474 16.365 4.491C15.5797 4.36878 14.791 4.26941 14 4.193V3.75C14 3.02065 13.7102 2.32118 13.1945 1.80546C12.6788 1.28973 11.9793 1 11.25 1H8.74997ZM9.99997 4C10.84 4 11.673 4.025 12.5 4.075V3.75C12.5 3.06 11.94 2.5 11.25 2.5H8.74997C8.05997 2.5 7.49997 3.06 7.49997 3.75V4.075C8.32697 4.025 9.15997 4 9.99997 4ZM8.57997 7.72C8.57201 7.52109 8.48536 7.33348 8.33909 7.19846C8.19281 7.06343 7.99888 6.99204 7.79997 7C7.60106 7.00796 7.41345 7.0946 7.27843 7.24088C7.1434 7.38716 7.07201 7.58109 7.07997 7.78L7.37997 15.28C7.38391 15.3785 7.40721 15.4752 7.44854 15.5647C7.48987 15.6542 7.54842 15.7347 7.62085 15.8015C7.69328 15.8684 7.77817 15.9203 7.87067 15.9544C7.96317 15.9884 8.06148 16.0039 8.15997 16C8.25846 15.9961 8.35521 15.9728 8.4447 15.9314C8.53418 15.8901 8.61465 15.8315 8.68151 15.7591C8.74837 15.6867 8.80031 15.6018 8.83436 15.5093C8.86841 15.4168 8.88391 15.3185 8.87997 15.22L8.57997 7.72ZM12.92 7.78C12.9239 7.68151 12.9084 7.58321 12.8744 7.4907C12.8403 7.3982 12.7884 7.31331 12.7215 7.24088C12.6547 7.16845 12.5742 7.1099 12.4847 7.06857C12.3952 7.02724 12.2985 7.00394 12.2 7C12.0011 6.99204 11.8071 7.06343 11.6609 7.19846C11.5146 7.33348 11.4279 7.52109 11.42 7.72L11.12 15.22C11.116 15.3185 11.1315 15.4168 11.1656 15.5093C11.1996 15.6018 11.2516 15.6867 11.3184 15.7591C11.3853 15.8315 11.4658 15.8901 11.5552 15.9314C11.6447 15.9728 11.7415 15.9961 11.84 16C11.9385 16.0039 12.0368 15.9884 12.1293 15.9544C12.2218 15.9203 12.3067 15.8684 12.3791 15.8015C12.4515 15.7347 12.5101 15.6542 12.5514 15.5647C12.5927 15.4752 12.616 15.3785 12.62 15.28L12.92 7.78Z" fill="white"/>
                                        </svg>
                                    </button>
                                </div>`;
                        },
                        orderable: false
                    }
                ]
            });

            var initToggleToolbar = function() {
                console.log('Toolbar initialized');
            }

            var handleDeleteRows = function() {
                table.on('click', '.btn-delete', function() {
                    var userId = $(this).data('id');
                    var row = $(this).closest('tr');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    Swal.fire({
                        text: "Are you sure you want to delete this user?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/forms-dynamies/delete/${userId}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            datatable.row(row).remove()
                                                .draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        text: "Failed to delete the user.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            }


            var toggleToolbars = function() {
                console.log('Toggle toolbars');
            }

            datatable.on('draw', function() {
                initToggleToolbar();
                handleDeleteRows();
                toggleToolbars();
            });
        }

        var handleSearchDatatable = function() {
            const filterSearch = $('[data-kt-user-table-filter="search"]');
            filterSearch.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        }

        return {
            init: function() {
                initUserTable();
                handleSearchDatatable();
            }
        }
    }();

    $(document).ready(function() {
        KTUsersList.init();
    });
</script>
