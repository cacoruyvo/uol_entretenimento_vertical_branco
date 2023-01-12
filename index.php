<?php
$texto = file_get_contents('https://combovideos.com.br/prod/generateXmlFiles/xmlFiles_4YouSee/genUolEntretenimento_4YouSee.php');

/*var_dump($texto);*/
if (!file_exists('feed.xml')) {

    $filetime = time() - filemtime('feed.xml');
    if ($filetime > 3600) {
        $arquivo = fopen('feed.xml', 'w');
        fwrite($arquivo, $texto);
        fclose($arquivo);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Tecmundo</title>

    <link rel="preload" href="./assets/animate.min.css" as="style">
    <link rel="preload" href="./assets/jquery.min.js" as="script">


    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <script src="./assets/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/animate.min.css">
    <style>
        /*definição padrao*/
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* cena 1 */
        #logo {
            background-image: url('./img/cover-logo.png');
            background-repeat: no-repeat;
            position: absolute;
            top: -1%;
            width: 70%;
            height: 30%;
            object-fit: contain;
            z-index: 1;
        }

        #elemento {
            background-image: url('./img/cover-elements.png');
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 10;
        }

        /* cena 2 */
        #elemento2 {
            background-image: url('./img/template-top-button.png');
            background-repeat: no-repeat;
            position: absolute;
            top: 5%;
            width: 70%;
            height: 30%;
            object-fit: contain;
            z-index: 1;
        }

        #entretenimento {
            background-image: url('./img/template-title.png');
            background-repeat: no-repeat;
            position: absolute;
            top: 5%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
        }

        #cirmaior {
            background-image: url('./img/template-half-circle-element.png');
            background-repeat: no-repeat;
            position: absolute;
            top: 10%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
        }

        #cirfino {
            background-image: url('./assets/template-duble-half-circle-elements.png');
            background-repeat: no-repeat;
            position: absolute;
            top: 10%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
        }

        /* animaçoes demoram 2x mais animate.css */
        :root {
            --animate-delay: 2s;
        }

        #noticias {
            position: absolute;
            top: 20%;
            left: 12%;
            transform: translate(-50%, -50%);
            width: 800px;
            height: 800px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 4.5vh;

        }

        #uol {
            position: absolute;
            background-image: url('./img/template-logo.png');
            background-repeat: no-repeat;
            top: 0%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;

        }
    </style>

</head>

<body>

    <!-- primeira imagem -->
    <div id="cena1">

        <!-- logo -->
        <div id="logo" class="animate__animated  animate__fadeInDown"></div>
        <!-- elemento -->
        <div id="elemento" class="animate__animated  animate__fadeIn"></div>

    </div>

    <!-- segunda imagem -->
    <div id="cena2">
        <div id="noticias" class="animate__animated animate__delay-5s animate__fadeInDown"></div>
        <!-- elemento esquerda -->
        <div id="elemento2" class="animate__animated animate__delay-2s animate__fadeInDown"></div>
        <!-- entretenimento -->
        <div id="entretenimento" class="animate__animated animate__delay-5s animate__fadeInDown"></div>
        <!-- circulo fino -->
        <div id="cirfino" class="animate__animated animate__delay-3s animate__fadeInLeft"></div>
        <!-- circulo maior -->
        <div id="cirmaior" class="animate__animated animate__delay-4s animate__fadeInLeft"></div>
        <!-- uol -->
        <div id="uol" class="animate__animated animate__delay-5s animate__fadeInRight"></div>

    </div>


    <script>
        setTimeout(function() {
            $('#cena1').hide();

        }, 4000);

        $.get('feed.xml', function(data) {
            var item = $(data).find('item');

            var size = item.length;
            console.log(size);

            //localStorage set item
            if (localStorage.getItem('index') == null) {
                localStorage.setItem('index', size);
            }
            if (localStorage.getItem('current') == null) {
                localStorage.setItem('current', 0);
            } else if (localStorage.getItem('current') == 0) {
                localStorage.setItem('current', 1);
            } else if (localStorage.getItem('current') < size - 1) {
                localStorage.setItem('current', parseInt(localStorage.getItem('current')) + 1);
            } else {
                localStorage.setItem('current', 0);
            }
            console.log(localStorage.getItem('current'));

            var descricao = $(item[localStorage.getItem('current')]).find('description').text();
            console.log(descricao);

            $('#noticias').text(descricao);

        });
    </script>
</body>

</html>