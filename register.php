<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="wrapper">
      <div class="title">
        Registration Form
      </div>
      <form class="form" method="POST" action="" enctype="multipart/form-data" 
      >
        <div class="input_field">
          <label>First Name</label>
          <input type="text" name="firstname" class="input" requried />
        </div>
        <div class="input_field">
          <label>Last Name</label>
          <input type="text" name="lastname" class="input" requried/>
        </div>
        <div class="input_field">
          <label>Email ID</label>
          <input type="text" name="email-address" class="input" requried/>
        </div>
        <div class="input_field">
          <label>Contact NO</label>
          <input type="number"  pattern="[0-9][10]" name="contact-no"
           class="input"requried />
        </div>
        <div class="input_field">
          <label>Address Line 1</label>
          <textarea class="textarea" name="address1"
         ></textarea>
        </div>
        <div class="input_field">
          <label>Address Line 2</label>
          <textarea class="textarea" name="address2"
          required></textarea>
        </div>
        <div class="input_field">
          <label>City</label>
         
          <input type="text" class="input" name="city" 
          required/>
        </div>
        <div class="input_field">
          <label>State</label>
         
          <input type="text" class="input" name="state" 
          required/>
        </div>
        <div class="input_field">
          <label>Pin Code</label>
          <input type="number" pattern="[0-9][6]" class="input" name="pincode"
          required />
        </div>
        <div class="input_field">
          <label>Profile Image</label>
          <input
            type="file"
            class="input"
            name="profile_user_Image"
            required
          />
        </div>
        <div class="input_field">
          <label>Cover Image</label>
          <input
            type="file"
            class="input"
            name="cover_user_Image"
            accept="image/png,image/jpg,image/jepg"
            required
          />
        </div>

        <div class="input_field">
          <input type="submit" value="Register" class="btn" name="submit"/>
        </div>
      </form>
    </div>
  </body>
</html>

<?php if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email_name = $_POST['email-address'];
    $contact_no = $_POST['contact-no'];
    $addres_line1 = $_POST['address1'];
    $addres_line2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin_code = $_POST['pincode'];

    // profile  image
    $profile_Image = $_FILES['profile_user_Image']['name'];
    $profile_TemImage = $_FILES['profile_user_Image']['tmp_name'];

    $profile_img_folder = 'image/ProfileImg' . $profile_Image;

    move_uploaded_file($profile_TemImage, $profile_img_folder);

    // cover image
    $cover_Image = $_FILES['cover_user_Image']['name'];
    $cover_TemImage = $_FILES['cover_user_Image']['tmp_name'];

    $cover_img_folder = 'image/CoverImg' . $cover_Image;

    move_uploaded_file($cover_TemImage, $cover_img_folder);

    // Check if email already exists in the database

    $check_email_sql = "SELECT * FROM empregister WHERE email_address = '$email_name'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists in the database.')</script>";
    }

    // insert the data in database
    if (empty($errors)) {
        $insert_query = "INSERT INTO empregister(id,fname, lname, email_address, contact_no, 
      address_line1, address_line2, city, state_name, pincode,profileImg,coverImg)
       VALUES (id,'$first_name', '$last_name', '$email_name', ' $contact_no', 
       ' $addres_line1', '$addres_line2', '$city', '$state',
        '$pin_code','$profile_img_folder','$profile_img_folder')";

        if ($conn->query($insert_query) === true) {
            echo "<script>alert('Registration Successful.')</script>";
        } else {
            echo 'Error:' . $insert_query . '<br>';
        }
    }

    $conn->close();
}
?>
