<?php
include "./Php Files/InsertData.php"
?>

<DOCTYPE html>

    <!--form for å legge inn ting-->
    <form method="POST">
        <input type="text" name="ForNavn" required>
        Forfatter fornavn
        </p>
        <input type="text" name="EtterNavn" required>
        Forfatter etternavn
        </p>
        <input type="text" name="Tittel" required>
        Tittel
        </p>
        <input type="text" name="Link" required>
        Link
        </p>
        <input type="text" name="Info" required>
        Info
        </p>
        <input type="text" name="Fag" required>
        Fag
        </p>
        <input type="Date" name="Dato" required>
        Dato
        </p>
        <input type="submit" name="leggtil" value="Legg til" required>
    </form>
    
</html>