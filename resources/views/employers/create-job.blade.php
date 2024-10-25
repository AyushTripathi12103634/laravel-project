<style>
    .job-details {
        padding: 20px 20px;
        margin-top: 100px;
        min-width: 500px;
    }

    .light-mode .job-details{
        background-color: #e1e1e1; /* Light mode background */
        color: black; /* Text color for light mode */
    }

    .dark-mode .job-details{
        background-color: #1e1e1e; /* Dark mode background */
        color: white; /* Text color for dark mode */
    }
</style>

<?php
$countries = array(
    "Afghanistan",
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombia",
    "Comoros",
    "Congo, Democratic Republic of the",
    "Congo, Republic of the",
    "Costa Rica",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "North Macedonia",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Timor-Leste",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
);

?>

<div class="job-details">
    <form class="d-flex flex-column" action="/create-job" method="POST">
        @csrf
        <h3 class="text-center">Job Details</h3>
        <input name="created_by" value="{{ session('id') }}" hidden required>
        <input class="form-control mb-3" name="company" type="text" placeholder="Enter Company Name" required>
        <input class="form-control mb-3" name="role" type="text" placeholder="Enter Job Role" required>
        <input class="form-control mb-3" name="location" type="text" placeholder="Enter Work Location" required>
        <input class="form-control mb-3" name="salary" type="number" placeholder="Enter Minimum Salary" required>
        <input class="form-control mb-3" name="joining_date" type="date" placeholder="Enter Joining Date" required>
        <div class="d-flex mb-3">
            <input name="lei" type="text" class="form-control" maxlength="20" minlength="20" placeholder="Legal Entity Identifier (LEI)" required>
            <select class="form-control" name="lei_issuer" required>
                <option selected disabled value="">Select Company's LEI Issuer</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex" style="height:120px;">
            <textarea class="form-control mb-3 me-5" name="required_skillset" type="text" placeholder="Enter Required Skill(Comma Seperated)" required></textarea>
            <textarea class="form-control mb-3" name="rest_of_requirements" type="text" placeholder="Enter Remaining Requirements(Comma seperated)" required></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>