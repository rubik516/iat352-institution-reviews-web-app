'use strict';
jQuery.noConflict();
jQuery(document).ready(function($) {
    $('select[name="country-dropdown"]').change(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: './helpers/filter_by_country.php',
            data: { country: $(this).val() },
            success: function(data) {
                $('#institution-list').replaceWith(data);
            },
            fail: function(data) {
                console.log("Filter by country fail");
            },
        });
    })
});