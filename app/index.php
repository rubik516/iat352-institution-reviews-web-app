<?php
include("helpers/helper_pages.php");

$title = "Institution List";
setHeaderAndPageTitle($title);

include("includes/navbar.php");
?>

<main>
    <h1>Browse Universities Around The World</h1>

    <div class="filter-group">
        <form method="post" id="live-search">
            <div class="field">
                <label for="search_text">Search for institution</label>
                <input type="text" name="institution_search" id="search_text" placeholder="Type to search..." class="form-control" autofocus="off" autocomplete="off">
                <div id="result"></div>
            </div>
        </form>

        <div class="field">
            <label for="country-dropdown">Country</label>
            <select id='country-dropdown' name='country-dropdown'>
                <?php
                displayCountriesList();
                ?>
            </select>
        </div>

        <div class="field">
            <label for="sorting-options">Sort By</label>
            <select id='sorting-options' name='sorting-options'>
                <option value="" selected disabled hidden></option>
                <option value="name">Institution's Name (A-Z, a-z)</option>
                <option value="world_rank">World Rank (Highest first)</option>
                <option value="international_outlook_score">International Outlook Score (Highest first)</option>
            </select>
        </div>
    </div>

    <?php
    displayInstitutions();
    ?>

</main>

<?php
include("includes/footer.php");
?>

<script type="text/javascript">
    jQuery(document).ready(function() {

        load_data();

        function load_data(query) {
            jQuery.ajax({
                url: "./helpers/fetch.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    jQuery('#result').html(data);
                }
            });

            jQuery('#search_text').keyup(function() {
            var search = jQuery(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
        }
        
    });
</script>