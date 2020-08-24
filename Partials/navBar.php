<nav class="navbar">
    <a style="display: inline-block; height: 100%; width: fit-content;" href="user.php"><img src="Graphics/logo.png" id="headerPicture"></a>
    <button id="logoutButton">Logout</button>
    <div id="logoutModal" class="modal" style="display: none;">
        <div>
            <p>Are you sure you want to log out?</p>
            <form method="post" action="PHP/logout.php"><button id="logoutModalYes" name="logout">Yes</button></form>
            <button id="logoutModalNo">No</button>
        </div>
    </div>
</nav>
<script src="Javascript/navBar.js"></script>