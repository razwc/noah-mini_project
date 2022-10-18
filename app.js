function updateCount() {
    // Send AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "_counts.php");
    xhr.send();
    
    xhr.addEventListener("readystatechange", function(){
        if (xhr.readyState == 4) {
            let showCount = document.getElementById("numberOfLocations");
            let response_text = xhr.responseText;
            let response_json = JSON.parse(response_text);
            
            let total_counts = response_json.count;

            showCount.innerText = `Number of locations saved : ${total_counts}`;
        }
    });
};

function updateLocation() {
    // Send AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "_counts.php");
    xhr.send();

    xhr.addEventListener("readystatechange", function() {
        if (xhr.readyState == 4) {
            let refreshLocation = document.getElementById("locationList");
            let response_text = xhr.responseText;
            let response_json = JSON.parse(response_text);
        
            let total_location = response_json.location;


            for(let i = 0; i < (total_location.length) - 1; i++) {
                refreshLocation.innerHTML = total_location[i]
            }
            
        }
    })
};

let refresh = document.getElementById("refresh");
refresh.addEventListener("click", function() {
    updateCount();
    updateLocation();
});

// function updateListAndAddress() {
//     // Send AJAX request
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "/index.php");
//     xhr.send();

//     xhr.addEventListener("readystatechange", function(){
//         if(xhr.readyState == 4) {
//             let list = document.getElementById("locationList");
//             let address = document.getElementById("addressList");

//             let response = xhr.response;

//             list.innerHTML = response;
//             address.innerHTML = response;
//         }
//     })
// }

