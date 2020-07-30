<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php 
echo link_tag('assets/css/style.css');
?>

</head>
<body>
 <table width="100%" cellpadding="0" cellspacing="0" class="list">
        <tbody><tr><td valign="top" class="headerWrapper">
    <h5>
        
        <a href="#">Log out</a>
    </h5>

</td></tr>
        <tr><td valign="top" class="menuWrapper"></td></tr>
        
        <tr><td valign="top" class="paginatorWrapper"></td></tr>
        <tr><td valign="top" class="contentWrapper">
  <title>Choose Section to Use</title> 
  <ul>
      <li>
          
          <a href="/framesView.action">Search</a>
      </li>
      <li>
          
          <a href="<?php echo base_url('adminShowAllFrames.action'); ?>">Inventory Management</a>
      </li>
  </ul>

  
</td></tr>
        <tr><td valign="top" class="paginatorWrapper"></td></tr>
        <tr><td valign="top" class="footerWrapper"></td></tr>
    </tbody></table>
</body>
</html>