<?php
        
//connecting to the database a2868401_adyer
        function getDatabase() {
            $config = array(
            'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=a2868401_adyer', 
            'DB_USER' => 'adyer', 
            'DB_PASSWORD' => 'Finnegan1337'
            );
            
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            return $db;
        }

