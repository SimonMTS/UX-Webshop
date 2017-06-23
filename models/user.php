<?php

    class User {
        public $id;
        public $name;
        public $password;
        public $salt;
        public $role;
        public $pic;

        public $voornaam;
        public $achternaam;
        public $geslacht;
        public $geboorte_datum;
        public $adres;

        public function __construct(
            $id, 
            $name, 
            $password, 
            $salt, 
            $role, 
            $pic, 
            $voornaam, 
            $achternaam, 
            $geslacht, 
            $geboorte_datum, 
            $adres
        ) {
            $this->id = $id;
            $this->name = $name;
            $this->password = $password;
            $this->salt = $salt;
            $this->role = $role;
            $this->pic = $pic;

            $this->voornaam = $voornaam;
            $this->achternaam = $achternaam;
            $this->geslacht = $geslacht;
            $this->geboorte_datum = $geboorte_datum;
            $this->adres = $adres;
        }

        public static function role($text) {
            switch ($text) {
                case 'User':
                    return 1;
                    break;
                case 'Admin':
                    return 777;
                    break;
                case 1:
                    return 'User';
                    break;
                case 777:
                    return 'Admin';
                    break;
                default:
                    return false;
                    break;
            }
        }
		
		public static function searchByName($text, $limit, $offset) {
			return Sql::Search('user', 'name', $text, $limit, $offset);
		}
		
        public static function all() {
            return Sql::Get('user');
        }

        public static function find($id) {
            $result = Sql::Get('user', 'id', $id);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['password']) &&
                isset($result[0]['salt']) &&
                isset($result[0]['role']) &&
                isset($result[0]['pic']) &&
                isset($result[0]['voornaam']) &&
                isset($result[0]['achternaam']) &&
                isset($result[0]['geslacht']) &&
                isset($result[0]['geboorte_datum']) &&
                isset($result[0]['adres'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['password'],
                    $result[0]['salt'],
                    $result[0]['role'],
                    $result[0]['pic'],
                    $result[0]['voornaam'],
                    $result[0]['achternaam'],
                    $result[0]['geslacht'],
                    $result[0]['geboorte_datum'],
                    $result[0]['adres']);
            } else {
                return false;
            }

        }

        public static function findByName($name) {
            $result = Sql::Get('user', 'name', $name);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['password']) &&
                isset($result[0]['salt']) &&
                isset($result[0]['role']) &&
                isset($result[0]['pic']) &&
                isset($result[0]['voornaam']) &&
                isset($result[0]['achternaam']) &&
                isset($result[0]['geslacht']) &&
                isset($result[0]['geboorte_datum']) &&
                isset($result[0]['adres'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['password'],
                    $result[0]['salt'],
                    $result[0]['role'],
                    $result[0]['pic'],
                    $result[0]['voornaam'],
                    $result[0]['achternaam'],
                    $result[0]['geslacht'],
                    $result[0]['geboorte_datum'],
                    $result[0]['adres']);
            } else {
                return $result;
            }
        }

        public static function findByRole($number, $lt) {
            if (!$lt && false) {
                $result = $col->find( ["role" => ['$lt' => $number]] );
            } else {
                $result = Sql::Get('user', 'role', $number);
            }

            return $result;
        }

        public function save() {
            if ( !self::find($this->id) ) {
                if ( !self::findByName($this->name) ) {
                    Sql::Save('user', [
                        'id' => $this->id,
                        'name' => $this->name,
                        'password' => $this->password,
                        'salt' => $this->salt,
                        'role' => $this->role,
                        'pic' => $this->pic,
                        'voornaam' => $this->voornaam,
                        'achternaam' => $this->achternaam,
                        'geslacht' => $this->geslacht,
                        'geboorte_datum' => $this->geboorte_datum,
                        'adres' => $this->adres
                    ]);

                    return true;
                } else {
                    return false;
                }
            } else {
                Sql::Update('user', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name,
                    'password' => $this->password,
                    'salt' => $this->salt,
                    'role' => $this->role,
                    'pic' => $this->pic,
                    'voornaam' => $this->voornaam,
                    'achternaam' => $this->achternaam,
                    'geslacht' => $this->geslacht,
                    'geboorte_datum' => $this->geboorte_datum,
                    'adres' => $this->adres
                ]);

                return true;
            }
        }

        public function delete() {
            $user = self::find($this->id);

            if (explode('/', $user->pic)[1] == 'img') {
                if ( !unlink($user->pic) ) {
                    return false;
                }
            }

            Sql::Delete('user', 'id', $this->id);
        }
    }