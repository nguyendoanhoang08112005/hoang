<?php
namespace App\Models;

use PDO;
use PDOException;

class BaseModel{
    protected $conn=null;
    protected $tableName=null;
    protected $primaryKey='id';
    protected $sqlBuilder=null;
    public function __construct(){
        try{
            $this->conn=new \PDO("mysql:host=localhost; dbname=php2_wd19306; charset=utf8; port=3306","root","");
        }catch(PDOException $e){
            echo "loi ket noi CSDL".$e->getMessage();
        }
    }
    public static function all(){
        $model=new static;
        $model->sqlBuilder="SELECT * FROM $model->tableName";
        $stmt=$model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    //create: them moi du lieu tu 1 bang
    //$data: du lieu mang co key va value trong do key la ten cot con value la gtri tuong ung
    public static function create($data){
        $model=new static;
        $sql="INSERT INTO $model->tableName(";
        $values=" VALUES(";
        foreach ($data as $column=>$val){
            $sql.="`$column`, ";
            $values.=":$column, ";
        }
        $sql=rtrim($sql,', ').")" . rtrim($values,', ').")";
        // dd($sql);
        $stmt=$model->conn->prepare($sql);
        $stmt->execute($data);

      
    }
    public static function delete($id){
            $model=new static;
            $sql="DELETE FROM $model->tableName WHERE $model->primaryKey=:$model->primaryKey";
            // dd($sql);
            $stmt=$model->conn->prepare($sql);
            $stmt->execute(["$model->primaryKey"=>$id]);
    }
    //update: phthuc cap nhat
    //@data: la mang du lieu dung de cap nhat co key la ten cot va value tuong ung
    //@id: la gtri cua khoa chinh
    public static function update($data,$id){
        $model=new static;
        $sql="UPDATE $model->tableName SET ";
        foreach($data as $column =>$val){
            $sql .="`$column` = :$column, ";
        }
        //loai bo dau , va chen them dieu kien
        $sql = rtrim($sql, " ,") . " WHERE $model->primaryKey = :$model->primaryKey";
        $stmt=$model->conn->prepare($sql);
        $data["$model->primaryKey"]=$id;
        return $stmt->execute($data);
    }
    //@find: phthuc lay du lieu theo id
    public static function find($id){
        $model=new static;
        $sql="SELECT *FROM $model->tableName WHERE $model->primaryKey=:$model->primaryKey";
        $stmt=$model->conn->prepare($sql);
        $stmt->execute(["$model->primaryKey"=>$id]);
        $result=$stmt->fetchAll(PDO::FETCH_CLASS);
        return $result[0]??[];
    }
    //@where: phthuc lay du lieu theo dieu kien
    //@param $column: ten cot lam dieu kien
    //@param $operator: bieu thuc dieu kien
    //@param $value:gtri
    public static function where($column,$operator,$value){
        $model=new static;
        if($model->sqlBuilder==null){
            $model->sqlBuilder="SELECT *FROM $model->tableName WHERE `$column` $operator '$value'";
        }
        else{
            $model->sqlBuilder .= " WHERE `$column` $operator '$value' "; 
        }
        return $model;
    }
    //@method get:lay du lieu
    public function get(){
        $stmt=$this->conn->prepare($this->sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    //@method first: lay ra phan tu dau tien
    public function first(){
        $stmt=$this->conn->prepare($this->sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS)[0]??[];
    }
    //method andWhere: phthuc ket hop voi WHERE them dieu kien AND
    //@param $column: ten cot lam dieu kien
    //@param $operator: bieu thuc dieu kien
    //@param $value:gtri
    public function andWhere($column,$operator,$value){
        $this->sqlBuilder .=" AND `$column` $operator '$value'";
        return $this;
    }
    //method orWhere: phthuc ket hop voi WHERE them dieu kien or
    //@param $column: ten cot lam dieu kien
    //@param $operator: bieu thuc dieu kien
    //@param $value:gtri
    public function orWhere($column,$operator,$value){
        $this->sqlBuilder .=" OR `$column` $operator '$value'";
        return $this;
    }
    //@method select: phthuc lay du lieu theo lua chon cot can lay
    public static function select($columns=['*']){
        $model=new static;
        $model->sqlBuilder="SELECT  ";
        foreach($columns as $col){
            $model->sqlBuilder .= "$col, ";

        }
        $model->sqlBuilder=rtrim($model->sqlBuilder, ", ") . " FROM $model->tableName ";
        return $model;
    }
    //@method join: phthuc de noi 2 bang
    //@param $table1: bang 1 la bang hien tai dang chon
    //@param $table2: banr 2 la bang noi
    //@param $reference: khoa ngoai
    //@param $primary: khoa chinh
    public function join($table1,$table2,$reference,$primary){
        $this->sqlBuilder .= " JOIN $table2 ON $table1.$reference = $table2.$primary ";
        // dd($this->sqlBuilder);
        return $this;
    }
}