<!-- JAVASCRIPT FOR POPUPS -->
<script src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/nhpup_1.1.js"></script>


<html>
<link rel="stylesheet" type="text/css" href="style.css"/>
	
<a onmouseover="nhpup.popup('Lorem ipsum dolor sit ...');" href='somewhere.html'>some text</a>
<a onmouseover="nhpup.popup('Here, a chipmunk: <br/><br/> <img src=&quot;chipmunk.png&quot;/>', {'width': 90});">a picture</a>
<a onmouseover="nhpup.popup($('#hidden-table').html(), {'width': 400);" href='somewhere.html'>a table</a>  

<div id="hidden-table" style="display:none;">
  <table border="1" width="400">
    <tr>
      <th>Name</th>
      <th>Age</th>
    </tr>
    <tr>
      <td>Hans</td>
      <td>22</td>
    </tr>
    <tr>
      <td>Gretchen</td>
      <td>22</td>
    </tr>
  </table>
</div>

<a onmouseover="nhpup.popup('click to see all administration options')" 
href="index.php">go to Admin Index </a>
	
	
	
	
	
	
	
	
</html>