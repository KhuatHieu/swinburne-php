<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Assignment Part 1">
    <meta name="keywords" content="HTML Markup, HitechCore Co.">
    <meta name="author" content="Le Hoang Minh and Nguyen Minh Hieu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" href="pages/styles/style.css">
</head>
<body>

<div class="banner3">
    <?php include 'common/header.inc' ?>
</div>

<div class="container">
    <h1>Job Application Form</h1>
    <form method="post" action="processEOI.php">
        <div class="row">
            <div class="col-25">
                <label for="jobRef">Job reference number</label>
            </div>
            <div class="col-75">
                <input type="text" id="jobRef" name="jobRefNumber" required pattern="[a-zA-Z0-9]{5}"
                       title="Exactly 5 alphanumeric characters"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="firstName">First name</label>
            </div>
            <div class="col-75">
                <input type="text" id="firstName" name="firstName" required pattern="[a-zA-Z ]{1,20}"
                       title="Max 20 alpha characters"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lastName">Last name</label>
            </div>
            <div class="col-75">
                <input type="text" id="lastName" name="lastName" required pattern="[a-zA-Z ]{1,20}"
                       title="Max 20 alpha characters"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="dateBirth">Date of Birth</label>
            </div>
            <div class="col-75">
                <input type="date" id="dateBirth" name="dateOfBirth" required
                       title="DD/MM/YYYY between 15 and 80"/>
            </div>
        </div>
        <fieldset>
            <legend>Gender</legend>
            <div class="row">
                <div class="col-25">
                    <label for="male">Male</label>
                </div>
                <div class="col-75">
                    <input type="radio" id="male" name="gender" value="male" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="female">Female</label>
                </div>
                <div class="col-75">
                    <input type="radio" id="female" name="gender" value="female"/>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-25">
                <label for="address">Street</label>
            </div>
            <div class="col-75">
                <input type="text" id="address" name="street" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="sub_town">Suburb/Town</label>
            </div>
            <div class="col-75">
                <input type="text" id="sub_town" name="suburb" required pattern="[a-zA-Z ]+"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="state">State</label>
            </div>
            <div class="col-75">
                <select name="state" id="state" required>
                    <option value="" selected="selected">Please Select</option>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="postcode">Postcode</label>
            </div>
            <div class="col-75">
                <input type="text" id="postcode" name="postcode" required pattern="\d{4}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="myEmail">Email</label>
            </div>
            <div class="col-75">
                <input type="email" id="myEmail" name="email" placeholder="name@domain.com" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="phoneNumber">Phone Number</label>
            </div>
            <div class="col-75">
                <input type="text" id="phoneNumber" name="phoneNumber" required pattern="[0-9 ]{8,12}"/>
            </div>
        </div>
        <fieldset>
            <legend>Skills</legend>
            <div class="row">
                <div class="col-25">
                    <label for="critical">Critical Thinking</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="critical" name="skillsCriticalThinking" value="Critical Thinking"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="solving">Problem solving</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="solving" name="skillsProblemSolving" value="Problem Solving"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="leadership">Leadership</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="leadership" name="skillsLeadership" value="Leadership"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="adaptability">Adaptability</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="adaptability" name="skillsAdaptability" value="Adaptability"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="creativity">Creativity</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="creativity" name="skillsCreativity" value="Creativity"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="timeManage">Time Management</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="timeManage" name="skillsTimeManagement" value="Time Management"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="others">Other skills</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="others" name="skillsOther"/>
                    <textarea
                            id="otherskill"
                            name="skillsOther"
                            placeholder="List your other skills here"
                            rows="5"
                            cols="30"
                    ></textarea>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <input type="submit" value="Apply">
        </div>
    </form>
</div>

<?php include 'common/footer.inc' ?>
</body>
</html>