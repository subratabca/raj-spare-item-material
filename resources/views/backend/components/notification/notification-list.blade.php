<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Notification List Information</h5></span>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class=" table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Notification Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
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
    try {
        let res = await axios.get("/admin/notification/list/info");

        let tableList = $("#tableList");
        tableList.empty(); 

        const notifications = [
            ...res.data.unreadNotifications.map(item => ({ ...item, status: 'unread' })),
            ...res.data.readNotifications.map(item => ({ ...item, status: 'read' }))
        ];


        function getNotificationLink(notification) {
            if (notification.data.order_id) {
                return `/admin/order/details/${notification.data.order_id}?notification_id=${notification.id}`;
            } else if (notification.data.complain_id) {
                return `/admin/complain/details/${notification.data.complain_id}?notification_id=${notification.id}`;
            } else if (notification.data.food_id) {
                return `/admin/food/details/${notification.data.food_id}?notification_id=${notification.id}`;
            } else {
                return '#';
            }
        }
         

        notifications.forEach(function (item, index) {
            const link = getNotificationLink(item);
            let date = new Date(item.created_at);

            let badgeClass = item.status === 'unread' ? 'badge bg-danger' : 'badge bg-success';
            let badgeText = item.status.charAt(0).toUpperCase() + item.status.slice(1);

            let row = `<tr>
                        <td class="text-truncate">${index + 1}</td>
                        <td class="text-truncate"><a href="${link}">${item.data.data}</a></td>
                        <td class="text-truncate">${date.toLocaleDateString()}</td>
                        <td class="text-truncate">${date.toLocaleTimeString()}</td>
                        <td class="text-truncate"><span class="${badgeClass}">${badgeText}</span></td>
                        <td class="text-truncate">
                           <button class="btn btn-danger" onclick="deleteNotification('${item.id}')">Delete</button>
                        </td>
                     </tr>`;
            tableList.append(row);
        });

        initializeDataTable();

    } catch (error) {
        console.error("Error fetching notifications:", error);
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

async function deleteNotification(notificationId) {
    try {
        let res = await axios.delete(`/admin/delete/notification/${notificationId}`);
        if (res.status === 200) {
            successToast(res.data.message || 'Request success');
            await getList(); 
        } else {
            errorToast(res.data.message || "Request failed");
        }
    } catch (error) {
        if (error.response) {
            const status = error.response.status;
            const message = error.response.data.message || 'An unexpected error occurred';

            if (status === 404) {
                if (error.response.data.status === 'failed to fetch user') {
                    errorToast(error.response.data.message || 'User not found');
                } else if (error.response.data.status === 'failed') {
                    errorToast(error.response.data.message || 'Notification not found');
                } else {
                    errorToast(message);
                }
            } else if (status === 500) {
                errorToast('Server error: ' + message);
            } else {
                errorToast(message); 
            }
        } else {
            errorToast('Error: ' + error.message); 
        }
    }

}
</script>
