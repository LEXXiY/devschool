<?php
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    header("Content-Type: text/html; charset=utf-8");
    $project_root = __DIR__;
    require_once ("oop.php");                                   // подключаем функциями
    require_once ("connect_mysql.php");                         // подключаем соединение с mysql
    require_once ("settings.php");                              // подключаем настройки smarty
    
    
    if (isset($_POST['confirm_add'])){                          // если нажата кнопка добавить/сохранить
        if (is_numeric($_POST['id_r'])){                        // если присутствует метка id_r то сохраняем редактируемое объявление
            $sql->editAd($db, new ad($_POST));
        }
        else { 
           $collection->insertAdd($_POST);
           $sql->addAd($db, new ad($_POST));                                 // иначе добавляем новое объявление
        }
    $display->restart();
    }
    
    elseif (isset($_POST['clear_form'])||isset($_GET['back'])){  // кнопки очистить форму и назад вызывают restart();
        $display->restart();
    }
    
    elseif (isset ($_POST['clear_base'])) {                     // по кнопке очистить базу, удаляем все строки из таблицы ads
        $sql->clearDB($db);
        $display->restart();
    }
    
    elseif (isset($_GET['del_ad'])){                        // ловим ключ del_ad в массиве $_GET - нажата ссылка Удалить
        if ($sql->getAd($db, (int)($_GET['del_ad']))){             // если существует объявление с таким ключом удаляем его
            $collection->delAdd((int)($_GET['del_ad']));
            $sql->delAd($db, (int)($_GET['del_ad']));
            $display->restart();
        }
        else{                                               // иначе выводим ошибку
            $display->error();   
        }
    }
    
    elseif (isset($_GET['click_id'])){                      // действие по клику на объявление
        if ($collection->getAdd((int)($_GET['click_id']))){           // если объявление с запрашиваемым номером существует
            $display->displayForm($db, $smarty, $sql, $collection, (int)($_GET['click_id']));          // выводим объявление в форму
        }
        else {                                              // иначе выводим сообщение о его отсутствии
            $display->error();
        }
    }
    
    else{
        $display->displayForm($db, $smarty, $sql, $collection);
    }
?>