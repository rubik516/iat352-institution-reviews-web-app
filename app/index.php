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
                <label for="search-institution">Search for institution</label>
                <input id="search-institution" type="text" name="search-institution" placeholder="Enter an institution's name">
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

        <div class="search-list">
            <a href="#"> List 1</a>
        </div>
    </div>

    <?php
        displayInstitutions();
    ?>

</main>

<?php
    include("includes/footer.php");
?>
