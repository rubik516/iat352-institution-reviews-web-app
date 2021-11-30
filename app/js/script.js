'use strict';
jQuery.noConflict();
jQuery(document).ready(function($) {
    filterAndUpdateByCountry($);
    sortAlphabetically($);
    addToFavourite($);
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

function addToFavourite($) {
    $('.button.add-favourite').click(function(event) {
        event.preventDefault();
        let addFavouriteUrl = $(this).attr("href");
        $.ajax({
            type: 'GET',
            url: addFavouriteUrl,
            data: { fave_institution: document.getElementsByTagName("h1")[0].innerText },
            success: function(response) {
                window.location.href = "./favourite.php";
            },
            fail: function(response) {
                console.log("Filter by country fail");
            },
        });
    });
}