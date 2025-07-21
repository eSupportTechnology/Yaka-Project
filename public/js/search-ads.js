$(document).ready(function() {
    let districtId;
    let cityId;
    $(document).on('click', '.district-item', function() {
        districtId = $(this).data('id');
    });
    $(document).on('click', '.city-item', function() {
        cityId = $(this).data('id');
        console.log(cityId);

        $('#location').val(districtId);
        $('#cityId').val(cityId);
        $('#search-form').submit();
    });


    getDistricts();
    let selectedDistrict = null;

    // District Search Input Handler
    $('#district-search').on('input', function() {
        const query = $(this).val().trim();
        if (query.length >= 3) {
            searchDistricts(query);
        }
    });
    $('#district-search-mob').on('input', function() {
        const query = $(this).val().trim();
        if (query.length >= 3) {
            searchDistricts(query);
        }
    });


    // Back Button Handler
    $('.back-button').click(function() {
        $('.city-section').hide();
        $('.district-section').show();
        $('#district-search').val('');
        selectedDistrict = null;
    });

    // District Click Handler
    $(document).on('click', '.district-item', function() {
        selectedDistrict = $(this).data('id');
        loadCities(selectedDistrict);
        $('.district-section').hide();
        $('.city-section').show();
    });

    function searchDistricts(query) {
        $.ajax({
            url: '/api/districts',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                let html = '';
                response.forEach(district => {
                    html += `<div class="district-item" data-id="${district.id}">${district.name} \u2192</div>`;
                });
                $('#district-results').html(html || 'No districts found');
                $('#district-results-mob').html(html || 'No districts found');
            }
        });
    }

    function loadCities(districtId) {
        $.ajax({
            url: '/api/cities',
            method: 'GET',
            data: { district_id: districtId },
            success: function(response) {
                let html = '';
                response.forEach(city => {
                    html += `<div class="city-item" data-id="${city.id}">${city.name}</div>`;
                });
                $('#city-results').html(html || 'No cities found in this district');
                $('#city-results-mob').html(html || 'No cities found in this district');
            }
        });
    }

    function getDistricts() {
        $.ajax({
            url: '/api/get-districts',
            method: 'GET',
            success: function(response) {
                let html = '';
                response.forEach(district => {
                    html += `<div class="district-item" data-id="${district.id}">${district.name} \u2192</div>`;
                });
                $('#district-results').html(html || 'No districts found');
                $('#district-results-mob').html(html || 'No districts found');
            }
        });
    }
});
