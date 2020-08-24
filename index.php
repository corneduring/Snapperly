<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require "Partials/meta.php"; ?>
        <?php require "SQL/databaseConnection.php"; ?>
        <?php require "Partials/sessionStart.php"; ?>
    </head>
    <body>

        <div id="indexForms">

            <!--Log In form-->
            <form method="POST" id="logInForm" action="PHP/logIn.php">
                <img class="formPicture" src="Graphics/logo.png">
                <br><br>
                <h2>Log In</h2>
                <br>
                <!--This div will contain the error messages when the user's input is invalid-->
                <!-- <div class="errorMessage" id="errorMessage" style="display: none;">
                    <p></p>
                    <br>
                </div> -->
                <input type="email" name="email" placeholder="Email" required>
                <br><br>
                <input type="password" name="password" placeholder="Password" required>
                <br><br>
                <input type="submit" name="submitLI" value="Log In">
                <br><br>
                <label id="displaySU" onclick="displaySU()">Sign Up</label>
            </form>

            <!--Sign Up form-->
            <form method="POST" id="signUpForm" action="PHP/signUp.php">
                <img class="formPicture" src="Graphics/logo.png">
                <br><br>
                <h2>Sign Up</h2>
                <br>
                <!--This div will contain the error messages when the user's input is invalid-->
                <div class="errorMessage" id="errorMessage" style="display: none;">
                    <p></p>
                    <br>
                </div>
                <input type="text" name="firstName" placeholder="First Name" required>
                <br><br>
                <input type="text" name="lastName" placeholder="Last Name" required>
                <br><br>
                <input type="text" name="username" placeholder="Username" required>
                <br><br>
                <input type="email" name="email" placeholder="Email" required>
                <br><br>
                <input type="password" onchange="passwordValidation()" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}" required>
                <br><br>
                <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}" required>
                <br><br>
                <input id="suSubmit" type="submit" name="submitSU" value="Sign Up">
                <br><br>
                <label id="displayLI" onclick="displayLI()">Log In</label>
            </form>
        </div>

        <script src="Javascript/index.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>