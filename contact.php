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
    //7. Create a table in the database to store contact submissions:
        //7.1 firstName, lastName, email, phone    

?>
<?php
 /* Non-loop access to post values  
    $firstName = '';
    $lastName = '';
    $email = '';
    $phone = '';

    if(isset($_POST['submit'])){
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
    }
*/
?>
<?php
    //connection params
    $server = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "company";

    //create database connection
    $conn = new mysqli($server, $dbuser, $dbpass, $db);

    //check the mysql connection
    if($conn->connect_error){
        die("Connection failed" . $conn->connect_error);
    }

    //retrieve some sql data
    $sql = "SELECT * FROM employee";

    $result = $conn->query($sql);
    /*
        {
            0:{0:"", 1:"", 2:"", 3:""},
            1:{0:"", 1:"", 2:"", 3:""},
            2:{0:"", 1:"", 2:"", 3:""}
        }
    */
    //$result[0][3];

    /* handle retrieved result set
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo $row["id"] . "," . $row["firstName"] . ", " . $row["lastName"] . ";<br />";
        }
    }
    */
    //echo "connect success!"

    //process $POST data
    //check if the form has been submitted
    if(isset($_POST['submit'])){
        //process data into database
        //PHP always expects valid form data

        //send valid data to database
        if($_POST['first_name'] == ""){
            $stopFormSubmission = true;
        }
        if($_POST['last_name'] == ""){
            $stopFormSubmission = true;
        }

        if($_POST['last_name'].defaultValue == ""){
            $stopFormSubmission = true;
        }

        //$firstName = $_POST['first_name'];
        //$lastName = $_POST['last_name'];
        //$email = $_POST['email'];
        //$phone = $_POST['phone'];

        //build sql statement for query execution
        $sql = "INSERT INTO contacts";
        $sql .= " (firstName, lastName, email, phone)";
        $sql .= " VALUES (";

        foreach($_POST as $value) :
            if($value != 'submit') :
                $sql .= ", ". $value;
            endif;
        endforeach;

        $sql .= ")";
        echo $sql;

        //check if there is a sql error upon query execution
        //if(!$conn->query($sql)){
        //    echo $conn->error;
        //}
    }

    $conn->close();
?>
<script>
    //This is javascript
    function validate(){
        var inputs = document.getElementsByTagName('input');
        //console.log(inputs[0].name);

        //array: inputs = {0:"first_name", 1:"last_name", 2:"email", 3:"phone"}
        for(var i = 0; i < inputs.length; i++){
            if(inputs[i].name != "submit"){
                if(inputs[i].value == inputs[i].defaultValue){
                    inputs[i].classList.add("invalid");
                    return false;
                }
                else{
                    inputs[i].classList.remove("invalid");
                }
            }
        }

        return true;
    }

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

    function resetForm(){
        //document.getElementById('first_name').value = document.getElementById('first_name').defaultValue;
        //document.getElementById('last_name').value = document.getElementById('last_name').defaultValue;
        //document.getElementById('email').value = document.getElementById('email').defaultValue;
        //document.getElementById('phone').value = document.getElementById('phone').defaultValue;

        var inputs = document.getElementsByTagName('input');
        //console.log(inputs[0].name);

        //array: inputs = {0:"first_name", 1:"last_name", 2:"email", 3:"phone"}
        for(var i = 0; i < inputs.length; i++){
            if(inputs[i].name != "submit"){
                inputs[i].value = inputs[i].defaultValue;
            }
        }

//        for (var input in inputs){
//            console.log(input.id.value);
//        }

        //Problem: a bunch of manual code with statically typed code that will need to be modified
        //with each input change that occurs (adding or removing input fields)

        //make a loop and input names into loop to modify input
        //
    }
</script>

<?php include('templates/header.php'); ?>
<div class="col-2">
    <h2 id="page-title">Contact</h2>
    <form id="myForm" method="POST" onsubmit="return validate()">
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
                <button type="button" onclick="resetForm()">Reset</button>
            </div>
        </div>
        <div>
            <!--Demonstration of if and for loop
            <?php //if(isset($_POST['submit'])) : ?>
                <?php //for($i = 0; $i < 5; $i++) : ?>
                    <div><?php //echo $i; ?></div>
                <?php //endfor; ?>
            <?php  //endif; ?>
            -->
            
            <!-- $_POST{first_name=>'', last_name=>'', email=>''....};-->
            <?php //foreach($_POST as $value) : ?>
                <!--<div><?php //echo $value; ?></div>-->
            <?php //endforeach; ?>

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