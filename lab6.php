<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>
<body>

<?php
// function to calculate converted temperature
function convertTemp($temp, $unit1, $unit2)
{
    // conversion formulas
    // Celsius to Fahrenheit = T(°C) × 9/5 + 32
    // Celsius to Kelvin = T(°C) + 273.15
    // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
    // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
    // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
    // Kelvin to Celsius = T(K) - 273.15
    switch ($unit1) {
        case 'celsius':
            if ($unit2 == 'farenheit') { // Celsius to Fahrenheit
                $newtemp = $temp * 1.8 + 32;
                return $newtemp;
            } else if ($unit2 == 'kelvin') { // Celsius to Kelvin
                $newtemp = $temp + 273.15;
                return $newtemp;
            }
            break;
        case 'farenheit':
            if ($unit2 == 'celsius') { // Fahrenheit to Celsius
                $newtemp = ($temp - 32) * 0.5555556;
                return $newtemp;
            } else if ($unit2 == 'kelvin') { // Fahrenheit to Kelvin
                $newtemp = ($temp + 459.67) * 0.5555556;
                return $newtemp;
            }
            break;
        case 'kelvin':
            if ($unit2 == 'farenheit') { // Kelvin to Fahrenheit
                $newtemp = $temp * 1.8 - 459.67;
                return $newtemp;
            } else if ($unit2 == 'celsius') { // Kelvin to Celsius
                $newtemp = $temp - 273.15;
                return $newtemp;
            }
            break;
    }

    // You need to develop the logic to convert the temperature based on the selections and input made
    if ($unit1 == $unit2) {
        return $temp;
    }
} // end function

// Logic to check for POST and grab data from $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the original temp and units in variables
    // You can then use these variables to help you make the form sticky
    // then call the convertTemp() function
    // Once you have the converted temperature you can place PHP within the converttemp field using PHP
    // I coded the sticky code for the originaltemp field for you

    $originalTemperature = $_POST['originaltemp'];
    $originalUnit = $_POST['originalunit'];
    $conversionUnit = $_POST['conversionunit'];
    if (empty($originalTemperature)) {
        echo "<h2>Please enter a numeric value for the temperature.</h2>";
    }
    if ($originalUnit != '--Select--' && $conversionUnit != '--Select--') {
        if (!empty($originalTemperature)) {
            $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
        }
    } else {
        echo "<h2>Please select a temperature unit, you true loon.</h2>";
    }

} else {
    // Checks if select tag variables have a value with GET
    // Fixes sticky form issue for select tags
    if (isset($_POST['originalunit'])) {
        $originalUnit = $_POST['originalunit'];
    } else {
        $originalUnit = "";
    }

    if (isset($_POST['conversionunit'])) {
        $conversionUnit = $_POST['conversionunit'];
    } else {
        $conversionUnit = "";
    }

} // end if/else

?>
<!-- Form starts here -->
<h1>Temperature Converter</h1>
<h4>CTEC 127 - PHP with SQL 1</h4>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="group">
        <label for="temp">Temperature</label>
        <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
            echo $_POST['originaltemp'];
        } ?>" name="originaltemp" size="14" maxlength="7" id="temp">

        <select name="originalunit">
            <option value="--Select--"<?php if($originalUnit == '--Select--') echo ' selected = "selected"';?>>--Select--</option>
            <option value="celsius"<?php if($originalUnit == 'celsius') echo ' selected = "selected"';?>>Celsius</option>
            <option value="farenheit"<?php if($originalUnit == 'farenheit') echo ' selected = "selected"';?>>Farenheit</option>
            <option value="kelvin"<?php if($originalUnit == 'kelvin') echo ' selected = "selected"';?>>Kelvin</option>
        </select>
    </div>

    <div class="group">
        <label for="convertedtemp">Converted Temperature</label>
        <input type="text" value="<?php if (isset($convertedTemp)) {
            echo $convertedTemp;
        } ?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>

        <select name="conversionunit">
            <option value="--Select--"<?php if($conversionUnit == '--Select--') echo ' selected = "selected"';?>>--Select--</option>
            <option value="celsius"<?php if($conversionUnit == 'celsius') echo ' selected = "selected"';?>>Celsius</option>
            <option value="farenheit"<?php if($conversionUnit == 'farenheit') echo ' selected = "selected"';?>>Farenheit</option>
            <option value="kelvin"<?php if($conversionUnit == 'kelvin') echo ' selected = "selected"';?>>Kelvin</option>
        </select>
    </div>
    <input type="submit" value="Convert"/>
</form>
</body>
</html>