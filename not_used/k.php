<?

include 'config/config.php';
include 'config/connect.php';
?>
<body>
<div id="div"></div>
</body>

<script>
div = document.getElementById('div');
 
a = document.createElement('a');
a.innerText = 'click me';
a.textContent = 'click me';
a.href = 'http://google.com';
a.setAttribute('className', 'more_right');
 
div.appendChild(a);

</script>