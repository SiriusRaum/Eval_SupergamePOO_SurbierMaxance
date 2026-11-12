<?php

Class View {

    public function displayHeader() {

        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mon Site Web</title>
        </head>
        <body>
            <header>

            </header>';
        return $this;    
            }
    public function displayFooter(){
        
        echo '<footer>
            <p></p>
        </footer>
        </body>
        </html>';
        return $this;


    }
}