<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('movies')->insert([
      'title' => 'Avatar',
      'poster' => 'images/k1nzCGjw48cStwIovx0kuVN1A81zxUAOqFTD0MC6.jpg',
      'banner' => 'images/qfiApqiHCSD7syXwa6D5vkSNFVc2247klbdrUhq5.jpg',
      'year' => 2009,
      'runtime' => 162,
      'plot' => '
            Un infante de marina parapléjico enviado a la luna Pandora en una misión única se debate entre seguir sus órdenes y proteger el mundo que siente que es su hogar.',
      'director' => 'James Cameron',
      'file' => 'media/br7zSUxpRlTjOWimrpveOFy1mXeZWmdJuC8f5rCM.mp4',
      'trailer' => 'trailer/a9NS36oYXJXUgdX2KTeK89CdilxxaqwkZF2bGvUh.mp4',
      'created_at' => '2023/01/30'
    ]);

    DB::table('movies')->insert([
      'title' => 'Soy leyenda',
      'poster' => 'images/V4tA2hTaFwR6o2DXSpZYUad5eyR9taRqDdrSerIu.jpg',
      'banner' => 'images/TVi90emZt91OHGlPZ6W1L4UJlLgDzNzHKFVRJfs0.jpg',
      'year' => 2007,
      'runtime' => 101,
      'plot' => '
            Años después de que una plaga mate a la mayor parte de la humanidad y transforme al resto en monstruos, el único sobreviviente en la ciudad de Nueva York lucha valientemente para encontrar una cura.',
      'director' => 'Francis Lawrence',
      'file' => 'media/mhKM4CGriX0gotlhrRusOEUgJUHCfDq5gCgGwuzb.mp4',
      'trailer' => 'trailer/SBsJUw6ZrN2VIzdyZK55R4JK9898BGdpdKCdwLwG.mp4',
      'created_at' => '2023/02/28'
    ]);

    DB::table('movies')->insert([
      'title' => '300',
      'poster' => 'images/sm7DtS3hd4nkbbYjhNbhx9s0OyJDtC4yajjHpk8b.jpg',
      'banner' => 'images/Y9JCHmONmE9vAlnHCzzKV4nqSYSlYhDODXdeYIPZ.jpg',
      'year' => 2006,
      'runtime' => 117,
      'plot' => 'El rey Leónidas de Esparta y una fuerza de 300 hombres luchan contra los persas en las Termópilas en el 480 a.C.',
      'director' => 'Zack Snyder',
      'file' => 'media/cOQwlcZZyf2QZ5z65FhismPMQZH5h07TVHBRyYUz.mp4',
      'trailer' => 'trailer/LTswmdzpxogUFMEunIUvumKg44pk2K9RYlBOnLxb.mp4',
      'created_at' => '2023/03/30'
    ]);

    DB::table('movies')->insert([
      'title' => 'Bullet Train',
      'poster' => 'images/U3TneD4zqEQNZTKxRGEXRY0uyAxU72Ru2438nB6T.jpg',
      'banner' => 'images/A4bBCNxE9nbKfzKBq5wbXPfymsEoa25ZxWmLZmUb.jpg',
      'year' => 2022,
      'runtime' => 126,
      'plot' => 'Cinco asesinos a sueldo se encuentran a bordo de un tren bala que viaja de Tokio a Morioka. Los sicarios descubrirán que sus misiones no son ajenas entre sí.',
      'director' => 'David Leitch',
      'file' => 'media/qSn9UuViZp2NkNRwWnf09kfkhY7vfNAHpoFszVgd.mp4',
      'trailer' => 'trailer/a4dtasCj6Hi8CwHFWivT1yRXPYRdm87rAzsVZ7Hn.mp4',
      'created_at' => '2023-04-11 08:50:32'
    ]);

    DB::table('movies')->insert([
      'title' => 'Uncharted',
      'poster' => 'images/CHmAiS7zybXoWEQxp0e3HpkDzCe1D9X1VTucsggT.jpg',
      'banner' => 'images/wjI86VPJ4zhqKWBwEkLo2OEC5lxzeCeRbEsi647A.jpg',
      'year' => 2022,
      'runtime' => 95,
      'plot' => 'Nathan Drake y su compañero Victor Sullivan se adentran en la peligrosa búsqueda del "mayor tesoro jamás encontrado". Al mismo tiempo, rastrean pistas que puedan conducir al hermano perdido de Drake.',
      'director' => 'Ruben Fleischer',
      'file' => 'media/VCBsV3ybY12nYJAEG9AX2IpPE3BHoI9LQcHCNOKE.mp4',
      'trailer' => 'trailer/rdO9DHwroPV1LUUPK7C50eggJwWDL5N92pNHPiJp.mp4',
      'created_at' => '2023-04-11 09:12:53'
    ]);

    DB::table('movies')->insert([
      'title' => 'Black Adam',
      'poster' => 'images/DZm6vyLOuwbKyEcd02qdSycG2iXD3mThLeAH09y4.jpg',
      'banner' => 'images/y5FI4ZZpzx1Yhkr2treFlohHhZEk3RzUQC0xwEXn.jpg',
      'year' => 2022,
      'runtime' => 125,
      'plot' => 'Unos arqueólogos liberan de su tumba a Black Adam, quien llevaba 5000 años preso tras haber recibido los poderes de los dioses. De nuevo entre los humanos, Black Adam se dispone a imponer su justicia, muy diferente a la del mundo en el que despertó.',
      'director' => 'Jaume Collet-Serra',
      'file' => 'media/tdMGrav1VNrg9gF9hgqKMMmlSvlb5GtL1zS00pTA.mp4',
      'trailer' => 'trailer/lWIQgFRLrDl6Al4QFOn7DpJfm9rwveoFa2zIQH2K.mp4',
      'created_at' => '2023-04-11 09:14:56'
    ]);

    DB::table('movies')->insert([
      'title' => 'The Gray Man',
      'poster' => 'images/8aLYuxa3DKreaQ1eX4L89ShZwrbmry9JUzohoP8C.jpg',
      'banner' => 'images/4uFkBGbuvxG9xCnhH3tY2Ewyizm3o5PmA6MzdQKm.jpg',
      'year' => 2022,
      'runtime' => 122,
      'plot' => 'Cuando un misterioso agente de la CIA descubre trapos sucios de la Agencia, un excompañero desquiciado pone precio a su cabeza y lo persigue por todo el mundo.',
      'director' => 'Joe Russo y Anthony Russo',
      'file' => 'media/bJatlZDWa3m3d6FDbtqclPN6T4zeyugCu98kDVWg.mp4',
      'trailer' => 'trailer/tuDkGBHHKuWyHvQAVDkGb7SpLnubfusdCOZIJ4pF.mp4',
      'created_at' => '2023-04-11 09:19:49'
    ]);

    DB::table('movies')->insert([
      'title' => 'Jurassic World: Dominion',
      'poster' => 'images/Ra2LEINzaTnSmJBvb7nmOwLlG7vKd3zbOHM69Sxf.jpg',
      'banner' => 'images/431rQ8RBx3UIlMI6qAJWN3GimNPsV4xjUR5FjNwN.jpg',
      'year' => 2022,
      'runtime' => 86,
      'plot' => 'Cuatro años después de la destrucción de la Isla Nublar, los dinosaurios viven y cazan junto a los humanos en todo el mundo. Este frágil equilibrio remodelará el futuro y determinará si los humanos seguirán siendo o no la especie dominante.',
      'director' => 'Colin Trevorrow',
      'file' => 'media/WLFJXmCzi2Mjgo7XrmdMoi5wprnXNhLKz13CsH6s.mp4',
      'trailer' => 'trailer/LXScxua9B5WqaEsAJonhZME7NtZsKx51Iyo0BmlA.mp4',
      'created_at' => '2023-04-11 09:27:59'
    ]);

    DB::table('movies')->insert([
      'title' => 'El hombre del norte',
      'poster' => 'images/C1L1N6MFqEUiCEkWIrYYmEvm6zXTznHAOm8Q5KO6.jpg',
      'banner' => 'images/iQ6PB6vGj0tpoahOYeuk9A8SLR9fB6VRDHTHSZFi.jpg',
      'year' => 2022,
      'runtime' => 120,
      'plot' => 'El príncipe Amleth está a punto de convertirse en hombre pero, en ese momento, su tío asesina brutalmente a su padre y secuestra a la madre del niño. Dos décadas después, Amleth es un vikingo que tiene la misión de salvar a su madre.',
      'director' => 'Robert Eggers',
      'file' => 'media/1UyoikG5d8CrJoDP9HLCaLCvH00pC3NDXAh2RHrJ.mp4',
      'trailer' => 'trailer/appMGjwoLlrvTnhd4jG0gf2rKgHlbwQvtBJw0bOl.mp4',
      'created_at' => '2023-04-11 09:31:01'
    ]);

    DB::table('movies')->insert([
        'title' => 'Spider-Man: No Way Home',
        'poster' => 'images/3GwkNVxiyDdarICcSJLxbJ8r2QKpjpD2BC7GHibJ.jpg',
        'banner' => 'images/E5TqV66PVeP8WzgV930bxPHAKE2q4n0gtThXozIH.jpg',
        'year' => 2021,
        'runtime' => 148,
        'plot' => 'Esta versión extendida cuenta con más de 11 minutos contenido extra, incluyendo escenas eliminadas.Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe, vecino y amigo es desenmascarado y por tanto ya no es capaz de separar su vida normal de los enormes riesgos que conlleva ser un Súper Héroe. Cuando pide ayuda a Doctor Strange, los riesgos pasan a ser aún más peligrosos, obligándole a descubrir lo que realmente significa ser Spider-Man.',
        'director' => 'Jon Watts',
        'file' => 'media/WcADSrBUu9Bh0rVneGW7JDHjQsSb853WJZ0p0WDk.mp4',
        'trailer' => 'trailer/TNhxTNN5S6qEXJAEzcI7v1fCXE2kwQ1URGoQ2PEX.mp4',
        'created_at' => '2023-04-11 09:33:54'
      ]);

    DB::table('movies')->insert([
        'title' => 'Top Gun: Maverick',
        'poster' => 'images/aepn1R8rUAsAWheoq374D2viH9ccF6BPMKbOt5Ta.jpg',
        'banner' => 'images/zP2hiEopVqaNEiFWl5zsmRTlACyku1VZgows89R8.jpg',
        'year' => 2022,
        'runtime' => 130,
        'plot' => 'Tras más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete "Maverick" Mitchel se encuentra donde siempre quiso estar, empujando los límites como un valiente piloto de pruebas.',
        'director' => 'Joseph Kosinski',
        'file' => 'media/Vuebww2gDFtMihBIY7p0rouBjaMESDQhzQ5CruqH.mp4',
        'trailer' => 'trailer/uOOmLOTp7fkQ9rudBnmFhkn7KgwigayKqsLshYIB.mp4',
        'created_at' => '2023-04-11 09:36:31'
      ]);

    DB::table('movies')->insert([
        'title' => 'Morbius',
        'poster' => 'images/gJ8tXXuP1nzXkKKUiNeyOz0Y4lV5xZ5HXpS0lNhB.jpg',
        'banner' => 'images/5qrGzWxg4A95Kk93K0kudTlQHOn6aFWbfjQTWkKU.jpg',
        'year' => 2022,
        'runtime' => 104,
        'plot' => 'Ambientada en el universo de Spider Man, se centra en uno de sus villanos más icónicos, Morbius, un doctor que tras sufrir una enfermedad en la sangre y fallar al intentar curarse, se convirtió en un vampiro.',
        'director' => 'Daniel Espinosa',
        'file' => 'media/mONxfqi46CEUbBCGffAzRVppObuXmt85dRYLVlDZ.mp4',
        'trailer' => 'trailer/LkEvvLsUCdoW5qaSzNaHMzZcUZfXDvu2AO5cmqNl.mp4',
        'created_at' => '2023-04-11 09:37:51'
      ]);

    DB::table('movies')->insert([
        'title' => 'Infinite Storm',
        'poster' => 'images/LsegJNtpwrxjnKNk0VPOUyWd5tzyUuAUznUcbaar.jpg',
        'banner' => 'images/78CMFHt9QuGKU2RGCH267XI4Il7O34KJhG3VgwKh.jpg',
        'year' => 2022,
        'runtime' => 97,
        'plot' => 'Una alpinista empieza el descenso antes de alcanzar la cumbre porque se avecina una tormenta de nieve. En el camino, encuentra a un hombre en peligro de muerte y, juntos, tratan de llegar vivos al pie de la montaña en unas condiciones infernales.',
        'director' => 'Malgorzata Szumowska y Michal Englert',
        'file' => 'media/ybEeyGaSWxsSEoIpbTusPwM8xZVUEu12HSWHZR1Q.mp4',
        'trailer' => 'trailer/bz6n6NS6UAXG9aOA4GmLAAcOkY77PehOZv85V9Yk.mp4',
        'created_at' => '2023-04-11 11:16:13'
      ]);

    DB::table('movies')->insert([
        'title' => 'Beast',
        'poster' => 'images/wykfnv406KbWzh4QrTlVTNkUCXHcutq28JEjqLD7.jpg',
        'banner' => 'images/HCSHeB6vhSLARLUolC2jShzSQS78Lkktnhrad8t6.jpg',
        'year' => 2022,
        'runtime' => 93,
        'plot' => 'Un hombre que acaba de enviudar y sus dos hijas adolescentes viajan a una reserva de caza en Sudáfrica. Sin embargo, su viaje de curación pronto se convierte en una lucha por la supervivencia cuando un león sediento de sangre comienza a acecharlos.',
        'director' => 'Baltasar Kormákur',
        'file' => 'media/zDPczizECvd2wx2EOEYfCcGNNWYv7DsLExWJs6Ox.mp4',
        'trailer' => 'trailer/uwaXcxb68HQzik2Mpzn1WKZAWFidHsx8VoNigmXG.mp4',
        'created_at' => '2023-04-11 11:19:58'
      ]);

    DB::table('movies')->insert([
        'title' => 'Animales Fantásticos',
        'poster' => 'images/3mnQgyKQBGBfYSGmlKFvGFQp29ghp1d3McfDe274.jpg',
        'banner' => 'images/pigxF5VdnO3s8t5ToJiVyCdX74CO3Iqy9B2hnaO2.jpg',
        'year' => 2022,
        'runtime' => 120,
        'plot' => 'La historia tiene lugar en Río de Janeiro, Brasil y conduce a la participación del Mundo Mágico en la Segunda Guerra Mundial.',
        'director' => 'David Yates',
        'file' => 'media/AGbjpypFlzfsjTx2sRQRzncFwZDWEzpggvrsB8ON.mp4',
        'trailer' => 'trailer/au8Xm0R4I5uqOfiyKjz4wMjdWsIdsa88hqMqKQVe.mp4',
        'created_at' => '2023-04-11 11:22:54'
      ]);

    DB::table('movies')->insert([
        'title' => 'Dune',
        'poster' => 'images/jt8SJ26Ij1XXXHOTS7F6RHwCo9MweiDPYzvKu6Ek.jpg',
        'banner' => 'images/726ceplSjsaKuaOUe2oLbKaqYk3EgBfqZ64C02kW.jpg',
        'year' => 2021,
        'runtime' => 155,
        'plot' => 'Arrakis, también denominado "Dune", se ha convertido en el planeta más importante del universo. A su alrededor comienza una gigantesca lucha por el poder que culmina en una guerra interestelar.',
        'director' => 'Denis Villeneuve',
        'file' => 'media/rMIZMoIoTseSSTIt7GsePsLEkmHn3VpXpRkl5OEn.mp4',
        'trailer' => 'trailer/tS1TepHarmDAX90UD22KpKNGbir7CO7ehR40Ujzb.mp4',
        'created_at' => '2023-04-11 11:27:53'
      ]);

    DB::table('movies')->insert([
        'title' => 'Ciudad Perdida',
        'poster' => 'images/T9Sj7J2JyeTxp5DjORe8cKbfDGw7mrZXTESVurDO.jpg',
        'banner' => 'images/MeLBDweNNP5z1HyaNGxt29Sgrz6K1WrgVTqcWVfU.jpg',
        'year' => 2022,
        'runtime' => 102,
        'plot' => 'La escritora solitaria Loretta Sage escribe sobre lugares exóticos en sus populares novelas de aventuras con un atractivo modelo de portada, Alan. Mientras está de gira promocionando su nuevo libro, es secuestrada por un excéntrico multimillonario.',
        'director' => 'Aaron Nee y Adam Nee',
        'file' => 'media/Gqz5oafw3IBM6BSnlY28EtLKdBgWPtc6eakBNZt4.mp4',
        'trailer' => 'trailer/0jMEuX2O15u8DMdLqd1lyVWhq7i9o4BEmvBWJoIQ.mp4',
        'created_at' => '2023-04-11 11:32:55'
      ]);

    DB::table('movies')->insert([
        'title' => 'Free Guy',
        'poster' => 'images/mRSF1UHmOCFvUukaMwutdH5hQqkNXJoqQsJ4i73s.jpg',
        'banner' => 'images/TUhNKANnB6pJ9FJp81Yz866P8UgCtd4kIp8xcCvD.jpg',
        'year' => 2021,
        'runtime' => 115,
        'plot' => 'Un cajero de un banco descubre que en realidad es un personaje sin papel dentro de un brutal videojuego de mundo interactivo.',
        'director' => 'Shawn Levy',
        'file' => 'media/Svno7Udp9bsSr38iVFhIykJgYgE9kHheg40Dikgh.mp4',
        'trailer' => 'trailer/bgYbEJKa9td4xg8oeNAqLQWmkIN8xgZ28mJ5qMpF.mp4',
        'created_at' => '2023-04-11 11:36:57'
      ]);

    DB::table('movies')->insert([
        'title' => 'Black Panther: Wakanda Forever',
        'poster' => 'images/ZDED5jS6hmOi1d17GhZsXnSqMTtpDjDwiBoB4MLL.jpg',
        'banner' => 'images/NBHPckDTTkwVjgtiAZDzke7TEtlCKtZMJHLAuasQ.jpg',
        'year' => 2022,
        'runtime' => 161,
        'plot' => 'Una secuela que seguirá explorando el incomparable mundo de Wakanda y todos los ricos y variados personajes presentados en la película de 2018.',
        'director' => 'Ryan Coogler',
        'file' => 'media/yZmrejyGze7PZUQDOIkjKJpFsPQsw2J58GnXaCVb.mp4',
        'trailer' => 'trailer/LhyCIuawC1WmNg9acQiA352aHBgX1oZOTFawUxz0.mp4',
        'created_at' => '2023-04-11 11:38:43'
      ]);

    DB::table('movies')->insert([
        'title' => 'The Batman',
        'poster' => 'images/Eye6NE3JMvjdHVm03P6NABwXWti8xZKzpxF3XiKN.jpg',
        'banner' => 'images/awYzxG77DWcEtt7Yjav7dyxUzU5LxVMVR2dow1an.jpg',
        'year' => 2022,
        'runtime' => 175,
        'plot' => 'En su segundo año luchando contra el crimen, Batman explora la corrupción existente en la ciudad de Gotham y el vínculo de esta con su propia familia. Además, entrará en conflicto con un asesino en serie conocido como "el Acertijo".',
        'director' => 'Matt Reeves',
        'file' => 'media/ke2r4dox3BQOkqj0JaDxJikU89MmY65oOCKyRDF8.mp4',
        'trailer' => 'trailer/Y6C0A1GtuNYqi7V1PL3yjzOsu4NnSu9wvpMkbTa3.mp4',
        'created_at' => '2023-04-11 11:44:00'
      ]);

    DB::table('movies')->insert([
        'title' => 'Bloodshot',
        'poster' => 'images/vOu3ZjTSzx5lglGzo5P19oZljiYBoVj4H2T4QBsB.jpg',
        'banner' => 'images/Z1xlftNEYqwyYbNFI69CO0XSH7ERPVvhHsZCA053.jpg',
        'year' => 2020,
        'runtime' => 109,
        'plot' => 'Murray Ray Garrison es resucitado por un equipo de científicos. Mejorado con nanotecnología, se convierte en una máquina de matar biotecnológica sobrehumana. Cuando Ray entrena por primera vez con otros super soldados, no recuerda nada de su vida anterior. Pero cuando recuerda que lo mataron, sale de las instalaciones para vengarse, solo para descubrir que la conspiración va más allá de lo que pensaba.',
        'director' => 'David S F Wilson',
        'file' => 'media/6LlFdr750zaDWnC3z2HdZL4xiY6pRFQz5LUTTBjT.mp4',
        'trailer' => 'trailer/1KYh6DibdD566B5O4XdjCK4CycAoFK5wnxGFlcAq.mp4',
        'created_at' => '2023-04-11 11:47:24'
      ]);

    DB::table('movies')->insert([
        'title' => 'Ready Player One',
        'poster' => 'images/7xalSXW7PfHiiZ4p9vauiTfFz0Qzpbu3MBvK7alT.jpg',
        'banner' => 'images/UcfEQfs1DFAvMZIKGHbfjXSEGEd6RzL0diMp2sZW.jpg',
        'year' => 2018,
        'runtime' => 139,
        'plot' => 'Año 2045. El adolescente Wade Watts es solo una de las millones de personas que se evaden del sombrío mundo real para sumergirse en un mundo utópico virtual donde todo es posible: OASIS. Wade participa en la búsqueda del tesoro que el creador de este mundo imaginario dejó oculto en su obra.',
        'director' => 'Steven Spielberg',
        'file' => 'media/Rc4NhWF1C2x01dJ8xUS8PARUbnNZoG9npQglg0Yq.mp4',
        'trailer' => 'trailer/LeVUZIcoSmi7kzNodSAJBWvxJ7iVJZkviEAwFETT.mp4',
        'created_at' => '2023-04-11 11:49:28'
      ]);


  }
}
