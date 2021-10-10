<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <?php include "web_parts/header.php"?>
    <main>
    <h1>Přidání receptu</h1>
    <form action="process.php" method="POST">
        <fieldset>
            <legend>Hlavní informace</legend>
            <div>
                <label for="nazev">Název receptu</label>
                <input type="text" name="nazev" id="nazev" required>
            </div>
            <div>
                <label for="popis">Krátký popis receptu</label>
                <input type="text" name="popis" id="popis" required>
            </div>
        </fieldset>
        <fieldset>
            <legend>Postup receptu</legend>
            <div>
                <label for="postup">Postup receptu</label>
                <textarea name="postup" id="postup" cols="50" rows="5" required></textarea>
            </div>
            <div>
                <label for="cas">Čas připravy</label>
                <input type="number" name="cas" id="cas" placeholder="(v minutách)" min="10" max="600" title="Musí být v rozsahu od 10 do 600 minut" required>
            </div>
            <div>
                <label for="jmeno">Autor</label>
                <input type="text" name="jmeno" id="jmeno" required>
            </div>
        </fieldset>
        <div class="submit-btn">
            <input type="submit" value="Odeslat">
        </div>
    </form>
    </main>
    <?php include "web_parts/footer.php"?>
</body>
</html>