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
            <legend><strong>Skills</strong></legend>
            <div class="row">
                <div class="col-25">
                    <label for="others"><strong>Other skills</strong></label>
                </div>
                <div class="col-75">
                    <div class="autocomplete">
                        <input type="text" id="others" name="skillsOther" placeholder="List your other skills here" onkeyup="showSuggestions(this.value)">
                        <div class="suggestion" id="suggestion"></div>
                    </div>
                    <ul id="skillList">
                        <?php
                        // Danh sách kỹ năng có thể lấy từ cơ sở dữ liệu hoặc một nguồn dữ liệu khác
                        $skills = ["Critical Thinking", "Problem Solving", "Leadership", "Adaptability", "Creativity", "Time Management"];
                        ?>
                    </ul>
                </div>
            </div>

            <script>
                function showSuggestions(inputText) {
                    const suggestionBox = document.getElementById('suggestion');
                    const skillList = <?php echo json_encode($skills); ?>;
                    let suggestions = [];

                    if (inputText.length >= 0) {
                        suggestions = skillList.filter(skill => skill.toLowerCase().startsWith(inputText.toLowerCase()));
                    }
                    suggestionBox.innerHTML = '';
                    suggestions.forEach(suggestion => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.textContent = suggestion;
                        suggestionItem.href = '#';
                        suggestionItem.addEventListener('click', function(event) {
                            event.preventDefault();
                            addSkill(suggestion);
                        });
                        suggestionBox.appendChild(suggestionItem);
                    });
                    suggestionBox.style.display = 'block';
                }

                function addSkill(skill) {
                    const skillList = document.getElementById('skillList');
                    const skillItem = document.createElement('userSkill');
                    skillItem.textContent = skill;
                    skillItem.innerHTML += ' <span class="delete" style="color: red" onclick="deleteSkill(this)">x  </span>';
                    skillList.appendChild(skillItem);
                    document.getElementById('others').value = '';
                    document.getElementById('suggestion').style.display = 'none';

                }

                function addCustomSkill() {
                    const customSkill = document.getElementById('others').value.trim();
                    if (customSkill !== '') {
                        addSkill(customSkill);
                    }
                }

                function deleteSkill(skillElement) {
                    skillElement.parentNode.remove();
                }
            </script>
        </fieldset>
        <div class="row">
            <input type="submit" value="Apply">
        </div>
    </form>
</div>

<?php include 'common/footer.inc' ?>
</body>
</html>