alert("I am an alert box!");
  // FIND FISH FUNCTION //
  // 1
  $(function() {
    var availableTags = <?php print $fancy	// THIS IS OUR ARRAY // ?>;
    
    $( "#findfish1" ).autocomplete({
      source: availableTags
    });
  });

  // FIND FISH FUNCTION //
  // 2
  $(function() {
    var availableTags = <?php print $fancy	// THIS IS OUR ARRAY // ?>;
    
    $( "#findfish2" ).autocomplete({
      source: availableTags
    });
  });
