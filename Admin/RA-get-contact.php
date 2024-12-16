<?php
    require_once('../connect.php');
    header('Content-Type: application/json; charset=utf8');
    //ha van id a get kérésben, le tudunk kérni adatot

    if (isset($_GET['id']) && is_numeric($_GET['id'])) 
    {
        $id = (int)$_GET["id"];
        //névjegy lekérdezése ID alapján

        $sql = "SELECT * 
                FROM nevjegyek
                WHERE id = ?";
        $stmt = $dbconn -> prepare($sql);
        $stmt -> bind_param('i', $id);
        $stmt -> execute();
        $resoult = $stmt -> get_result();

        if ($resoult->num_rows > 0)
        {
            $contact = $resoult -> fetch_assoc();
            echo Json_encode($contact, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        }
        //ha nincs ilyen névjegyzés:
        else
        {
            http_response_code(404);
            echo Json_encode(['error' => 'Névjegy nem található'], JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
            
        }
    }
    
    else
    {
        //az összes névjegy lekérdezése
        $sql = "SELECT *
                FROM nevjegyek";
        $resoult = $dbconn -> query($sql);
        $contacts = [];
        while ($row = $resoult -> fetch_assoc())
        {
            $contacts[] = $row;
        }
        echo Json_encode($contacts, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
    }

?>