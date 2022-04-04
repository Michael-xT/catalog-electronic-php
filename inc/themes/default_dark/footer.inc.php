<?php


$end = microtime(true);
$creationtime = round(($end - $start), 4);

?>
<?php if(User::isLogged()) { ?>
</div></div></div></div>
<br>
<div class="" style="bottom: 0px; position: absolute; right: 0px; margin-right: 4px"><? echo 'Randata in '.$creationtime.' secunde.';?><strong>Made with <i class="icon-coffee"></i> and <i class="icon-heart"></i> by <a href="https://github.com/Michael-xT/Catalog-Liceu"><i class="icon-user"></i></a></strong></small></div>


<script  src="<?php echo Config::$_PAGE_URL; ?>assets/js/bootstrap.min.js" ></script>
	<script  src="<?php echo Config::$_PAGE_URL; ?>assets/js/ace.min.js" ></script>
</div>
</body></html>

<?php
}
ob_flush();
?>