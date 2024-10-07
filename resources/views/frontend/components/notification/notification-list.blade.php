@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Food List</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">Sl</th>
                            <th class="text-truncate">Notification Type</th>
                            <th class="text-truncate">Date</th>
                            <th class="text-truncate">Time</th>
                            <th class="text-truncate">Status</th>
                            <th class="text-truncate">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
document.addEventListener("DOMContentLoaded", function () {
    getList();
});

async function getList() {
    try {
        let res = await axios.get("/user/notification/list/info");

        let tableList = $("#tableList");
        tableList.empty(); 

        // Combine unread and read notifications
        const notifications = [
            ...res.data.unreadNotifications.map(item => ({ ...item, status: 'unread' })),
            ...res.data.readNotifications.map(item => ({ ...item, status: 'read' }))
        ];


        function getNotificationLink(notification) {
            if (notification.data.order_id) {
                return `/user/order-details/${notification.data.order_id}?notification_id=${notification.id}`;
            } else if (notification.data.complain_id) {
                return `/user/complain-details/${notification.data.complain_id}?notification_id=${notification.id}`;
            } else {
                return '#';
            }
        }
         

        notifications.forEach(function (item, index) {
            const link = getNotificationLink(item);
            let date = new Date(item.created_at);
            let row = `<tr>
                        <td class="text-truncate">${index + 1}</td>
                        <td class="text-truncate"><a href="${link}">${item.data.data}</a></td>
                        <td class="text-truncate">${date.toLocaleDateString()}</td>
                        <td class="text-truncate">${date.toLocaleTimeString()}</td>
                        <td class="text-truncate">${item.status}</td>
                        <td class="text-truncate">
                           <button class="btn btn-danger" onclick="deleteNotification('${item.id}')">Delete</button>
                        </td>
                     </tr>`;
            tableList.append(row);
        });
    } catch (error) {
        console.error("Error fetching notifications:", error);
    }
}


async function deleteNotification(notificationId) {
    try {
        let res = await axios.delete(`/user/delete/notification/${notificationId}`);
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
                    errorToast(message); // Catch-all for other 404 cases
                }
            } else if (status === 500) {
                errorToast('Server error: ' + message);
            } else {
                errorToast(message); // Catch-all for other status codes
            }
        } else {
            errorToast('Error: ' + error.message); // For errors not from the server
        }
    }

}
</script>




