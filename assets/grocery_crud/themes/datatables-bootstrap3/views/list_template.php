<?php
//super-lazy workaround for "ajax_list issue with this theme"
if ($success_message !== null) {
	echo  "<script> var loc = location.href + '/../..'; location.replace(loc.replace('/index', ''));</script>";
}

$this->set_css($this->default_theme_path . '/datatables-bootstrap3/css/datatables.css?v=0.31');



if ($dialog_forms) {
}

$this->set_js_lib($this->default_javascript_path . '/common/list.js');

$this->set_js($this->default_theme_path . '/datatables-bootstrap3/js/datatables.js?v=0.4.15');
//$this->set_js($this->default_theme_path.'/datatables-bootstrap3/js/dataTables.responsive.min.js');
//$this->set_js($this->default_theme_path.'/datatables-bootstrap3/js/dataTables.searchPanes.min.js');

?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url(); ?>';
	var subject = '<?php echo addslashes($subject); ?>';

	var unique_hash = '<?php echo $unique_hash; ?>';

	var displaying_paging_string = "<?php echo str_replace(array('{start}', '{end}', '{results}'), array('_START_', '_END_', '_TOTAL_'), $this->l('list_displaying')); ?>";
	var filtered_from_string = "<?php echo str_replace('{total_results}', '_MAX_', $this->l('list_filtered_from')); ?>";
	var show_entries_string = "<?php echo str_replace('{paging}', '_MENU_', $this->l('list_show_entries')); ?>";
	var search_string = "<?php echo $this->l('list_search'); ?>";
	var list_no_items = "<?php echo $this->l('list_no_items'); ?>";
	var list_zero_entries = "<?php echo $this->l('list_zero_entries'); ?>";

	var list_loading = "<?php echo $this->l('list_loading'); ?>";

	var paging_first = "<?php echo $this->l('list_paging_first'); ?>";
	var paging_previous = "<?php echo $this->l('list_paging_previous'); ?>";
	var paging_next = "<?php echo $this->l('list_paging_next'); ?>";
	var paging_last = "<?php echo $this->l('list_paging_last'); ?>";

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";

	var default_per_page = <?php echo $default_per_page; ?>;

	var unset_export = <?php echo ($unset_export ? 'true' : 'false'); ?>;
	var unset_print = <?php echo ($unset_print ? 'true' : 'false'); ?>;

	var export_text = '<?php echo $this->l('list_export'); ?>';
	var print_text = '<?php echo $this->l('list_print'); ?>';
	var export_url = '<?php echo $export_url; ?>'
	var list_delete = '<?php echo $this->l('list_delete'); ?>';
	var list_cancel = '<?php echo $this->l('form_cancel'); ?>';
	//bootbox.setLocale(moment.locale(navigator.language));
	function ciBsOnHandler(el) {
		console.log($(el).closest('tr').attr('id'))
	};

	function ciBsOffHandler(el) {
		console.log($(el).closest('tr').attr('id'))
	};
	<?php
	//A work around for method order_by that doesn't work correctly on datatables theme
	//@todo remove PHP logic from the view to the basic library
	$ordering = 0;
	$sorting = 'asc';
	if (!empty($order_by)) {
		foreach ($columns as $num => $column) {
			if ($column->field_name == $order_by[0]) {
				$ordering = $num;
				$sorting = isset($order_by[1]) && $order_by[1] == 'asc' || $order_by[1] == 'desc' ? $order_by[1] : $sorting;
			}
		}
	}
	?>

	var datatables_aaSorting = [
		[<?php echo $ordering; ?>, "<?php echo $sorting; ?>"]
	];
</script>
<div class="grocerycrud-container card">
	<div class="card-header" <?php echo $unset_add ? 'hidden' : ''; ?>>
		<?php if (!$unset_add) { ?>
			<a role="button" class="btn btn-default" href="<?php echo $add_url ?>">
				<i class="fa fa-plus"></i>
				<?php echo $this->l('list_add'); ?> <?php echo $subject ?>
			</a>
		<?php } ?>
	</div>
	<div class="dataTablesContainer dt-bootstrap4">
		<div id='list-report-error' class='report-div error report-list'></div>
		<div id='list-report-success' class='report-div success report-list' <?php if ($success_message !== null) { ?>style="display:block" <?php } ?>>
			<?php if ($success_message !== null) { ?>
				<p><?php echo $success_message; ?></p>
			<?php } ?>
		</div>
		<?php echo $list_view ?>
	</div>
</div>