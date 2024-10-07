@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Order List</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">Sl</th>
                            <th class="text-truncate">Image</th>
                            <th class="text-truncate">Food Name</th>
                            <th class="text-truncate">Food Gradients</th>
                            <th class="text-truncate">Provider Name</th>
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
        let res = await axios.get("/user/orders");

        let tableList = $("#tableList");
        tableList.empty(); 
 

        res.data.data.forEach(function (item, index) {
            let formattedDate = formatDate(item.created_at);
            let formattedTime = formatTime(item.created_at);

            let row = `<tr>
                        <td class="text-truncate">${index + 1}</td>
                        <td class="text-truncate">${item.food.image ? 
                            `<img src="/upload/food/small/${item.food.image}" width="50" height="50">` : 
                            `<img src="/upload/no_image.jpg" width="50" height="50">`}
                        </td>
                        <td class="text-truncate">${item.food.name}</td>
                        <td class="text-truncate">${item.food.gradients}</td>
                        <td class="text-truncate">${item.food.user.firstName}</td>
                        <td class="text-truncate">
                            <span class="badge ${item.status === 'pending' ? 'bg-danger' : 'bg-success'}">
                                ${item.status}
                            </span>
                        </td>
                        <td class="text-truncate">
                            <a href="/user/order-details/${item['id']}" class="btn btn-sm btn-info">Details</a>
                            ${(item.status === 'completed' && !item.complain) ? 
                                `<a href="/user/food/complain/${item['id']}" class="btn btn-sm btn-danger">Complain</a>` : ''}
                        </td>
                     </tr>`;
            tableList.append(row);
        });
    } catch (error) {
        console.error("Error fetching order data:", error);
    }
}

function formatDate(dateString) {
    let date = new Date(dateString);
    let months = ["January", "February", "March", "April", "May", "June",
                  "July", "August", "September", "October", "November", "December"];

    let day = date.getUTCDate();
    let month = months[date.getUTCMonth()];
    let year = date.getUTCFullYear();

    return `${day} ${month} ${year}`;
}

function formatTime(dateString) {
    let date = new Date(dateString);
    let hours = date.getUTCHours();
    let minutes = date.getUTCMinutes();
    let seconds = date.getUTCSeconds();

    let amPm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12; 

    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    return `${hours}:${minutes}:${seconds} ${amPm}`;
}

</script>
