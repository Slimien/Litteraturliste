<?php
if (isset($_POST["leggtil"])) { //Når Sjemaet postes


    //Kobling Settup
    // Tilkoblingsinformasjon
    $tjener = "localhost";
    $brukernavn = "root";
    $passord = "root";
    $database = "mydbwithgoodname";
    $port = 8889;

    // Opprette en kobling
    $kobling = new mysqli($tjener, $brukernavn, $passord, $database, $port);

    // Sjekk om koblingen virker
    if ($kobling->connect_error) {
        die("Noe gikk galt: " . $kobling->connect_error);
    }

    // Angi UTF-8 som tegnsett/Set til norskt tastatur
    $kobling->set_charset("utf8");


    // Lagrer skjemafeltene i enklere navn
    $Tittel = $_POST["Tittel"];
    $Link = $_POST["Link"];
    $Info = $_POST["Info"];
    $FN = $_POST["ForNavn"];
    $EN = $_POST["EtterNavn"];
    $Fag = $_POST["Fag"];
    $Dato = $_POST["Dato"];


    //Insert Artikkel
    $select = "SELECT Artikel_id FROM artikel WHERE Tittel = '{$Tittel}' AND Link = '{$Link}' AND Info = '{$Info}'";//query that looks for duplicate enterys
    $result = $kobling->query($select);//run query
    $result = $result->fetch_array();//list answers in array
    if(!$result)//if there are no duplicate enterys insert
    {
        $sql_array[] = "INSERT INTO artikel ( Tittel, Link, Info) VALUES ( '$Tittel', '$Link', '$Info')";//legg til artikkelen
    }else//Hvis den alerede finnes
    {
        echo"den artikkelen finnes alerede men andre ting kan fortsat ha blitt lagt inn";
        echo "<br>";
    }

    
    

    
    //Insert Forfatter
    $select = "SELECT Forfater_id FROM forfater WHERE ForNavn = '{$FN}' AND EtterNavn = '{$EN}'";//query that looks for duplicate enterys
    $result = $kobling->query($select);//run query
    $result = $result->fetch_array();//list answers in array
    if(!$result)//if there are no duplicate enterys insert
    {
        $sql_array[] = "INSERT INTO forfater (ForNavn, EtterNavn) VALUES ( '$FN', '$EN')";//legg til forfatteren
    }else
    {
        echo"den forfateren finnes alerede men andre ting kan fortsat ha blitt lagt inn";
        echo "<br>";
    }
    

    //Insert Fag
    $select = "SELECT fag_id FROM fag WHERE Fag = '{$Fag}'";//query that looks for duplicate enterys
    $result = $kobling->query($select);//run query
    $result = $result->fetch_array();//list answers in array
    if(!$result)//if there are no duplicate enterys insert
    {
        $sql_array[] = "INSERT INTO fag (Fag) VALUES ('$Fag')";//legg til faget
    }else
    {
        echo"det faget finnes alerede men andre ting kan fortsat ha blitt lagt inn";
        echo "<br>";
    }
    



    foreach ($sql_array as $sql) {//Gå gjennom alle spøringene
        //See om koblingen virker
        if ($kobling->query($sql)) {
            //echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen $sql ($kobling->error).";
            echo "<br>";
        }
    }

    //Set foreign keys
    //Artikkel id
    $select = "SELECT Artikel_id FROM artikel WHERE Tittel = '{$Tittel}' AND Link = '{$Link}' AND Info = '{$Info}'"; //Finn id til artikkelen som nettop ble lagt til
    //Kjør spøring og konverter resultat til int
    $result = $kobling->query($select);
    $result = $result->fetch_array();
    $AID = intval($result[0]);

    //Forfater id
    $select = "SELECT Forfater_id FROM forfater WHERE ForNavn = '{$FN}' AND EtterNavn = '{$EN}'";//Finn id til forfateren som nettop ble lagt til
    //Kjør spøring og konverter resultat til int
    $result = $kobling->query($select);
    $result = $result->fetch_array();
    $FID = intval($result[0]);

    //Fag id
    $select = "SELECT fag_id FROM fag WHERE Fag = '{$Fag}'"; //Finn id til fag som nettop ble lagt til
    //Kjør spøring og konverter resultat til int
    $result = $kobling->query($select);
    $result = $result->fetch_array();
    $FagID = intval($result[0]);

    //insert Artikkel_Has_fag
    $sql_array_fk[] = "INSERT INTO artikel_has_fag (Artikel_Artikel_id , Fag_fag_id ) VALUES ('$AID', '$FagID')";

    //Insert Forfater_has_artikkel
    $sql_array_fk[] = "INSERT INTO forfater_has_artikel (Forfater_id, Artikel_id, Dato) VALUES ('$FID', '$AID', '$Dato')";



    foreach ($sql_array_fk as $sql) {
        //See om koblingen virker
        if ($kobling->query($sql)) {
            //echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen $sql ($kobling->error).";
            echo "<br>";
        }
    }

    
}
