<?php 

namespace Hcode\Model;

use \Hcode\Model;
use \Hcode\DB\Sql;

class User extends Model {

	const SESSION = "User";

	protected $fields = [
		"iduser", "idperson", "deslogin", "despassword", "inadmin", "dtergister"
	];

    public static function checkLogin($inadmin = true)
    {

        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["iduser"] > 0
        ) {
            //Não está logado
            return false;

        } else {

            if ($inadmin === true && (bool)$_SESSION[User::SESSION]['inadmin'] === true) {

                return true;

            } else if ($inadmin === false) {

                return true;

            } else {

                return false;

            }

        }

    }

    public static function login($login, $password):User
    {

        $db = new Sql();

        $results = $db->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN"=>$login
        ));

        if (count($results) === 0) {
            throw new \Exception("Não foi possível fazer login.");
        }

        $data = $results[0];

        if (password_verify($password, $data["despassword"])) {

            $user = new User();
            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;

        } else {

            throw new \Exception("Não foi possível fazer login.");

        }

    }

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

    public static function verifyLogin($inadmin = true)
    {

        if (!User::checkLogin($inadmin)) {

            if ($inadmin) {
                header("Location: /ecommerce/admin/login");
            } else {
                header("Location: /ecommerce/login");
            }
            exit;

        }

    }

    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");

    }


}

 ?>