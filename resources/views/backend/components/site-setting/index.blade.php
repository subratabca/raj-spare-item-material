<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Site Setting Information</h5></span>
        <div class="card-header-elements ms-auto">
            <a href="/admin/create/site-setting" type="button" class="btn btn-primary waves-effect waves-light">
                <span class="tf-icon mdi mdi-plus me-1"></span>Add New
            </a>
        </div>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone1</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">
                
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        getList(); 
    });

    async function getList() {
        showLoader();
        try {
            let res = await axios.get("/admin/site-setting-list");

            let tableList = $("#tableList");
            tableList.empty(); 

            if (!res.data.data) {
                tableList.append('<tr><td colspan="9" class="text-center">No Data Found</td></tr>');
            } else {
                let row = `
                    <tr>
                        <td>1</td>
                        <td>${res.data.data['logo'] ? `<img src="/upload/site-setting/${res.data.data['logo']}" width="150" height="50">` : `<img src="/upload/no_image.jpg" width="80" height="50">`}</td>
                        <td>${res.data.data['name']}</td>
                        <td>${res.data.data['email']}</td>
                        <td>${res.data.data['phone1']}</td>
                        <td>${res.data.data['address']}</td>
                        <td>
                            <a href="/admin/site-setting/details/${res.data.data['id']}" class="btn btn-sm btn-outline-primary"><span class="mdi mdi-eye-circle"></span></a>

                            <a href="/admin/edit/site-setting/${res.data.data['id']}" class="btn btn-sm btn-outline-success"><span class="mdi mdi-pencil-outline"></span></a>

                            <button data-id="${res.data.data['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><span class="mdi mdi-trash-can-outline"></span></button>
                        </td>
                    </tr>`;
                tableList.append(row);
            }

            initializeDataTable();
            attachEventListeners();

        } catch (error) {
            handleError(error);
        } finally {
            hideLoader();
        }
    }

    function initializeDataTable() {
        if ($.fn.DataTable.isDataTable('#foodTable')) {
            $('#foodTable').DataTable().destroy();
        }

        $('#foodTable').DataTable({
            paging: true,
            serverSide: false, 
            autoWidth: false,
            ordering: true,
            searching: true, 
            lengthMenu: [10, 25, 50, 100], 
            pageLength: 10, 
        });
    }

    function attachEventListeners() {
        $('.deleteBtn').on('click', function () {
            let id = $(this).data('id');
            $("#deleteID").val(id);
            $("#delete-modal").modal('show');
        });
    }

    function handleError(error) {
        if (error.response) {
            if (error.response.status === 404) {
                //errorToast(error.response.data.message || "Data not found.");
            } else if (error.response.status === 500) {
                errorToast(error.response.data.error || "An internal server error occurred.");
            } else {
                errorToast("Request failed!");
            }
        } else {
            errorToast("Request failed!");
        }
    }
</script>
