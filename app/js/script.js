"use strict";
jQuery.noConflict();
jQuery(document).ready(function ($) {
  filterAndUpdateByCountry($);
  sortInstitutionsAsync($);
  addToFavourite($);
  removeFromFavourite($);
  registerFormValidation($);
  loadData($);
});

function sortInstitutionsAsync($) {
  $('select[name="sorting-options"]').change(function (event) {
    event.preventDefault();
    $.ajax({
      type: "GET",
      url: "./helpers/sort_institutions.php",
      data: {
        sortBy: $(this).val(),
        country: $('select[name="country-dropdown"]').val(),
      },
      success: function (response) {
        console.log(response);
        $("#institution-list").replaceWith(response);
      },
      fail: function (response) {
        console.log("Filter by country fail");
      },
    });
  });
}

function filterAndUpdateByCountry($) {
  $('select[name="country-dropdown"]').change(function (event) {
    event.preventDefault();
    $.ajax({
      type: "GET",
      url: "./helpers/filter_by_country.php",
      data: {
        country: $(this).val(),
        sortBy: $('select[name="sorting-options"]').val(),
      },
      success: function (response) {
        $("#institution-list").replaceWith(response);
      },
      fail: function (response) {
        console.log("Filter by country fail");
      },
    });
  });
}

function addToFavourite($) {
  $(".button.add-favourite").click(function (event) {
    event.preventDefault();
    let addFavouriteUrl = $(this).attr("href");
    $.ajax({
      type: "GET",
      url: addFavouriteUrl,
      data: {
        favouriteInstitution: document.getElementsByTagName("h1")[0].innerText,
      },
      success: function (response) {
        window.location.reload();
      },
      fail: function (response) {
        console.log("Filter by country fail");
      },
    });
  });
}

function removeFromFavourite($) {
  $(".button.remove-favourite").click(function (event) {
    event.preventDefault();
    let removeFavouriteUrl = $(this).attr("href");
    $.ajax({
      type: "GET",
      url: removeFavouriteUrl,
      data: {
        institutionToBeRemoved:
          document.getElementsByTagName("h1")[0].innerText,
      },
      success: function (response) {
        window.location.reload();
      },
      fail: function (response) {
        console.log("Filter by country fail");
      },
    });
  });
}

function registerFormValidation($) {
  $("form[name='registerForm']").validate({
    // Define validation rules
    rules: {
      username: {
        required: true,
        minlength: 5,
        maxlength: 25,
      },
      first_name: {
        required: true,
      },
      last_name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5,
        maxlength: 30,
      },
      password_confirm: {
        required: true,
        minlength: 5,
        maxlength: 30,
        equalTo: "#password",
      },
    },
    // Specify validation error messages
    messages: {
      username: "Please provide a valid username.",
      first_name: "Please provide your first name",
      last_name: "Please provide your last name",
      email: {
        required: "Please enter youe email",
        minlength: "Please enter a valid email",
      },
      password: {
        required: "Please enter your password",
        minlength:
          "Please enter a valid password. It must be longer that 5 characters.",
      },
      password_confirm: {
        required: "Please confirm your password",
        minlength: "Your password do not match",
        equalTo: "Please enter the same password as above",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
}

function loadData(query) {
  $.ajax({
    url: "./helpers/fetch.php",
    method: "POST",
    data: {
      query: query,
    },
    success: function (data) {
      $("#result").html(data);
    },
  });
}

$("#search_text").keyup(function () {
  var search = $(this).val();
  if (search != "") {
    load_data(search);
  } else {
    load_data();
  }
});
