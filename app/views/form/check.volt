<div class="panel panel-primary" style="margin-top: 40px;">
	<div class="panel-heading"> เพิ่มรายการ </div>
	<div class="panel-body">
		{{ this.flashSession.output() }}
		{{ form("","class":"form-horizontal","method":"post","name":"myForm") }}
			<label class="col-md-2 control-label"> รายการ : </label>
			<div class="col-md-4">
				{{ text_field("product","class":"form-control","placeholder":"สินค้า") }}
			</div>
			<div class="col-md-2">
				{{ text_field("price","class":"form-control","placeholder":"ราคา") }}
			</div>
			<div class="col-md-2">
				{{ select("company",company,"class":"form-control","using":["company_id","company_name"]) }}
			</div>

			<div class="text-center">{{ submit_button("Send","class":"btn btn-success") }}</div>
		{{ end_form() }}

		<p class="text-center">**************************************************************</p>

		<p> ราคาทั้งหมด : {{ number_format(sumAmount,2,".",",") }} </p>
		<p> ราคาแพงสุด : {{ number_format(firstMost,2,".",",") }} </p>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="text-center"> ลำดับ </th>
					<th class="text-center"> รายการ </th>
					<th class="text-center"> ผู้ผลิต </th>
					<th class="text-center"> ราคา </th>
					<th class="text-center">  </th>
				</tr>
			</thead>
			{% for value in products %}
				<tr>
					<td align="center"> {{ value.product_id }} </td>
					<td align="center"> {{ value.product_name }} </td>
					<td align="center"> {{ value.Company.company_name }} </td>
					<td align="center"> {{ number_format(value.product_price,2,".",",") }} </td>
					<td align="center">
						<a href="edit?id={{ value.product_id }}" class="btn btn-warning btn-sm"> แก้ไข </a>
						<a href="delete?id={{ value.product_id }}" class="btn btn-danger btn-sm"> ลบ </a>
					</td>
				</tr>
			{% endfor %}
		</table>
	</div>
</div>
