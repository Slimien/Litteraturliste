<DOCTYPE html>
    <head>
    </head>

    <body>
        <?php


        // Tilkoblingsinformasjon
        $tjener = "localhost";
        $brukernavn = "root";
        $passord = "root";
        $database = "mydbwithgoodname";
        $port = 8889;

        // Opprette en kobling
        $kobling = new mysqli($tjener, $brukernavn, $passord, $database, $port);

        //en join for finne informasjon fra databasen
        $sql = "SELECT a.Tittel, a.Link, a.Info, fag.Fag, f.ForNavn, f.EtterNavn, fha.Dato
        FROM mydbwithgoodname.artikel a, mydbwithgoodname.artikel_has_fag ahf, mydbwithgoodname.fag fag, mydbwithgoodname.forfater f, mydbwithgoodname.forfater_has_artikel fha
        WHERE a.Artikel_id = ahf.Artikel_Artikel_id 
        AND fag.fag_id = ahf.Fag_fag_id
        AND f.Forfater_id = fha.Forfater_id
        AND a.Artikel_id = fha.Artikel_id
        ORDER BY a.Tittel, f.EtterNavn, fha.Dato";


        // Sjekk om koblingen virker
        if ($kobling->connect_error) {
            die("Noe gikk galt: " . $kobling->connect_error);
        }

        //kjører joinen
        $resultat = $kobling->query($sql);

    
        echo "<table>"; // Starter tabellen
        echo "<tr>"; // Lager en rad med overskrifter
        echo "<th>Tittel</th>";
        echo "<th>Fornavn</th>";
        echo "<th>Etternavn</th>";
        echo "<th>Link</th>";
        echo "<th>Dato</th>";
        echo "<th>Beskrivelse</th>'";
        echo "<th>Fag</th>'";

        echo "</tr>";


        while ($rad = $resultat->fetch_assoc()) {
            //Lagre informsjon fra spørringen i variabler med enkle navn
            $Dato = $rad["Dato"];
            $FN = $rad["ForNavn"];
            $EN = $rad["EtterNavn"];
            $Tittel = $rad["Tittel"];
            $Link = $rad["Link"];
            $Info = $rad["Info"];
            $Fag = $rad["Fag"];
            
            //vis innformasjon fra databasen på skjermen
            echo "<tr>";
            echo "<td>$Tittel</td>";
            echo "<td>$FN</td>";
            echo "<td>$EN</td>";
            echo "<td>$Link</td>";
            echo "<td>$Dato</td>";
            echo "<td>$Info</td>";
            echo "<td>$Fag</td>";

            echo "</tr>";
        }
        echo "</table>"; // Avslutter tabellen

        ?>
    </body>

    </html>
