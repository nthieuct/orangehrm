<?php 
$rootPath = realpath(dirname(__FILE__)."/../../../../");

if (@include_once $rootPath."/lib/confs/sysConf.php") {
    $conf = new sysConf();
    $version = $conf->getVersion();
}
$prodName = 'OrangeHRM';
$copyrightYear = date('Y');

?>
<?php echo $prodName . ' ' . $version;?><br/><br/>
&copy; 2020 - <?php echo $copyrightYear;?> <a href="http://camau.vnpt.vn/" target="_blank">VNPT Cà Mau</a>
