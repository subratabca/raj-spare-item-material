<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Food Details Information</h5></span>
        <div class="card-header-elements ms-auto">
            <a href="{{ route('foods') }}" type="button" class="btn btn-primary waves-effect waves-light">
                <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back To Food List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tbody>
                    <input type="text" class="d-none" id="updateShowID">
                    <tr>
                        <th><strong>Food Image :</strong></th>
                        <td>
                            <img style="width: 150px; height: 100px;" id="food-image" src="{{asset('/upload/no_image.jpg')}}" />
                            <span id="food-images-container"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><strong>Food Name :</strong></th>
                        <td id="food-name"></td>
                    </tr>
                    <tr>
                        <th><strong>Food Gradients :</strong></th>
                        <td id="food-gradients"></td>
                    </tr>
                    <tr>
                        <th><strong>Food Description :</strong></th>
                        <td id="food-description"></td>
                    </tr>
                    <tr>
                        <th><strong>Collection Address :</strong></th>
                        <td id="food-collection-address"></td>
                    </tr>
                    <tr>
                        <th><strong>Collection Date :</strong></th>
                        <td id="food-collection-date"></td>
                    </tr>
                    <tr>
                        <th><strong>Collection Time :</strong></th>
                        <td id="food-collection-time"></td>
                    </tr>
                    <tr>
                        <th><strong>Food Status :</strong></th>
                        <td id="food-status"></td>
                    </tr>
                    <tr>
                        <th><strong>Food Provider :</strong></th>
                        <td id="food-provider"></td>
                    </tr>
                    <tr>
                        <th><a href="/admin/terms-conditions/details/food_upload" target="_blank"><strong>Food Upload T&C :</strong></a></th>
                        <td id="food-upload-tnc"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer mx-auto">
        <button type="button" onclick="foodPublish()" id="food-status-update-btn" class="btn btn-info pd-x-20">Publish</button>
    </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    FoodDetailsInfo();
  });

  async function FoodDetailsInfo() {
    showLoader();
    try {
      let url = window.location.pathname;
      let segments = url.split('/');
      let id = segments[segments.length - 1];

      document.getElementById('updateShowID').value = id;
      
      let res = await axios.get("/admin/food/info/" + id);

      if (res.status !== 200) {
        throw new Error('Failed to fetch food details.');
      }

      let foodData = res.data.data;
      let foodImages = foodData.food_images;

      let parser = new DOMParser();
      let doc = parser.parseFromString(foodData['description'], 'text/html');

      let collectionDate = new Date(foodData['collection_date']);
      let formattedDate = collectionDate.toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
      });
      let formattedStartTime = formatTime(foodData['start_collection_time']);
      let formattedEndTime = formatTime(foodData['end_collection_time']);

      document.getElementById('food-image').src = `/upload/food/small/${foodData['image']}`;
      document.getElementById('food-name').innerText = foodData['name'];
      document.getElementById('food-gradients').innerText = foodData['gradients'];
      document.getElementById('food-description').innerText = doc.body.textContent;
      document.getElementById('food-collection-address').innerText = foodData['address'];
      document.getElementById('food-collection-date').innerText = formattedDate;
      document.getElementById('food-collection-time').innerText = `${formattedStartTime} - ${formattedEndTime}`;

      let status = foodData['status'];
      let badgeClass = status === 'pending' ? 'bg-danger' : 'bg-success';
      document.getElementById('food-status').innerHTML = `<span class="badge ${badgeClass}">${status}</span>`;
      document.getElementById('food-status-update-btn').disabled = status !== 'pending';


      document.getElementById('food-provider').innerText = foodData['user']['firstName'];

      let food_upload_tnc_status = foodData['accept_tnc'];
      let tncText = food_upload_tnc_status === 0 ? 'Not Accepted' : 'Accepted';
      let tncClass = food_upload_tnc_status === 0 ? 'bg-danger' : 'bg-success';
      document.getElementById('food-upload-tnc').innerHTML = `<span class="badge ${tncClass}">${tncText}</span>`;

      let foodImagesContainer = document.getElementById('food-images-container');
      foodImagesContainer.innerHTML = ''; 

      foodImages.forEach(image => {
        let imgElement = document.createElement('img');
        imgElement.src = `/upload/food/multiple/${image.image}`;
        imgElement.style.width = '150px';
        imgElement.style.height = '100px';
        imgElement.style.marginRight = '10px';
        foodImagesContainer.appendChild(imgElement);
      });

    } catch (error) {
      handleError(error);
    } finally {
      hideLoader();
    }
  }

  function formatTime(timeString) {
    let date = new Date('1970-01-01T' + timeString + 'Z');
    let hours = date.getUTCHours();
    let minutes = date.getUTCMinutes();
    let amPm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours}:${minutes} ${amPm}`;
  }

  function handleError(error) {
    if (error.response) {
      if (error.response.status === 404) {
        errorToast(error.response.data.message || "Data not found.");
      } else if (error.response.status === 500) {
        errorToast(error.response.data.error || "An internal server error occurred.");
      } else {
        errorToast("Request failed!");
      }
    } 
  }

async function foodPublish() {
    showLoader(); 
    try {
        let id = document.getElementById('updateShowID').value;

        let res = await axios.post("/admin/update/food/status", { id: id }); 
        if (res.status === 200) {
            successToast(res.data.message || "Food status updated successfully");
            window.location.href = '/admin/food-list';
        } else {
            errorToast("Request failed!");
        }
    } catch (error) {
        handleError(error);
    } finally {
        hideLoader(); 
    }
}
 
</script>


