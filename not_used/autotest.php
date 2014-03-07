<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
 
 <script>
 	$(function() {
         
            $('#abbrev').val("");
             
            $("#state").autocomplete({
                source: "search2.php",
                minLength: 1,
                select: function(event, ui) {
                    $('#state_id').val(ui.item.id);
                    $('#abbrev').val(ui.item.abbrev);
                }
            });
             
            $("#state_abbrev").autocomplete({
                source: "search2.php",
                minLength: 1
            });
        });

 </script>

<form action="<?php echo $PHP_SELF;?>"  method="post">
<fieldset>
<legend>jQuery UI Autocomplete Example - PHP Backend</legend>

<p>Start typing the name of a state or territory of the United States</p>

<p class="ui-widget">

<label for="state">State (abbreviation in separate field): </label>

<input type="text" id="state"  name="state" /> 

<input readonly="readonly" type="text" id="abbrev" name="abbrev" maxlength="2" size="2"/></p>

<input type="hidden" id="state_id" name="state_id" />

<p class="ui-widget">

<label for="state_abbrev">State (replaced with abbreviation): </label>

<input type="text" id="state_abbrev" name="state_abbrev" /></p>

<p><input type="submit" name="submitBtn" value="Submit" /></p>

</fieldset>
</form>

<?php
if (isset($_POST['submit'])) {
echo "<p>";
    while (list($key,$value) = each($_POST)){
    echo "<strong>" . $key . "</strong> = ".$value."<br />";
    }
echo "</p>";
}
?>
