<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\EmailValidator;

class Products extends \Phalcon\Mvc\Model
{

  public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'product_name',
            new Uniqueness(
                [
                    'message' => 'The Product Name must be unique',
                ]
            )
        );

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'message' => 'The Email incorrect',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=1, nullable=false)
     */
    public $Product_id;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    public $Product_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $Product_company;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    public $Product_price;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pos_db");
        $this->setSource("products");
        $this->belongsTo('product_company','Company','company_id');
        // JOIN TABLE โดย FK ที่ product_company ไปยัง TABLE Company ที่ PK company_id
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'products';
    }

  public function afterCreate(){
    $this->product_name = preg_replace('/[^0-9]/', "aaa");
    $this->createDate = date('Y-m-d H:i:s');
    $this->getDI()->getShared('Mailgun')->send([
      "name"=>"a@a.com",
      "to"=>"b@b.com",
      "cc"=>"c@c.com",
      "text"=>$this->product_name,
    ]);
  }

  public function afterValidationOnCreate(){
    $this->createDate = date('Y-m-d H:i:s');
  }

}
