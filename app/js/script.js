'use strict';
jQuery.noConflict();
jQuery(document).ready(function($) {
    filterAndUpdateByCountry($);
    sortAlphabetically($);
});

function sortAlphabetically($) {
    $('select[name="sorting-options"]').change(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: './helpers/sort_institution_alphabetically.php',
            data: { sortBy: $(this).val(),
                    country: $('select[name="country-dropdown"]').val(),
            },
            success: function(response) {
                console.log(response);
                $('#institution-list').replaceWith(response);
            },
            fail: function(response) {
                console.log("Filter by country fail");
            },
        });
    });
}

function filterAndUpdateByCountry($) {
    $('select[name="country-dropdown"]').change(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: './helpers/filter_by_country.php',
            data: { country: $(this).val(),
                    sortBy: $('select[name="sorting-options"]').val(),
            },
            success: function(response) {
                $('#institution-list').replaceWith(response);
            },
            fail: function(response) {
                console.log("Filter by country fail");
            },
        });
    });
}