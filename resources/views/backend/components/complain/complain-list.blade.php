<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Complain List</h5></span>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order ID</th>
                    <th>Food Name</th>
                    <th>Message</th>
                    <th>Client Name</th>
                    <th>Complain By</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">
                <!-- Table rows will be dynamically inserted here -->
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
            let res = await axios.get("/admin/complains");

            let tableList = $("#tableList");
            tableList.empty(); 

            // Check if data is empty
            if (res.data.data.length === 0) {
                tableList.append('<tr><td colspan="10" class="text-center">No Data Found</td></tr>');
            } else {
                res.data.data.forEach(function (item, index) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(item['message'], 'text/html');
                    let limitedMessage = doc.body.textContent.substring(0, 20) + '...';

                    let createdAt = new Date(item['created_at']);

                    let complainDate = createdAt.toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });

                    let complainTime = createdAt.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true
                    });

                    let clientName = item['food']['user']['lastName'] 
                        ? `${item['food']['user']['firstName']} ${item['food']['user']['lastName']}` 
                        : item['food']['user']['firstName'];

                    let userName = item['user']['lastName'] 
                        ? `${item['user']['firstName']} ${item['user']['lastName']}` 
                        : item['user']['firstName'];

                    let row = `<tr>
                                <td>${index + 1}</td>
                                <td>${item['order_id']}</td>
                                <td>${item['food']['name']}</td>
                                <td>${limitedMessage}</td>
                                <td>${clientName}</td>
                                <td>${userName}</td>
                                <td>${complainDate}</td>
                                <td>${complainTime}</td>
                                <td>
                                    <span class="badge ${
                                        item['status'] === 'pending' ? 'bg-danger' :
                                        item['status'] === 'under-review' ? 'bg-primary' :
                                        item['status'] === 'solved' ? 'bg-success' :
                                        item['status'] === 'cancel' ? 'bg-info' :
                                        'bg-secondary'  
                                    }">
                                        ${item['status']}
                                    </span>
                                </td>
                                <td>
                                    <a href="/admin/complain/details/${item['id']}" class="btn btn-sm btn-outline-primary">
                                        <span class="mdi mdi-eye-circle"></span>
                                    </a>
                                    <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">
                                        <span class="mdi mdi-trash-can-outline"></span>
                                    </button>
                                </td>
                             </tr>`;
                    tableList.append(row);
                });
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
            "paging": true,
            "serverSide": false, 
            "autoWidth": false,
            "ordering": true,
            "searching": true, 
            "lengthMenu": [10, 25, 50, 100], 
            "pageLength": 10, 
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
                //errorToast(error.response.data.message || "Complaints not found.");
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
