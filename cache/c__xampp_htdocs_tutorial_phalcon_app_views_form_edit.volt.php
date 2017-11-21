<div class="panel panel-primary" style="margin-top: 40px;">
	<div class="panel-heading"> แก้ไขรายการ </div>
	<div class="panel-body">
<?= $this->flashSession->output() ?>
		<?= $this->tag->form(['', 'class' => 'form-horizontal', 'method' => 'post', 'name' => 'myForm']) ?>
			<label class="col-md-2 control-label"> รายการ : </label>
			<div class="col-md-4">
				<?= $this->tag->textField(['product', 'class' => 'form-control', 'placeholder' => 'สินค้า', 'value' => $product->product_name]) ?>
			</div>
			<div class="col-md-2">
				<?= $this->tag->textField(['price', 'class' => 'form-control', 'placeholder' => 'ราคา', 'value' => $product->product_price]) ?>
			</div>
			<div class="col-md-2">
				<?= $this->tag->select(['company', $company, 'class' => 'form-control', 'using' => ['company_id', 'company_name'], 'value' => $product->product_company]) ?>
			</div>

			<div class="text-center"><?= $this->tag->submitButton(['Send', 'class' => 'btn btn-success']) ?></div>
		<?= $this->tag->endForm() ?>
	</div>
</div>
