<div class="panel panel-primary" style="margin-top: 40px;">
	<div class="panel-heading"> แก้ไขรายการ </div>
	<div class="panel-body">
{{ this.flashSession.output() }}
		{{ form("","class":"form-horizontal","method":"post","name":"myForm") }}
			<label class="col-md-2 control-label"> รายการ : </label>
			<div class="col-md-4">
				{{ text_field("product","class":"form-control","placeholder":"สินค้า","value":product.product_name) }}
			</div>
			<div class="col-md-2">
				{{ text_field("price","class":"form-control","placeholder":"ราคา","value":product.product_price) }}
			</div>
			<div class="col-md-2">
				{{ select("company",company,"class":"form-control","using":["company_id","company_name"],"value":product.product_company) }}
			</div>

			<div class="text-center">{{ submit_button("Send","class":"btn btn-success") }}</div>
		{{ end_form() }}
	</div>
</div>
