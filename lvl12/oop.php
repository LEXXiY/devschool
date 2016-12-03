<?php
class mydb { //класс сингтон для работы с базой данных
    private $db;
    private $config;
    private static $instance = NULL;
    
    public static function getInstance(){
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
        
    }
    
    private function __construct(){}
    
    public function getDb(){
        return $this->db;
    }
    
    public function setConfig($link){
        $this->config = $link;
        $this->db = DbSimple_Generic::connect($this->config);
    }
}

class ad{                                                   // класс для хранения данных об объявлении
    protected $id;

    protected $allow_mail;
    protected $private;
    protected $seller_name;
    protected $email;
    protected $phone;
    protected $city_id;
    protected $category_id;
    protected $title;
    protected $description;
    protected $price;

    protected $id_r;
    
    function __construct($ad) {
        if (isset($ad['id'])){
            $this->id = $ad['id'];
        }
        $this->private = $ad['private'];
        $this->seller_name = $ad['seller_name'];
        $this->email = $ad['email'];
        if (isset($ad['allow_mail'])){
            $this->allow_mail = $ad['allow_mail'];
        }
        $this->phone = $ad['phone'];
        $this->city_id = $ad['city_id'];
        $this->category_id = $ad['category_id'];
        $this->title = $ad['title'];
        $this->description = $ad['description'];
        $this->price = $ad['price'];
        if (isset($ad['id_r'])){
            $this->id_r = $ad['id_r'];
        }
    }
    
    public function getArray(){
        if (!isset($this->allow_mail)){     $this->allow_mail=0;    }
        return array('private'=>$this->private, 'seller_name'=>$this->seller_name, 'email'=>$this->email,
            'allow_mail'=>$this->allow_mail, 'phone'=>$this->phone, 'city_id'=>$this->city_id, 
            'category_id'=>$this->category_id, 'title'=>$this->title, 'description'=>$this->description, 'price'=>$this->price);
    }

    public function getId(){
        return $this->id;
    }
    public function getPrivate(){
        return $this->private;
    }

    public function getSellerName(){
        return $this->seller_name;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getAllowMail(){
        return $this->allow_mail;
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function getCityId(){
        return $this->city_id;
    }
    
    public function getCategoryId(){
        return $this->category_id;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getPrice(){
        return $this->price;
    }

    public function getId_r(){
        return $this->id_r;
    }
}

class adDisplay{                                                       // класс ответственный за вывод данных на экран
    
    function displayForm($db, $smarty, $sql, $collection, $display_id = NULL){       // функция вывода формы
        if ($display_id) {
            $ad = $collection->getAdd($display_id);
        }
        else{
            $ad = NULL;
        }
        $smarty->assign('display', new ad($ad));
        $smarty->assign('ads', $collection->getAdds());
        $smarty->assign('cities', $sql->getCities($db));
        $smarty->assign('categories', $sql->getCategories($db));
        $smarty->display('form_ad.tpl');
    }
    
    function restart(){                                                 // функция перезапуска скрипта
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }
    
    function error(){                                                   // вывод ошибки
        echo "<h1 style='color:red' align='center'> НЕТ ТАКОГО ОБЪЯВЛЕНИЯ!<br> <a href='$_SERVER[SCRIPT_NAME]?back=''>НАЗАД</a>";
        exit();
    }
    
}

class adCollection {
    private $ads = array();
    private static $instance = NULL;
    
    public static function getInstance(){
        if (self::$instance == NULL) {
            self::$instance = new self();
        } 
        return self::$instance;
        
    }
    
    public function insertAdd($ad){
        $this->ads[] = $ad;
    }
    
    public function getAdd($id){
        return $this->ads[$id];
    }
    
    public function getAdds(){
        return $this->ads;
    }
    
    public function delAdd($del_id){
        unset($ads[$del_id]);
    }
}

class adSql{                                                            // класс ответственный за взаимодействие с базой данных

    private $db;

    function __construct($db){
        $this->db = $db;
    }
    
    function addAd($db, ad $ad){                                       // функция добавления объявления в БД
        $db->query('INSERT INTO ads(?#) VALUES(?a)', array_keys($ad->getArray()), array_values($ad->getArray()));
    }
    
    function editAd($db, ad $ad){                                      // функция редактирования объявления
        $db->query('UPDATE ads SET ?a WHERE id=?d', $ad->getArray(), $ad->getId_r());
    }
    
    function getAd($db, $id){                                              // возвращает объявление из базы по id
         return $db->selectRow('SELECT * FROM `ads` WHERE id=?d', $id);
    }
    
    function delAd($db, $id){                                              // удаляет объявление из базы по id
        $db->query('DELETE FROM `ads` WHERE id=?d', $id);
    }
    
    function getAds($db){                                                  // возвращает все объявления из базы
        $ads = $db->select('SELECT *, id AS ARRAY_KEY FROM `ads`');
        $ads_array = array();
        $adCollection = adCollection::getInstance();
        foreach ($ads as $value){
            $adCollection->insertAdd(new ad($value));
        }
    }
     
    function getCities($db){                                                // возвращает список городов для селектора
        $cities_query = $db->select('SELECT id AS ARRAY_KEY,city FROM `cities`');
        foreach ($cities_query as $key=>$value) {                                   // приводим массив к соответствующему виду
            $cities[$key] = $value['city'];                                         // для селектора smarty
        }    
        return $cities;
    } 
    
    function getCategories($db){                                            // возвращает список категорий для селектора
        $categories_query = $db->select('SELECT id AS ARRAY_KEY, category, parent_id AS PARENT_KEY FROM categories');
        foreach ($categories_query as $key=>$value) {                                                   // приводим массив к соответствующему виду
            if (!$key){ $categories[$key] = $value['category']; }                                       // для селектора smarty
            foreach ($value['childNodes'] as $k=>$v) {
                $categories[$value['category']][$k] = $v['category'];
            }
        }
        return $categories;
    } 
    
    function clearDB($db){                                              // очищает базу данных
        $db->query("delete from `ads` where 1");
    }
    
}