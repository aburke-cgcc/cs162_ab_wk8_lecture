<?php
    //1. What's included in contact form:
        //User's email address
        //Textareas to enter the actual message
        //User's contact name (first)(last)
        //Subject about contact
        //Phone number
        //check box for preferred contact method(email or phone)
    //2. User should be able to type in form information
    //3. User should be able to submit form
    //4. User be able to reset form with one click (to defaults)
    //5. Don't accept empty fields (allow empty phone if contact preference is email)
    //6. Store contacts from web users to log all previous submissions
        //6.1 Save contact submission to database

?>
<script>
    //This is javascript
    function clearInput(input){
        //var defaultValue = input.value;
        //cases:
        //Empty box
        //Filled Box with user data
        //Default box value

        if(input.value == ''){
            input.value = input.defaultValue;
        }
        else if(input.value == input.defaultValue){
            input.value='';
        }
        else{
            //do nothing
        }
    }
</script>

<?php include('templates/header.php'); ?>
<div class="col-2">
    <h2 id="page-title">Contact</h2>
    <form method="POST">
        <div class="input-row">
            <div class="input-label"><label>First Name:</label></div>
            <div class="input-field"><input type="text" name="first_name" onfocus="clearInput(this)" onfocusout="clearInput(this)" value="Enter First Name" defaultValue="Enter First Name"></div>
        </div>
        <div class="input-row">
            <div class="input-label"><label>Last Name:</label></div>
            <div class="input-field"><input type="text" name="last_name" onfocus="clearInput(this)" onfocusout="clearInput(this)" value="Enter Last Name" defaultValue="Enter Last Name"></div>
        </div>
        <div class="input-row">
            <div class="input-label"><label>Email Address:</label></div>
            <div class="input-field"><input type="text" name="email" onfocus="clearInput(this)" onfocusout="clearInput(this)" value="Enter Email Address" defaultValue="Enter Email Address"></div>
        </div>
        <div class="input-row">
            <div class="input-label"><label>Phone Number:</label></div>
            <div class="input-field"><input type="text" name="phone" onfocus="clearInput(this)" onfocusout="clearInput(this)" value="Enter Phone Number" defaultValue="Enter Phone Number"></div>
        </div>
        <div class="input-row">
            <div class="input-fields">
                <input type="submit" name="submit" value="submit"></input>
                <button type="button">Reset</button>
                <?php
                    if(isset($_POST)){
                        echo "<h3>Post is Set</h3>";
                    }
                ?>
            </div>
        </div>
    </form>
</div>
<div class="col-3">
    <div class="side-info">
        <h2>Info Piece 1</h2>
        <p>This is the body of info piece 1</p>
    </div>
</div>
<?php include('templates/footer.php'); ?>