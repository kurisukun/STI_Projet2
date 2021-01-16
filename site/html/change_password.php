<?php

use App\Auth;
use App\Database;
use App\Flash;

require 'includes.php';

// Create (connect to) SQLite database in file
$pdo = Database::getInstance()->getPdo();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

Auth::check();

if (!empty($_POST)) {
    if (!empty($_POST['token'])) {
        if(hash_equals($_SESSION['token'], $_POST['token'])){
            if (!empty($_POST['password-old']) && !empty($_POST['password-modifier']) && !empty($_POST['password-modifier_repeat'])) {

                $userId = $_SESSION['user']['id'];
                $oldPassword = $_POST['password-old'];
                $req = $pdo->prepare('SELECT password FROM collaborators WHERE id = ?');
                $req->execute([$userId]);
                $oldPasswordHash = $req->fetchColumn();

                $password = $_POST['password-modifier'];
                $password2 = $_POST['password-modifier_repeat'];
                if (password_verify($oldPassword, $oldPasswordHash)) {
                    if ($password === $password2) {
                        // modification dans la db
                        $req = $pdo->prepare("UPDATE collaborators SET password = ? WHERE id = ?");
                        $req->execute([
                            password_hash($password, PASSWORD_BCRYPT),
                            $userId
                        ]);
                        Flash::success('Password updated successfully');
                        header('Location: list_messages.php');
                        die();
                    } else {
                        Flash::error('The two new passwords are not the same');
                    }
                } else {
                    Flash::error('Incorrect old password');
                }
                // check si les deux mdp correspondent

            } else {
                Flash::error('All fields must be filled');
            }

        }
    }
}

include 'parts/header.php';
?>

    <!-- Form for changing password -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1>Change Password</h1>
                <hr>
                <form role="form" action="change_password.php" method="post">
                    <div class="mb-3">
                        <label for="passold" class="form-label">Old password</label>
                        <input type="password" class="form-control" name="password-old" id="passold"
                               placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="pass1" class="form-label">New password</label>
                        <input type="password" class="form-control" name="password-modifier" id="pass1"
                               placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Repeat new password</label>
                        <input type="password" class="form-control" name="password-modifier_repeat" id="pass2"
                               placeholder="Repeat Password">
                    </div>
                    <input type="hidden" name="token" value="<?php echo $token?>">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary" type="submit">Change password</button>
                        <a href="list_messages.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include 'parts/footer.php';
