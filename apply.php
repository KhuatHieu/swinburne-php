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
    <style>
        .suggestion {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .suggestion a {
            padding: 10px;
            display: block;
            color: black;
            text-decoration: none;
        }

        .suggestion a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="banner3">
    <?php include 'common/header.inc' ?>
</div>

<div class="content-container">
    <?php if(isset($_SESSION["successfully"]) && $_SESSION["successfully"] === true): ?>
        <div class="notification-badge text-success">
            Apply successfully!
        </div>
        <?php unset($_SESSION["successfully"]); ?>
    <?php endif; ?>

    <h1>Job Application Form</h1>
    <form method="post" action="processEOI.php" novalidate="novalidate">
        <div class="row">
            <div class="col-25">
                <label for="jobRef">Job reference number</label>
            </div>
            <div class="col-75">
                <select id="jobRef" name="jobRefNumber" required>
                    <option value="">Select Job Code</option>
                    <option value="FE024" <?php echo isset($_SESSION["old"]['jobRefNumber']) && $_SESSION["old"]['jobRefNumber'] === 'FE024' ? 'selected' : '' ?>>FE024</option>
                    <option value="BE024" <?php echo isset($_SESSION["old"]['jobRefNumber']) && $_SESSION["old"]['jobRefNumber'] === 'BE024' ? 'selected' : '' ?>>BE024</option>
                </select>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["jobRefNumber"] ?? '' ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="firstName">First name</label>
            </div>
            <div class="col-75">
                <input type="text" id="firstName" name="firstName" required pattern="[a-zA-Z ]{1,20}"
                       value="<?php echo $_SESSION["old"]['firstName'] ?? '' ?>" title="Max 20 alpha characters"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["firstName"] ?? '' ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lastName">Last name</label>
            </div>
            <div class="col-75">
                <input type="text" id="lastName" name="lastName" required pattern="[a-zA-Z ]{1,20}"
                       value="<?php echo $_SESSION["old"]['lastName'] ?? '' ?>" title="Max 20 alpha characters"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["lastName"] ?? '' ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="dateBirth">Date of Birth</label>
            </div>
            <div class="col-75">
                <input type="date" id="dateBirth" name="dateOfBirth" required
                       value="<?php echo $_SESSION["old"]['dateOfBirth'] ?? '' ?>" title="DD/MM/YYYY between 15 and 80"/>
            </div>
        </div>

        <fieldset>
            <legend>Gender</legend>
            <div class="row">
                <div class="col-25">
                    <label for="male">Male</label>
                </div>
                <div class="col-75">
                    <input type="radio" id="male" name="gender" value="male" <?php echo ($_SESSION["old"]["gender"] ?? '') == 'male' ? 'checked' : ''; ?> required/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="female">Female</label>
                </div>
                <div class="col-75">
                    <input type="radio" id="female" name="gender" value="female" <?php echo ($_SESSION["old"]["gender"] ?? '') == 'female' ? 'checked' : ''; ?>/>
                    <p class="text-error">
                        <?php echo $_SESSION["errors"]["gender"] ?? '' ?>
                    </p>
                </div>
            </div>

        </fieldset>

        <div class="row">
            <div class="col-25">
                <label for="address">Street</label>
            </div>
            <div class="col-75">
                <input type="text" id="address" name="street" required value="<?php echo $_SESSION["old"]['street'] ?? '' ?>"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["address"] ?? '' ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="sub_town">Suburb/Town</label>
            </div>
            <div class="col-75">
                <input type="text" id="sub_town" name="suburb" required pattern="[a-zA-Z ]+" value="<?php echo $_SESSION["old"]['suburb'] ?? '' ?>"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["suburb"] ?? '' ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="state">State</label>
            </div>
            <div class="col-75">
                <select name="state" id="state" required>
                    <option value="" <?php echo ($_SESSION["old"]["state"] ?? '') == '' ? 'selected' : ''; ?>>Please Select</option>
                    <option value="VIC" <?php echo ($_SESSION["old"]["state"] ?? '') == 'VIC' ? 'selected' : ''; ?>>VIC</option>
                    <option value="NSW" <?php echo ($_SESSION["old"]["state"] ?? '') == 'NSW' ? 'selected' : ''; ?>>NSW</option>
                    <option value="QLD" <?php echo ($_SESSION["old"]["state"] ?? '') == 'QLD' ? 'selected' : ''; ?>>QLD</option>
                    <option value="NT" <?php echo ($_SESSION["old"]["state"] ?? '') == 'NT' ? 'selected' : ''; ?>>NT</option>
                    <option value="WA" <?php echo ($_SESSION["old"]["state"] ?? '') == 'WA' ? 'selected' : ''; ?>>WA</option>
                    <option value="SA" <?php echo ($_SESSION["old"]["state"] ?? '') == 'SA' ? 'selected' : ''; ?>>SA</option>
                    <option value="TAS" <?php echo ($_SESSION["old"]["state"] ?? '') == 'TAS' ? 'selected' : ''; ?>>TAS</option>
                    <option value="ACT" <?php echo ($_SESSION["old"]["state"] ?? '') == 'ACT' ? 'selected' : ''; ?>>ACT</option>
                </select>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["state"] ?? '' ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="postcode">Postcode</label>
            </div>
            <div class="col-75">
                <input type="text" id="postcode" name="postcode" required pattern="\d{4}" value="<?php echo $_SESSION["old"]['postcode'] ?? '' ?>"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["postcode"] ?? '' ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="myEmail">Email</label>
            </div>
            <div class="col-75">
                <input type="email" id="myEmail" name="email" placeholder="name@domain.com" required value="<?php echo $_SESSION["old"]['email'] ?? '' ?>"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["email"] ?? '' ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="phoneNumber">Phone Number</label>
            </div>
            <div class="col-75">
                <input type="text" id="phoneNumber" name="phoneNumber" required pattern="[0-9 ]{8,12}" value="<?php echo $_SESSION["old"]['phoneNumber'] ?? '' ?>"/>
                <p class="text-error">
                    <?php echo $_SESSION["errors"]["phoneNumber"] ?? '' ?>
                </p>
            </div>
        </div>

        <fieldset>
            <legend><strong>Skills</strong></legend>
            <div class="row">
                <div class="col-25">
                    <label for="criticalThinking"><strong>Critical Thinking</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="criticalThinking" name="skillsCriticalThinking" <?php echo isset($_SESSION["old"]['skillsCriticalThinking']) && $_SESSION["old"]['skillsCriticalThinking'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="problemSolving"><strong>Problem Solving</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="problemSolving" name="skillsProblemSolving" <?php echo isset($_SESSION["old"]['skillsProblemSolving']) && $_SESSION["old"]['skillsProblemSolving'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="leadership"><strong>Leadership</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="leadership" name="skillsLeadership" <?php echo isset($_SESSION["old"]['skillsLeadership']) && $_SESSION["old"]['skillsLeadership'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="adaptability"><strong>Adaptability</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="adaptability" name="skillsAdaptability" <?php echo isset($_SESSION["old"]['skillsAdaptability']) && $_SESSION["old"]['skillsAdaptability'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="creativity"><strong>Creativity</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="creativity" name="skillsCreativity" <?php echo isset($_SESSION["old"]['skillsCreativity']) && $_SESSION["old"]['skillsCreativity'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="timeManagement"><strong>Time Management</strong></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="timeManagement" name="skillsTimeManagement" <?php echo isset($_SESSION["old"]['skillsTimeManagement']) && $_SESSION["old"]['skillsTimeManagement'] ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="others"><strong>Other skills</strong></label>
                </div>
                <div class="col-75">
                    <input type="text" id="others" name="skillsOther" placeholder="List your other skills here" value="<?php echo $_SESSION["old"]['skillsOther'] ?? '' ?>"/>
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