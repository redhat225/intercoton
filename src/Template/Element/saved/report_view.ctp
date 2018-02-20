	
	<!-- <div class="report_item" ng-repeat="item in report.report_content"> -->
				<!-- Show images -->
				<h1 class="title has-text-weight-bold item_report is-4 is-pad-top-10" style="border-top:1px dotted green;">Section Raport</h1>
				<h3 class="subtitle has-text-weight-semibold">Prises de vue</h3>
				<div class="level">
					<div class="level-left">
						<div class="level-item" ng-repeat="(key,value) in item.evidences">
							<img ng-src="{{value}}" class="img-group-{{$parent.$index}} hover" alt="" colorboxable="{height:'75%', width:'75%', opacity:0.7, rel:'img-group-{{$parent.$index}}',slideshow:false, open:false}" width="180px">
						</div>
					</div>
				</div>
				<div ng-repeat='(key,value) in item.contents'>
							<h3 class="subtitle"></h3>
							<div class="field is-horizontal">
								<div class="field-label">
									<label for="" class="label" ng-bind="check_element(key)"></label>
								</div>

								<div class="field-body">
									<div class="field">
										<div class="control">
											<textarea  ui-tinymce="tinymceOptions"  ng-model="item.contents[key]" class="textarea mceNonEditable"></textarea>
										</div>
									</div>
								</div>
							</div>
			 	</div> 
	  <!-- </div> -->