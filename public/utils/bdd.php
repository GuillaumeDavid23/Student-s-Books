<?php 
//Inclusion du fichier config
require_once(dirname(__FILE__).'/../config/config.php');

//Déclaration de la classe
class SPDO
{

    private static $instance = null;
    //DISTANT LAMANU
    // const DEFAULT_SQL_USER = 'c219davidg';
    // const DEFAULT_SQL_HOST = 'localhost';
    // const DEFAULT_SQL_PASS = 'Ua6r5pDDPE!om';
    // const DEFAULT_SQL_DTB = 'c219studentsbooks';

    //Hosteur
    const DEFAULT_SQL_USER = 'students_books1';
    const DEFAULT_SQL_HOST = 'sql-server.k8s-o952ewod';
    const DEFAULT_SQL_PASS = '@McL[#m7Cn';
    const DEFAULT_SQL_DTB = 'studentsbooks1';

    //LOCAL
    // const DEFAULT_SQL_USER = 'students_books';
    // const DEFAULT_SQL_HOST = 'localhost';
    // const DEFAULT_SQL_PASS = 'j@Ms@7pA&?Eie9pb';
    // const DEFAULT_SQL_DTB = 'studentbook1';

    //Methode de création de l'instance 
    public static function getInstance()
    {  
        //On test si l'instance n'a pas été crée / Si elle est unique.
        if(is_null(self::$instance))
        {
            //Connexion avec PDO
            self::$instance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);

            //On définit la connexion avec la BDD en utf-8
            self::$instance->exec("SET NAMES 'UTF8'");

            //Active le Catch des erreurs PDO
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //defini la méthode de retour fetch / On retourne par default un objet / tableau d'objet
            //self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        //On retourne l'instance unique.
        return self::$instance;
    }

}