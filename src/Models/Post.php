<?php


namespace App\Models;

use App\Config\Database\DatabaseHandle;
use App\Config\Database\PDODriver;

class Post
{

    public $id;
    public $title;
    public $body;
    public $category_id;
    public $created_at;

    /**
     * @var \PDO
     */
    private static $conn = null;
    private static $tableName = 'posts';
    private $primaryKey = 'id';

    public function __construct()
    {
        self::stablishConnection();
    }

    /**
     * @param mixed $table
     */
    public function setTable($table = '')
    {
        $names = explode('\\', __CLASS__);
        $this->table = strtolower(array_pop($names) . 's');
    }

    public static function getAll()
    {
        self::stablishConnection();
        $query = 'SELECT * FROM ' . self::$tableName;
        $sttm = self::$conn->prepare($query);
        $sttm->execute();
        $result = $sttm->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
        return $result;
    }

    public function find($id)
    {
        $query = 'SELECT * FROM ' . self::$tableName . ' Where id = ' . $id ;
        $sttm = self::$conn->prepare($query);
        $sttm->execute();
        $result = $sttm->fetchObject(get_called_class());

        return $result;
    }

    public function store()
    {
        $query = 'INSERT INTO ' . self::$tableName . '
         SET 
         id = :id , 
         title = :title , body = :body , category_id = :category_id
        ';

        $sttm = self::$conn->prepare($query);
        $this->id  = htmlspecialchars(strip_tags($this->id));
        $this->title  = htmlspecialchars(strip_tags($this->title));
        $this->body  = htmlspecialchars(strip_tags($this->body));

        $sttm->bindParam(':id' , $this->id);
        $sttm->bindParam(':title' , $this->title);
        $sttm->bindParam(':body' , $this->body);
        $sttm->bindParam(':category_id' , $this->category_id);

        return $sttm->execute();

    }

    public static function stablishConnection()
    {
        if (!self::$conn) {
            $conn = DatabaseHandle::factory(new PDODriver());
            self::$conn = $conn;
        }
    }

}