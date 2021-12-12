<?php
    session_start();
    include("helpers/helper_pages.php");

    $title = "Institution List";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
?>

<main>
    <h1>Browse Universities Around The World</h1>

    <p class="filter-note bold">Browse institutions by world rank OR filter by country</p>
    <div class="filter-group">
        <form id="world-rank" method="get">
            <fieldset>
                <legend>World Rank</legend>
                <div class="input-group">
                    <div class="radio-input">
                        <input type="radio" id="top-rank" name="rank-option" value="1-250" class="radio">
                        <label for="top-rank">1 - 250</label>
                    </div>
                    <div class="radio-input">
                        <input type="radio" id="mid-rank" name="rank-option" value="251-500" class="radio">
                        <label for="mid-rank">251 - 500</label>
                    </div>
                    <div class="radio-input">
                        <input type="radio" id="lower-rank" name="rank-option" value="501plus" class="radio">
                        <label for="lower-rank">501+</label>
                    </div>
                </div>
            </fieldset>
            <button type="submit">Filter</button>
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
        if (!isset($_GET['rank-option'])) {
            displayInstitutions();
        } else {
            include("filter_by_world_rank.php");
        }
    ?>

</main>

<?php
include("includes/footer.php");
?>