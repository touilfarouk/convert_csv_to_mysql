// Initialize the map
const map = L.map('map').setView([51.505, -0.09], 13); // Default to a central location

// Add a tile layer (Map provider)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Optional: Add a default marker or some map information
L.marker([51.505, -0.09]).addTo(map)
    .bindPopup('Default location')
    .openPopup();

// Handle file upload
$('#upload-form').on('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    // Show loading spinner
    $('#loading').show();

    $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            $('#loading').hide(); // Hide loading spinner

     alert('CSV file has been imported successfully.')

            // Process the data and add markers to the map
         /*   const markers = L.featureGroup(); // Create a feature group for clustering

            data.forEach(item => {
                // Example of extracting latitude and longitude; adjust based on your data structure
                if (item['Zip Code']) {
                    // Use geocoding or some method to convert Zip Code to coordinates
                    const coordinates = [/* latitude, longitude based on Zip Code *//*];
                    L.marker(coordinates)
                        .bindPopup(`<b>${item['First Name']} ${item['Last Name']}</b>`)
                        .addTo(markers);
                }
            });*/

           /* markers.addTo(map);
            map.fitBounds(markers.getBounds()); // Adjust map view to fit markers*/
        },
        error: function (xhr, status, error) {
            console.error('Error fetching map data:', error);
            $('#loading').hide(); // Hide loading spinner
        }
    });
});



function displayData(){

    $.ajax({
        url: "get_lead_data.php",
        method: "post",
        async: true, // Use default behavior for async
        success: function(response) {
            var data = JSON.parse(response);
    
            const markers = L.featureGroup(); // Create a feature group for clustering
    
            data.forEach(item => {
                //console.log(item)
                // Example of extracting Zip Code; adjust based on your data structure
                const zipCode = item['zip_code'];
                //console.log(zipCode);
    
                if (zipCode) {
                    // Placeholder function for geocoding Zip Code to coordinates
                
                      
                            L.marker()
                                .bindPopup(`<b>${item['First Name']} ${item['Last Name']}</b>`)
                                .addTo(markers);
                    
                }
            });
    
            // Add the markers feature group to the map
            markers.addTo(map);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: ", status, error);
        }
    });
    
  
    
}


displayData()


// Handle filter application
/*$('#apply-filters').on('click', function () {
    const league = $('#league').val();
    const age = $('#age').val();
    const level = $('#level').val();

    // Example of applying filters to the data
    $.ajax({
        url: 'upload.php',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (!Array.isArray(data)) {
                console.error('Data is not an array');
                return;
            }

            // Apply filters to the data
            const filteredData = data.filter(item => {
                return (!league || item['League Division Interests'].includes(league)) &&
                       (!age || item['Age Interests'] === age) &&
                       (!level || item['Level of Play'] === level);
            });

            // Clear existing markers
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Add filtered markers
            const markers = L.featureGroup(); // Create a feature group for clustering

            filteredData.forEach(item => {
                if (item['Zip Code']) {
                    // Use geocoding or some method to convert Zip Code to coordinates
                    const coordinates = [51.505, -0.09]; // Replace with real lat/lon
                    L.marker(coordinates)
                        .bindPopup(`<b>${item['First Name']} ${item['Last Name']}</b>`)
                        .addTo(markers);
                }
            });

            markers.addTo(map);
            map.fitBounds(markers.getBounds()); // Adjust map view to fit markers
        },
        error: function (xhr, status, error) {
            console.error('Error fetching filtered map data:', error);
        }
    });
});*/
