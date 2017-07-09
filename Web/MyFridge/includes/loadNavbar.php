<?php
@session_start(); //Sicherstellen, dass eine Session aktiv is
?>
<nav class="navbar navbar-toggleable-md navbar-default bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/index.php">MyFridge</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
			<?php if (isset($_SESSION["user"])) { ?>
            <li class="nav-item active">
                <a class="nav-link" name="myItemsPage" id="myItemsPage" href="/myItems.php"><i
                        class="fa fa-list-alt"></i>&nbsp;Mein Inventar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" name="userSettingsPage" id="userSettingsPage" href="/userSettings.php">Meine
                    Daten</a>
            </li>
			<?php } ?>
            <form role="form" class="form-inline my-2 my-lg-0" action="../searchResults.php"
                  method="post" id="searchForm" name="searchForm">
                <input class="form-control mr-sm-2" name="searchInput" id="searchInput" type="text"
                       placeholder="Suche...">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Suche</button>
            </form>
			<?php if (!isset($_SESSION["user"])) { ?>
            <li class="nav-item">
                <a class="nav-link" name="loginPage" id="loginPage" href="/login.php">Anmelden</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" name="registerPage" id="registerPage" href="/register.php">Registrieren</a>
            </li>
            <?php } else { ?>
                <li class="nav-item active">
                    <a class="nav-link" name="myItemsPage" id="myItemsPage" href="/logout.php">Ausloggen</a>
                </li>
			<?php } ?>
        </ul>
    </div>
</nav>