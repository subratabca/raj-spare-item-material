@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Complain List</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">Sl</th>
                            <th class="text-truncate">Image</th>
                            <th class="text-truncate">Food Name</th>
                            <th class="text-truncate">Complain Date</th>
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
        let res = await axios.get("/user/complains");

        let tableList = $("#tableList");
        tableList.empty(); 
 

        res.data.data.forEach(function (item, index) {

            let row = `<tr>
                        <td class="text-truncate">${index + 1}</td>
                        <td class="text-truncate">${item.food.image ? 
                            `<img src="/upload/food/small/${item.food.image}" width="50" height="50">` : 
                            `<img src="/upload/no_image.jpg" width="50" height="50">`}
                        </td>
                        <td class="text-truncate">${item.food.name}</td>
                        <td class="text-truncate">${item.cmp_date}</td>
                        <td class="text-truncate">${item.food.user.firstName}</td>
                        <td class="text-truncate">
                            <span class="badge ${item.status === 'pending' ? 'bg-danger' : 'bg-success'}">
                                ${item.status}
                            </span>
                        </td>
                        <td class="text-truncate">
                            <a href="/user/complain-details/${item['id']}" class="btn btn-sm btn-info">Details</a>

                            ${(item.status === 'under-review') ? 
                                `<a href="/user/complain/reply/${item['id']}" class="btn btn-sm btn-danger">Reply</a>` : ''}

                            ${item['status'] === 'under-review' 
                                ? `<button data-id="${item['id']}" class="btn replyBtn btn-sm btn-outline-danger">Modal Reply</button>`
                                : ''}
                        </td>
                     </tr>`;
            tableList.append(row);
        });

        attachEventListeners();
    } catch (error) {
        console.error("Error fetching order data:", error);
    }
}

</script>