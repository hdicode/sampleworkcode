<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="bold-header no-margin"><?= Yii::t('app', 'System Log') ?></h2>
			<span class="sub-header"><?= Yii::t('app', 'List of recorded system logs') ?></span>
		</div>
		<div class="col-sm-12">
			<div class="toolbar">
			</div>
			<div>
				<table class="table table-compact table-striped table-resize" id="tblSystemLog"></table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	self._accessType = '';
	self._user = '';
	self._accessFrom = '';
	self._dateFrom = '';
	self._dateTo = '';
	self._timeFrom = '';
	self._timeTo = '';
	self._from = '';
	self._to = '';
	var _officeUtc = '<?= $officeUtc ?>';
	var _accessTypeList = <?= $accessType ?>;

	$(function()
	{
		var _tableSystemLogCreated = 0;
		var _systemLogData = <?= $systemLogData ?>;

		var _tblSystemLogOptions = 
		{
			makePagination	: true,
			singleSelect	: true,
			clickToSelect	: true,
			uniqueId		: 'ID',
			toolbar			: '#toolbar',
			showRefresh		: true,
			method			: 'post',
			pagination		: true,
			sidePagination 	: 'server',
			pageNumber		: 1,
			pageSize		: 10,
			data 			: _systemLogData.data,
			totalRows 		: _systemLogData.total,
			url				: "<?= Yii::$app->getUrlManager()->createUrl('sa/system-log/search-system-log') ?>",
			columns			:  
			[
				{field : 'RNUM', align : 'left', title : '<?= Yii::t('app', 'No.') ?>', width : '2%', class: 'text-uppercase text-left'},
				{field : 'TIME', sortable: true, title : '<?= Yii::t('app', 'Time') ?>' + ' (UTC' + _officeUtc + ')', width : '25%', class: 'text-uppercase text-left'},
				{field : 'USER_ID', sortable: true, title : '<?= Yii::t('app', 'User') ?>', width : '5%', class: 'text-uppercase text-left'},
				{field : 'ACCESS_FROM', sortable: true, title : '<?= Yii::t('app', 'Access From') ?>', width : '10%', class: 'text-uppercase text-left'},
				{field : 'ACCESS_TYPE', sortable: true, title : '<?= Yii::t('app', 'Access Type') ?>', width : '30%', class: 'text-uppercase text-left'},
				{field : 'ACCESS_NOTES', sortable: true, title : '<?= Yii::t('app', 'Notes') ?>', width : '10%', class: 'text-uppercase text-left'}
			],
			
			formatNoMatches: function () 
			{
				return '<?= Yii::t('app', 'No data found') ?>';
			},
			responseHandler	: function(res) 
			{				
				$('#divTbl').show();
				res.rows = res.data;
				_accessType = $('#inputAccessType option:selected').val();
				_user = $('#inputUser').val();
				_accessFrom = $('#inputAccessFrom').val();
				_dateFrom = $('#inputDateFrom').val();
				_dateTo = $('#inputDateTo').val();
				_timeFrom = $('#inputTimePickerFrom').val();
				_timeTo = $('#inputTimePickerTo').val();
				return res;
			},
			queryParams: function(p)
			{
				if( $('#__txtGlobalSearch__').val() )
				{
					p.accessType = $('#__txtGlobalSearch__').val();
					p.searchType = 1;
				}
				else
				{					
					p.accessType = $('#searchAccessType option:selected').val();
					p.user = $('#searchUser').val();
					p.accessFrom = $('#searchFrom').val();
				}
				p.dateFrom = $('#searchDateFrom').val();
				p.dateTo = $('#searchDateTo').val();
				p.timeFrom = $('#inputTimeFrom').val();
				p.timeTo = $('#inputTimeTo').val();
												
				return p;
			},
			onLoadSuccess : function(result)
			{
				$('.selectpicker').selectpicker('refresh');
				if (result.errNum !== 0)
				{
					$.showError(result.errStr);
				}
				else
				{
					$('#_modalLayoutSearch').modal('hide');
				}
			}
		};

		generateTableSystemLog();

		makeSearchSystemLog(2);
		$('#inputTimePickerFrom').val('00:00');
		$('#inputTimePickerTo').val('23:59');
		$('#inputTimeFrom').val('00:00');
		$('#inputTimeTo').val('23:59');
		$('#searchAccessType').html('');
		$('#searchAccessType').selectpicker('destroy');
		
		$('.modal-body').mouseenter(function()
		{ 
			$('.time').keyup(function(event)
			{
				// skip for arrow keys
				if(event.which >= 37 && event.which <= 40)
				{
					return;
				}

				// format number
				$(this).val(function(index, value) 
				{
					return value.replace(/\D/g, "").replace(/\B(?=(\d{2})+(?!\d))/g, ":");
				});
			});
		}); 
		
		$('.timepicker').timepicker
		({
			timeFormat: 'HH:mm' 
		});
		
		$('.timepicker').timepicker
		({
			change: function(time) {
				// the input field
				var element = $(this), text;
				// get access to this Timepicker instance
				var timepicker = element.timepicker();
				text = 'Selected time is: ' + timepicker.format(time);
				element.siblings('span.help-line').text(text);
			}
		});
	
		$('body').on('mouseenter', function()
		{ 
			$('.timepicker').timepicker
			({
				timeFormat: 'HH:mm',
				interval: 30,
				defaultTime: '00:00',
				startTime: '00:00',
				dynamic: true
			});
		}); 

		if (_accessTypeList.length == 0)
		{
			$('#searchAccessType').prop('title', 'Access type does not exists');
		}
		else
		{
			$('#searchAccessType').prop('title', 'All access type');
			$('#searchAccessType').append('<option value="">All access type</option>');
			for (var i = 0; i < _accessTypeList.length; i++)
			{
				$('#searchAccessType').append('<option value="' + _accessTypeList[i]['ACCESSTYPE'] + '">' + _accessTypeList[i]['ACCESSTYPE'] + '</option>');
			}
		}
		
		$('#searchAccessType').selectpicker();
		$('#searchAccessType').selectpicker('val', '');
		
		$('.input-date').datetimepicker
		({
			date : new Date(),
			format : '<?= Yii::$app->params['dateFormatInput'] ?>',
			showClear : true,
			useCurrent : true,
		}).on('dp.show', function() 
		{
			$(this).data("DateTimePicker").keyBinds($.fn.datetimepicker.defaults.keyBinds);
		}).on('dp.hide', function() 
		{
			$(this).data("DateTimePicker").keyBinds
			({
				down: function (widget)
				{
					if (!widget)
					{
						this.show();
					}
				}
			});
		}).on('change dp.change',function()
		{
			$('.chk-day').each(function()
			{
				$(this).prop('disabled',false);
			});
		});

		function generateTableSystemLog()
		{
			if (_tableSystemLogCreated == 0)
			{
				_tableSystemLogCreated = 1;

				$('#tblSystemLog').bootstrapTableWrapper(_tblSystemLogOptions);
			}
			else
			{
				$('#tblSystemLog').bootstrapTable('refresh');
			}
		}
	});
	
	function makeSearchSystemLog(e)
	{
		searchMethod = e;

		$.globalSearch
		({
			searchFunction	: search,
			useDropdown		: true,
			placeholder		: '<?= Yii::t('app', 'Search system log by access type') ?>',
			dropdownHtml	: ''+
			'<div class="modal-dialog">'+
				'<div class="modal-body">'+
					'<div class="form-horizontal">'+
						'<div class="form-group">'+
							'<span for="" class="control-label col-sm-4"><?= Yii::t('app', 'User') ?></span>'+
							'<div class="col-sm-8">'+
								'<input type="text" class="form-control" id="searchUser" placeholder="<?=Yii::t('app','User')?>">'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<span for="" class="control-label col-sm-4"><?= Yii::t('app', 'Access From') ?></span>'+
							'<div class="col-sm-8">'+
								'<input type="text" class="form-control" id="searchFrom" placeholder="<?=Yii::t('app','Access From')?>">'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<span for="" class="control-label col-sm-4"><?= Yii::t('app', 'Access Type') ?></span>'+
							'<div class="col-sm-8">'+
								'<select id="searchAccessType" data-live-search="true" class="form-control"></select>'+
							'</div>'+
						'</div>'+
						'<div class="form-group required">'+
							'<span for="" class="control-label col-sm-4"><?= Yii::t('app', 'Begin Date') ?></span>'+
							'<div class="col-sm-6">'+
								'<div class="input-group date input-date" id="inputDateFrom" style="padding:0">'+
									'<input type="text" class="form-control" id="searchDateFrom" onkeypress="return dateKeypress(event)" maxlength="8">'+
									'<span class="input-group-addon">'+
										'<span class="glyphicon glyphicon-calendar"></span>'+
									'</span>'+
								'</div>'+
							'</div>'+
							'<div class="col-sm-2 time-input" style="padding-left:0">'+
								'<input type="text" class="form-control time" maxlength=5 id="inputTimeFrom" placeholder="hh:mm">'+
							'</div>'+
						'</div>'+
						'<div class="form-group required">'+
							'<span for="" class="control-label col-sm-4"><?= Yii::t('app', 'End Date') ?></span>'+
							'<div class="col-sm-6">'+
								'<div class="input-group date input-date" id="inputDateTo" style="padding:0">'+
									'<input type="text" class="form-control" id="searchDateTo" onkeypress="return dateKeypress(event)" maxlength="8">'+
									'<span class="input-group-addon">'+
										'<span class="glyphicon glyphicon-calendar"></span>'+
									'</span>'+
								'</div>'+
							'</div>'+
							'<div class="col-sm-2 time-input" style="padding-left:0">'+
								'<input type="text" class="form-control time" maxlength=5 id="inputTimeTo" placeholder="hh:mm">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			''
		});

		// onClick button reset
		$('#_btnLayoutModalReset').on('click', function()
		{
			$('#searchUser, #searchFrom').val('');
			$('#searchDateFrom, #searchDateTo').val(moment().format('YYYYMMDD'));
			$('#inputTimePickerFrom').val('00:00');
			$('#inputTimePickerTo').val('23:59');
			$('#inputTimeFrom').val('00:00');
			$('#inputTimeTo').val('23:59');
			$('#searchAccessType').selectpicker('val', '');
			$('#search').val('');
			$('.selectpicker').selectpicker('refresh');
		});

		// onClick button search
		$('#_btnLayoutModalSearch').on('click', function() 
		{
			$('#__txtGlobalSearch__').val('');
			if(validateTime())
			{
				$('#tblSystemLog').bootstrapTable('refresh');
			}
		});

		// Adding enter listener to search
		$('#search, #searchName, #searchDescr, #__txtGlobalSearch__').keypress(function(e)
		{
			if (e.which == 13)
			{
				$('#tblSystemLog').bootstrapTable('refresh');
			}
		});

		// Removing search text
		$('#_modalLayoutSearch')
		.on('show.bs.modal', function()
		{
			$('#__txtGlobalSearch__').val('');
		})
		.on('hide.bs.modal', function()
		{
			$('#search').val('');
		});
	}

	function validateTime()
	{
		clearError();

		var error = 0;
		var message = [];

		var timeFrom = $('#inputTimeFrom').val();
		var timeTo = $('#inputTimeTo').val();

		// check format timeFrom and timeTo must between 00:00 and 23:59
		var regexTime = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/

		if(!regexTime.test(timeFrom))
		{
			message['TimeFrom'] = "<?= Yii::t('app', 'Time From didn\'t match the time format') ?>";
			error++;
		}

		if(!regexTime.test(timeTo))
		{
			message['TimeTo'] = "<?= Yii::t('app', 'Time To didn\'t match the time format') ?>";
			error++;
		}

		if (error > 0)
		{
			for ( var id in message )
			{
				if ( message[id] )
				{
					$.inputError
					({
						inputId: '#input' + id,
						message: message[id]
					});
				}
				else
				{
					$.inputError
					({
						inputId: '#input' + id,
						message: ''
					});
				}
			}

			return false;
		}

		return true;
	}

	function clearError()
	{
		$('.has-error').find('.help-block').remove();
		$('.has-error').removeClass('has-error');
	}

	function search()
	{
		if (searchMethod == 1)
		{
			var temp = 'name=';

			if ($('#__txtGlobalSearch__').val())
			{
				temp += '' + $('#__txtGlobalSearch__').val() + '';
			}

			window.open('<?= Yii::$app->getUrlManager()->createUrl('sa/system-log') ?>?' + temp + '', '_blank');
		}
		else if (searchMethod == 2)
		{
			$('#tblSystemLog').bootstrapTable('refresh');
			$('#_modalLayoutSearch').modal('hide');
		}
	}
</script>