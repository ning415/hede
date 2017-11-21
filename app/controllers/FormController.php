<?php

class FormController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function checkAction(){
    	$data = Products::find(["order"=>"product_name ASC"]); //ค้นหาทั้งหมดตามเงื่อนไข
    	$company = Company::find(["order"=>"company_name asc"]); //รายการ COMPANY
    	$firstMost = Products::maximum(["column"=>"product_price"]); // แสดงรายการที่มากที่สุดอันดับแรก
    	$amount = Products::sum(["column"=>"product_price"]); //แสดงผลรวมที่ ฟิล
    	// $maximum = Products::maximum(["column"=>"product_price"]); //แสดงผลรวมที่ ฟิล

    	$this->view->setVars([ // ทำการส่งค่าให้ VIEW
    		'products' => $data, // กำหนดตัวแปรที่ VIEW จะไปใช้
			'company' => $company,
			'firstMost' => $firstMost,
			'sumAmount' => $amount,
    	]);

    	if($this->request->isPost()){ // ตรวจสอบการส่งค่า POST
    		$product = $this->request->getPost('product'); // รับค่า
    		$price = $this->request->getPost('price'); // รับค่า
    		$companys = $this->request->getPost('companys'); // รับค่า

    		$dataSQL = new Products(); // เชื่อมต่อ ตาราง
    		$dataSQL->product_name = $product; // กำหนดค่าในฟิล
    		$dataSQL->product_price = $price; // กำหนดค่าในฟิล
    		$dataSQL->product_company = $companys;

    		if($dataSQL->save() == false){ // ถ้าบันทึกไม่สำเร็จ
    			foreach($dataSQL->getMessages() as $message){
    				echo $message; // แสดง ERROR
    			}
    		}else{
    			$this->flashSession->success('เพิ่มรายการสำเร็จ');
    			// แสดงว่าสำเร็จ
    		}

    		$this->response->redirect('form/check'); //เปลี่ยนหน้า

    	}
    }

    public function editAction(){ //แก้ไขรายการ
      $id = $this->request->get('id');
      $product = Products::findFirst(["conditions"=>"product_id=?1","bind"=>[1=>$id]]);
      $companies = Company::find(["order"=>"company_name ASC"]);

      $this->view->setVars([ //ส่งค่าตัวแปรให้ view
        'product' => $product,
        'company' => $companies
      ]);

      if($this->request->isPost()){ // ตรวจสอบว่ามีการ post ค่ามาหรือไม่
        $product->product_name = $this->request->getPost('product');
        $product->product_price = $this->request->getPost('price');
        $product->product_company = $this->request->getPost('company');

        if($product->save() == false){ // ตรวจสอบวา่บันทึกค่าผ่านไหม
          foreach($product->getMessages() as $message){ // รับค่า error ที่เกิดขึ้น
            // echo $message;
            $this->flashSession->error($message); // แสดง error ให้ view
          }
        }else{
          $this->flashSession->success("บันทึกสำเร็จ"); // แสดง error ให้ view
          // $this->response->redirect('form/check'); // เปลี่ยนเส้นทาง
        }
      }
    }

    public function deleteAction(){ //ลบรายการ
      $id = $this->request->get('id');
      $product = Products::findFirst(["conditions"=>"product_id=?1","bind"=>[1=>$id]]);

      if($product->delete() == false){ // ตรวจสอบวา่ลบผ่านไหม
        foreach($product->getMessages() as $message){ // รับค่า error ที่เกิดขึ้น
          // echo $message;
          $this->flashSession->error($message); // แสดง error ให้ view
        }
      }else{
        $this->flashSession->warning("ลบสำเร็จ"); // แสดง error ให้ view
        $this->response->redirect('form/check'); // เปลี่ยนเส้นทาง
      }
    }
}
