<?php
        
//connecting to the database phpclasssummer2015
        function getDatabase() {
            $config = array(
            'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=phpclasssummer2015', 
            'DB_USER' => 'php', 
            'DB_PASSWORD' => 'summer15'
            );
            
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            return $db;
        }

